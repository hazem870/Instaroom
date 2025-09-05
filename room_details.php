<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php require('inc/links.php'); ?>
  <title><?= $settings_r['site_title'] ?> - ROOM DETAILS</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    rel="stylesheet"
  />
  <style>
    .room-header {
      background: #3498db;
      padding:0;
      color: white;
    }
    .carousel img {
      height: 500px;
      object-fit: cover;
      border-radius: 10px;
    }
    .carousel-control-prev, .carousel-control-next {
      width: 40px;
      height: 40px;
      background-color: rgba(0,0,0,0.5);
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
    }
    .booking-card {
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      position: sticky;
      top: 20px;
    }
    .feature-badge {
      background-color: #f8f9fa;
      padding: 8px 12px;
      margin: 0 8px 8px 0;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
    }
    .host-card {
      border-radius: 15px;
      transition: transform 0.3s ease;
    }
    .host-card:hover {
      transform: translateY(15px);
    }
    .review-card {
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .rating-stars {
      color: #ffc107;
      font-size: 18px;
    }
  </style>
</head>
<body class="bg-light">

<?php
require('inc/header.php');

if (!isset($_POST['room_id'])) {
  redirect('index.php');
}

$data = filteration($_POST);

$room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['room_id'], 1, 0], 'iii');

if (mysqli_num_rows($room_res) == 0) {
  redirect('rooms.php');
}

$room_data = mysqli_fetch_assoc($room_res);
?>

<!-- Room Header -->
<div class="room-header">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h5 class="fw-bold "><?= $room_data['name'] ?></h5>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="container py-5">
  <div class="row g-4">

    <!-- Room Gallery -->
    <div class="col-lg-8">
      <div id="roomCarousel" class="carousel slide shadow" data-bs-ride="carousel">
        <div class="carousel-inner rounded-3 overflow-hidden">
          <?php
          $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
          $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]'");
          $active_class = 'active';

          if (mysqli_num_rows($img_q) > 0) {
            while ($img_res = mysqli_fetch_assoc($img_q)) {
              $image_src = ROOMS_IMG_PATH . $img_res['image'];
              echo "<div class='carousel-item $active_class'>
                      <img src='$image_src' class='d-block w-100' alt='Room Image'>
                    </div>";
              $active_class = '';
            }
          } else {
            echo "<div class='carousel-item active'>
                    <img src='$room_img' class='d-block w-100' alt='Room Image'>
                  </div>";
          }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- Room Description -->
      <div class="card border-0 shadow-sm mt-4">
        <div class="card-body">
          <h3 class="fw-bold mb-4">About This Room</h3>
          <p class="lead"><?= $room_data['description'] ?></p>
          
          <div class="row mt-4">
            <div class="col-md-6">
              <h5 class="fw-bold mb-3"><i class="bi bi-check-circle text-primary me-2"></i>Features</h5>
              <div class="d-flex flex-wrap">
                <?php
                $features_q = mysqli_query($con, "SELECT f.name FROM `features` f
                                INNER JOIN `room_features` rf ON f.id = rf.features_id
                                WHERE rf.room_id = '$room_data[id]'");
                while ($fea = mysqli_fetch_assoc($features_q)) {
                  echo "<span class='feature-badge'><i class='bi bi-check2-circle text-primary me-2'></i>{$fea['name']}</span>";
                }
                ?>
              </div>
            </div>
            
            <div class="col-md-6">
              <h5 class="fw-bold mb-3"><i class="bi bi-building text-primary me-2"></i>Facilities</h5>
              <div class="d-flex flex-wrap">
                <?php
                $facilities_q = mysqli_query($con, "SELECT f.name FROM `facilities` f
                                INNER JOIN `room_facilities` rf ON f.id = rf.facilities_id
                                WHERE rf.room_id = '$room_data[id]'");
                while ($fac = mysqli_fetch_assoc($facilities_q)) {
                  echo "<span class='feature-badge'><i class='bi bi-check2-circle text-success me-2'></i>{$fac['name']}</span>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Reviews Section -->
      <div class="card border-0 shadow-sm mt-4">
        <div class="card-body">
          <h3 class="fw-bold mb-4">Guest Reviews</h3>
          <?php
          $rating_q = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews FROM `rating_review` WHERE `room_id`='$room_data[id]'";
          $rating_res = mysqli_query($con, $rating_q);
          $rating_data = mysqli_fetch_assoc($rating_res);
          $avg_rating = round($rating_data['avg_rating'] ?? 0);
          $total_reviews = $rating_data['total_reviews'] ?? 0;
          
          echo "<div class='d-flex align-items-center mb-4'>
                  <div class='bg-primary text-white rounded-pill px-3 py-1 me-3'>
                    <h4 class='mb-0'>$avg_rating</h4>
                  </div>
                  <div>
                    <div class='rating-stars mb-1'>";
                      echo str_repeat("<i class='bi bi-star-fill'></i>", $avg_rating);
                      echo str_repeat("<i class='bi bi-star'></i>", 5 - $avg_rating);
          echo    "</div>
                    <p class='text-muted mb-0'>Based on $total_reviews reviews</p>
                  </div>
                </div>";

          $review_q = "SELECT rr.*, uc.name AS uname, uc.profile FROM `rating_review` rr
                      INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                      WHERE rr.room_id = '$room_data[id]'
                      ORDER BY rr.sr_no DESC LIMIT 5";
          $review_res = mysqli_query($con, $review_q);
          $img_path = USERS_IMG_PATH;

          if (mysqli_num_rows($review_res) == 0) {
            echo '<div class="alert alert-light">No reviews yet! Be the first to review this room.</div>';
          } else {
            while ($row = mysqli_fetch_assoc($review_res)) {
              $stars = str_repeat("<i class='bi bi-star-fill rating-stars'></i> ", $row['rating']);
              echo "<div class='card review-card border-0 shadow-sm mb-3'>
                      <div class='card-body'>
                        <div class='d-flex align-items-center mb-3'>
                          <img src='$img_path{$row['profile']}' width='50' height='50' class='rounded-circle border me-3' />
                          <div>
                            <h6 class='mb-0 fw-bold'>{$row['uname']}</h6>
                            <div class='rating-stars'>$stars</div>
                          </div>
                        </div>
                        <p class='mb-0'>{$row['review']}</p>
                      </div>
                    </div>";
            }
          }
          ?>
        </div>
      </div>
    </div>

    <!-- Booking Card -->
    <div class="col-lg-4">
      <div class="card booking-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 class="fw-bold text-primary">YER <?= $room_data['price'] ?></h3>
          <small class="text-muted">per night</small>
        </div>
        
        <div class="d-flex align-items-center mb-4">
          <div class="rating-stars me-2">
            <?php
            echo str_repeat("<i class='bi bi-star-fill'></i>", $avg_rating);
            echo str_repeat("<i class='bi bi-star'></i>", 5 - $avg_rating);
            ?>
          </div>
          <small><?= $avg_rating ?> (<?= $total_reviews ?> reviews)</small>
        </div>
        
        <div class="mb-4">
          <h5 class="fw-bold mb-3"><i class="bi bi-people me-2"></i>Guests</h5>
          <div class="d-flex">
            <div class="me-4">
              <p class="mb-1"><i class="bi bi-person-fill text-primary me-2"></i>Adults</p>
              <span class="badge bg-light text-dark"><?= $room_data['adult'] ?></span>
            </div>
            <div>
              <p class="mb-1"><i class="bi bi-person text-primary me-2"></i>Children</p>
              <span class="badge bg-light text-dark"><?= $room_data['children'] ?></span>
            </div>
          </div>
        </div>
        
        <div class="mb-4">
          <h5 class="fw-bold mb-3"><i class="bi bi-rulers me-2"></i>Room Size</h5>
          <span class="badge bg-light text-dark"><?= $room_data['area'] ?> sq. ft.</span>
        </div>
        
        <?php if (!$settings_r['shutdown']): ?>
          <?php
          $login = (isset($_SESSION['login']) && $_SESSION['login'] == true) ? 1 : 0;
          $btn_class = $login ? 'btn-primary' : 'btn-secondary disabled';
          $btn_text = $login ? 'Book Now' : 'Login to Book';
          ?>
          <button onclick='checkLoginToBook(<?= $login ?>, <?= $room_data['id'] ?>)' 
                  class='btn <?= $btn_class ?> w-100 py-3 fw-bold'>
            <i class="bi bi-calendar-check me-2"></i><?= $btn_text ?>
          </button>
        <?php endif; ?>
      </div>

      <!-- Host Card -->
      <div class="card host-card shadow-sm mt-4 border-0">
        <div class="card-body text-center">
          <?php
          $host_q = mysqli_query($con, "SELECT name, profile, email, phonenum FROM host_cred WHERE id='$room_data[host_id]'");
          $host_data = mysqli_fetch_assoc($host_q);

          if ($host_data) {
            $host_img = HOSTS_IMG_PATH . $host_data['profile'];
            $host_name = $host_data['name'];
            $host_phone = $host_data['phonenum'];

            echo "<img src='$host_img' class='rounded-circle border mb-3' width='100' height='100' style='object-fit:cover;' />
                  <h5 class='fw-bold mb-1'>$host_name</h5>
                  <p class='text-muted mb-3'>Your Host</p>
                  <p class='mb-3'><i class='bi bi-telephone text-primary me-2'></i>$host_phone</p>
                  <button id='message_host' type='button'  
                    data-bs-toggle='modal' data-bs-target='#messagehostmodal' 
                    class='btn btn-outline-primary w-100'>
                    <i class='bi bi-chat-left-text me-2'></i>Message Host
                  </button>";
          } else {
            echo "<p class='text-muted'>Host information not available</p>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Message Host Modal -->
<div class="modal fade" id="messagehostmodal" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="messagehost-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-chat-square-heart-fill text-primary me-2"></i> Message Host
          </h5>
          <button type="reset" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex align-items-center mb-4">
            <img src="<?= $host_img ?>" class="rounded-circle border me-3" width="60" height="60" style="object-fit: cover;" />
            <div>
              <h6 class="fw-bold mb-0"><?= $host_name ?></h6>
              <small class="text-muted"><i class="bi bi-telephone"></i> <?= $host_phone ?></small>
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label">Your Message</label>
            <textarea id="message" rows="4" required class="form-control shadow-none" placeholder="Write your message here..."></textarea>
          </div>
          <input type="hidden" id="sender" value="user" />
          <input type="hidden" name="room_id" id="room_id" value="<?= $room_data['id'] ?>" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require('inc/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  let messagehost_form = document.getElementById('messagehost-form');

  messagehost_form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get fresh values in case form is reused
    let message = document.getElementById('message').value.trim();
    let sender = document.getElementById('sender').value;
    let room_id = document.getElementById('room_id').value;

    // Validate message
    if(message === '') {
      alert('error', 'Please enter a message');
      return;
    }

    let data = new FormData();
    data.append('message', message);
    data.append('sender', sender);
    data.append('room_id', room_id);
    data.append('messagehost_form', 'true');

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajax/Messages.php', true);

    xhr.onload = function() {
      if(this.responseText == '1') {
        alert('success', 'Your message has been sent!');
        // Hide modal and reset form
        var modal = bootstrap.Modal.getInstance(document.getElementById('messagehostmodal'));
        if(modal) modal.hide();
        messagehost_form.reset();
      } else {
        alert('error', this.responseText || 'Error sending message');
      }
    };

    xhr.onerror = function() {
      alert('error', 'Request failed');
    };

    xhr.send(data);
  });
});


</script>

</body>
</html>