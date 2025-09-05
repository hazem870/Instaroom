<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
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
  </style>
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - BOOKINGS</title>
</head>
<body class="bg-light">

  <?php 
    require('inc/header.php'); 

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
      redirect('index.php');
    }
  ?>


  <div class="container">
    <div class="row">
      <div class="col-12 my-3 px-4">
        <h2 class="fw-bold">BOOKINGS</h2>
        <div style="font-size: 14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">BOOKINGS</a>
        </div>
      </div>
      <div class="position-sticky top-0 bg-white z-3 shadow-sm p-3 rounded mb-4" style="z-index: 1000;">
  <form method="get" class="row g-2 align-items-center">
    <div class="col-md-4">
      <input type="text" name="search" class="form-control shadow-none" placeholder="Search by room name" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    </div>
    <div class="col-md-4">
      <select name="status" class="form-select shadow-none">
        <option value="">All Statuses</option>
        <option value="Booked" <?= (isset($_GET['status']) && $_GET['status'] == 'Booked') ? 'selected' : '' ?>>Booked</option>
        <option value="Cancelled" <?= (isset($_GET['status']) && $_GET['status'] == 'Cancelled') ? 'selected' : '' ?>>Cancelled</option>
        <option value="Payment failed" <?= (isset($_GET['status']) && $_GET['status'] == 'Payment failed') ? 'selected' : '' ?>>Payment Failed</option>
      </select>
    </div>
    <div class="col-md-4 text-end">
      <button type="submit" class="btn btn-dark shadow-none">
        <i class="fa fa-filter me-1"></i> Apply Filter
      </button>
    </div>
  </form>
</div>


      <?php 
        
        
        $q = "SELECT bo.*, bd.* FROM booking_order bo
      INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id
      WHERE bo.user_id=?";

$values = [$_SESSION['uId']];

// فلترة بالحالة
if (!empty($_GET['status'])) {
  $q .= " AND bo.booking_status=?";
  $values[] = $_GET['status'];
}

// بحث باسم الغرفة
if (!empty($_GET['search'])) {
  $q .= " AND bd.room_name LIKE ?";
  $values[] = "%" . $_GET['search'] . "%";
}

$q .= " ORDER BY bo.booking_id DESC";
$res = select($q, $values, 'i' . str_repeat('s', count($values)-1));

if(mysqli_num_rows($res)==0){
  echo '<div class="empty-wishlist col-12 text-center">
      <i class="bi bi-heartbreak"></i>
      <h4 class="fw-bold mb-3">Your booking list is empty</h4>
      <p class="text-muted mb-4">Start booking rooms you love by clicking the booking</p>
      <a href="index.php" class="btn btn-primary px-4">Explore Rooms</a>
  </div>';
}


        while($data = mysqli_fetch_assoc($res))
        {
          $date = date("d-m-Y",strtotime($data['datentime']));
          $checkin = date("d-m-Y",strtotime($data['check_in']));
          $checkout = date("d-m-Y",strtotime($data['check_out']));

          $status_bg = "";
          $btn = "";
          
          if($data['booking_status']=='booked')
          {
            $status_bg = "bg-success";
            if($data['arrival']==1)
            {
              $btn="<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
 
              if($data['rate_review']==0){
                $btn.="<button type='button' onclick='review_room($data[booking_id],$data[room_id])' data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-dark btn-sm shadow-none ms-2'>Rate & Review</button>";
              }
            }
            else{
              $btn="<button onclick='cancel_booking($data[booking_id])' type='button' class='btn btn-danger btn-sm shadow-none'>Cancel</button>";
            }
          }
          else if($data['booking_status']=='cancelled')
          {
            $status_bg = "bg-danger";

            if($data['refund']==0){
              $btn="<span class='badge bg-primary'>Refund in process!</span>";
            }
            else{
              $btn="<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
            }
          }
          else
          {
            $status_bg = "bg-warning";
            $btn="<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Download PDF</a>";
          }

          echo <<<bookings
  <div class='col-lg-4 col-md-6 col-sm-12 mb-4'>
    <div class='bg-white p-4 rounded booking-card'>
      <h5 class='fw-bold'><i class="bi bi-house-door-fill me-2"></i>$data[room_name]</h5>
      <p class='text-muted mb-1'><i class="bi bi-cash-coin me-1 text-success"></i> YER$data[price] per night</p>

      <div class="booking-info">
        <p><i class="bi bi-calendar-check me-1 text-primary"></i> <b>Check-in:</b> $checkin</p>
        <p><i class="bi bi-calendar-x me-1 text-danger"></i> <b>Check-out:</b> $checkout</p>
        <p><i class="bi bi-receipt me-1 text-dark"></i> <b>Order ID:</b> $data[order_id]</p>
        <p><i class="bi bi-clock-history me-1 text-secondary"></i> <b>Date:</b> $date</p>
        <p><i class="bi bi-wallet2 me-1 text-warning"></i> <b>Amount:</b> YER$data[price]</p>
      </div>

      <div class="mt-2">
        <span class="badge booking-status $status_bg text-white text-uppercase fw-semibold">$data[booking_status]</span>
      </div>

      <div class="booking-actions d-flex flex-wrap gap-2 mt-3">
        $btn
      </div>
    </div>
  </div>
bookings;
        }

      ?>


    </div>
  </div>


  <div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form id="review-form">
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title d-flex align-items-center mb-0">
                        <i class="bi bi-star-fill me-2"></i> Share Your Experience
                    </h5>
                    <button type="reset" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="star-rating-wrapper text-center mb-4">
                        <h6 class="mb-3">How would you rate your stay?</h6>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5" class="star-label" title="Excellent">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                            </label>
                            
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" class="star-label" title="Good">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                            </label>
                            
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" class="star-label" title="Average">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                            </label>
                            
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" class="star-label" title="Poor">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                            </label>
                            
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" class="star-label" title="Terrible">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                            </label>
                        </div>
                        <div class="rating-description mt-2 text-muted small">Select your rating</div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Your Review</label>
                        <textarea name="review" rows="4" required class="form-control shadow-none" 
                            placeholder="Share details about your experience..."></textarea>
                        <div class="form-text">Your honest feedback helps others make better choices</div>
                    </div>
                    
                    <input type="hidden" name="booking_id">
                    <input type="hidden" name="room_id">

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <button type="reset" class="btn btn-outline-secondary shadow-none" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary px-4 shadow-none">
                            <i class="bi bi-send-fill me-1"></i> Submit Review
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



  <?php 
    if(isset($_GET['cancel_status'])){
      alert('success','Booking Cancelled!');
    }  
    else if(isset($_GET['review_status'])){
      alert('success','Thank you for rating & review!');
    }  
  ?>

  <?php require('inc/footer.php'); ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const starInputs = document.querySelectorAll('.star-rating input');
    const ratingDescription = document.querySelector('.rating-description');
    
    const descriptions = {
        '5': 'Excellent - Far exceeded expectations!',
        '4': 'Good - Very satisfying experience',
        '3': 'Average - Met expectations',
        '2': 'Poor - Below average experience',
        '1': 'Terrible - Very disappointing'
    };
    
    // Set first star as checked by default
    document.getElementById('star5').checked = true;
    
    starInputs.forEach(input => {
        input.addEventListener('change', function() {
            ratingDescription.textContent = descriptions[this.value];
            ratingDescription.style.color = '#ffc107';
            ratingDescription.style.fontWeight = '500';
        });
        
        input.addEventListener('mouseover', function() {
            ratingDescription.textContent = descriptions[this.value];
        });
    });
    
    document.querySelector('.star-rating').addEventListener('mouseleave', function() {
        const checkedInput = document.querySelector('.star-rating input:checked');
        if (checkedInput) {
            ratingDescription.textContent = descriptions[checkedInput.value];
        }
        ratingDescription.style.color = '#6c757d';
        ratingDescription.style.fontWeight = 'normal';
    });
});

    function cancel_booking(id)
    {
      if(confirm('Are you sure to cancel booking?'))
      {        
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/cancel_booking.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
          if(this.responseText==1){
            window.location.href="bookings.php?cancel_status=true";
          }
          else{
            alert('error','Cancellation Failed!');
          }
        }

        xhr.send('cancel_booking&id='+id);
      }
    }

    let review_form = document.getElementById('review-form');

    function review_room(bid,rid){
      review_form.elements['booking_id'].value = bid;
      review_form.elements['room_id'].value = rid;
    }

    review_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();

      data.append('review_form','');
      data.append('rating',review_form.elements['rating'].value);
      data.append('review',review_form.elements['review'].value);
      data.append('booking_id',review_form.elements['booking_id'].value);
      data.append('room_id',review_form.elements['room_id'].value);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/review_room.php",true);

      xhr.onload = function()
      {

        if(this.responseText == 1)
        {
          window.location.href = 'bookings.php?review_status=true';
        }
        else{
          var myModal = document.getElementById('reviewModal');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();
  
          alert('error',"Rating & Review Failed!");
        }
      }

      xhr.send(data);
    })

  </script>


</body>
</html>