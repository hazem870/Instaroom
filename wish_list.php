<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - WISH LIST</title>
    <style>
        .room-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }
        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .room-img {
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .room-card:hover .room-img {
            transform: scale(1.03);
        }
        .price-tag {
            background: linear-gradient(135deg, #3a7bd5, #00d2ff);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
        }
        .empty-wishlist {
            min-height: 50vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .empty-wishlist i {
            font-size: 5rem;
            color: #e63946;
            margin-bottom: 1rem;
        }
        .badge-custom {
            background-color: #f8f9fa;
            color: #495057;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            padding: 0.5em 0.8em;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .action-btn {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .action-btn:hover {
            transform: translateY(-2px);
        }
        .more-btn {
            color: #6c757d;
            transition: all 0.3s ease;
        }
        .more-btn:hover {
            color: #0d6efd;
            transform: translateX(3px);
        }
    </style>
</head>
<body class="bg-light">

    <?php
        require('inc/header.php');
        
        if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
            redirect('index.php');
        }
    ?>
    
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold h-font">Your Wish List</h2>
            <p class="text-muted">Your saved rooms for future stays</p>
        </div>

        <div class="row">
            <?php 
                $room_res = "SELECT r.* FROM rooms r 
                INNER JOIN wish_list w ON w.room_id = r.id 
                WHERE w.user_id = ?
                AND r.status=? 
                AND r.removed=? 
                ORDER BY r.id DESC ";

                $res = select($room_res,[$_SESSION['uId'],1,0],'iii');

                if(mysqli_num_rows($res)==0){
                    echo '<div class="empty-wishlist col-12 text-center">
                        <i class="bi bi-heartbreak"></i>
                        <h4 class="fw-bold mb-3">Your wishlist is empty</h4>
                        <p class="text-muted mb-4">Start adding rooms you love by clicking the heart icon</p>
                        <a href="index.php" class="btn btn-primary px-4">Explore Rooms</a>
                    </div>';
                }

                while($room_data = mysqli_fetch_assoc($res)) {
                    // get features of room
                    $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
                        INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                        WHERE rfea.room_id = '$room_data[id]'");

                    $features_data = "";
                    while($fea_row = mysqli_fetch_assoc($fea_q)){
                        $features_data .="<span class='badge badge-custom text-wrap'>
                        $fea_row[name]
                        </span>";
                    }

                    // get facilities of room
                    $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
                        INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                        WHERE rfac.room_id = '$room_data[id]'");

                    $facilities_data = "";
                    while($fac_row = mysqli_fetch_assoc($fac_q)){
                        $facilities_data .="<span class='badge badge-custom text-wrap'>
                        $fac_row[name]
                        </span>";
                    }
                    
                    $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                    $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
                        WHERE `room_id`='$room_data[id]' 
                        AND `thumb`='1'");

                    if(mysqli_num_rows($thumb_q)>0){
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                    }

                    $book_btn = "";

                    if(!$settings_r['shutdown']){
                        $login=0;
                        if(isset($_SESSION['login']) && $_SESSION['login']==true){
                            $login=1;
                        }

                        $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn action-btn text-white custom-bg shadow-none'>Book Now</button>";
                    }

                    $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review`
                        WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

                    $rating_res = mysqli_query($con,$rating_q);
                    $rating_fetch = mysqli_fetch_assoc($rating_res);

                    $rating_data = "";

                    if($rating_fetch['avg_rating']!=NULL) {
                        $rating_data = "<div class='rating mb-3'>
                            <h6 class='mb-2'>Rating</h6>
                            <div class='d-flex align-items-center'>
                                <div class='me-2'>";

                        for($i=0; $i<5; $i++){
                            if($i < floor($rating_fetch['avg_rating'])){
                                $rating_data .="<i class='bi bi-star-fill text-warning'></i>";
                            } elseif($i < $rating_fetch['avg_rating']){
                                $rating_data .="<i class='bi bi-star-half text-warning'></i>";
                            } else {
                                $rating_data .="<i class='bi bi-star text-warning'></i>";
                            }
                        }

                        $rating_data .= "</div>
                                <span class='text-muted small'>".number_format($rating_fetch['avg_rating'],1)."/5</span>
                            </div>
                        </div>";
                    }

                    $wishlist_status = "<button onclick='removeWishlist($room_data[id],1)' class='btn p-0 shadow-none' style='font-size: 20px;'><i class='bi bi-heart-fill text-danger'></i></button>"; 

                    // print room card
                    echo <<<data
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card border-0 shadow-sm room-card h-100">
                                <div class="overflow-hidden">
                                    <img src="$room_thumb" class="card-img-top room-img w-100">
                                </div>
                                <div class="card-body">
                                    <div class='d-flex align-items-start justify-content-between mb-3'>
                                        <div>
                                            <h5 class='card-title mb-1'>$room_data[name]</h5>
                                            <div class='d-flex align-items-center'>
                                                <i class="bi bi-geo-alt-fill text-primary me-1"></i>
                                                <span class='text-muted small'>$room_data[location]</span>
                                            </div>
                                        </div>
                                        <div class='text-end'>
                                            <span class='price-tag'>YER$room_data[price]</span>
                                            <div class='mt-2'>$wishlist_status</div>
                                        </div>
                                    </div>
                                    
                                    <div class="features mb-3">
                                        <h6 class="mb-2 fw-semibold">Features</h6>
                                        <div class="d-flex flex-wrap">$features_data</div>
                                    </div>
                                    
                                    <div class="facilities mb-3">
                                        <h6 class="mb-2 fw-semibold">Facilities</h6>
                                        <div class="d-flex flex-wrap">$facilities_data</div>
                                    </div>
                                    
                                    <div class="guests mb-3">
                                        <h6 class="mb-2 fw-semibold">Guests</h6>
                                        <div class="d-flex flex-wrap">
                                            <span class="badge badge-custom">
                                                <i class="bi bi-person me-1"></i>$room_data[adult] Adults
                                            </span>
                                            <span class="badge badge-custom">
                                                <i class="bi bi-person me-1"></i>$room_data[children] Children
                                            </span>
                                        </div>
                                    </div>
                                    
                                    $rating_data
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                                        $book_btn
                                        <form method='POST' action='room_details.php'>
                                            <input type='hidden' name='room_id' value='{$room_data['id']}'>
                                            <button type='submit' class='btn btn-link more-btn text-decoration-none p-0'>
                                                View Details <i class="bi bi-arrow-right ms-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    data;
                }
            ?>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
</body>
</html>