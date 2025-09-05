<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - CONFIRM BOOKING</title>
  <style>
    .booking-header {
      background: #3498db;
      padding:0;
      color: white;
      margin-bottom: 40px;
    }
    .room-card {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .room-card:hover {
      transform: translateY(-5px);
    }
    .room-card img {
      height: 250px;
      object-fit: cover;
    }
    .booking-card {
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
    .payment-option {
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
      transition: all 0.3s ease;
    }
    .payment-option:hover {
      border-color: #0d6efd;
      background-color: #f8f9fa;
    }
    .payment-option.selected {
      border-color: #0d6efd;
      background-color: #f0f7ff;
    }
    .form-control:disabled, .form-control[readonly] {
      background-color: #f8f9fa;
    }
    #pay_info {
      min-height: 80px;
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <?php 
    if(!isset($_GET['id']) || $settings_r['shutdown']==true){
      redirect('rooms.php');
    }
    else if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
      redirect('rooms.php');
    }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0){
      redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    $_SESSION['room'] = [
      "id" => $room_data['id'],
      "name" => $room_data['name'],
      "price" => $room_data['price'],
      "payment" => null,
      "available" => false,
    ];

    $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], "i");
    $user_data = mysqli_fetch_assoc($user_res);
  ?>

  <!-- Booking Header -->
  <div class="booking-header">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h1 class="fw-bold">Confirm Your Booking</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item"><a href="index.php" class="text-white">Home</a></li>
              <li class="breadcrumb-item active text-white" aria-current="page">Booking</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="container pb-5">
    <div class="row g-4">

      <!-- Room Summary -->
      <div class="col-lg-7">
        <div class="room-card">
          <?php 
            $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
            $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

            if(mysqli_num_rows($thumb_q)>0){
              $thumb_res = mysqli_fetch_assoc($thumb_q);
              $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
            }

            echo<<<data
              <img src="$room_thumb" class="img-fluid w-100">
              <div class="p-4">
                <h3 class="fw-bold">$room_data[name]</h3>
                <div class="d-flex align-items-center mb-3">
                  <h4 class="text-primary mb-0">YER$room_data[price]</h4>
                  <small class="text-muted ms-2">/ night</small>
                </div>
                <p class="mb-0"><i class="bi bi-geo-alt-fill text-secondary me-2"></i>$room_data[location]</p>
              </div>
            data;
          ?>
        </div>
      </div>

      <!-- Booking Form -->
      <div class="col-lg-5">
        <div class="booking-card p-4">
          <h3 class="fw-bold mb-4">Booking Details</h3>
          <form action="pay_now.php" method="POST" id="booking_form">
            
            <!-- Personal Info -->
            <div class="mb-4">
              <h5 class="fw-bold mb-3"><i class="bi bi-person-fill text-primary me-2"></i>Personal Information</h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Full Name</label>
                  <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Phone Number</label>
                  <input name="phonenum" type="number" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>
                </div>
                <div class="col-12 mb-3">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control shadow-none" rows="2" required><?php echo $user_data['address'] ?></textarea>
                </div>
              </div>
            </div>

            <!-- Dates -->
            <div class="mb-4">
              <h5 class="fw-bold mb-3"><i class="bi bi-calendar-range text-primary me-2"></i>Booking Dates</h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Check-in Date</label>
                  <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Check-out Date</label>
                  <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                </div>
              </div>
            </div>

            <!-- Availability Info -->
            <div class="mb-4 p-3 bg-light rounded">
              <div class="d-flex justify-content-center">
                <div class="spinner-border text-primary mb-3 d-none" id="info_loader" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <div id="pay_info" class="text-center">
                <p class="mb-0 text-muted">Please select check-in and check-out dates</p>
              </div>
            </div>

            <!-- Payment Options -->
            <div class="mb-4">
              <h5 class="fw-bold mb-3"><i class="bi bi-credit-card text-primary me-2"></i>Payment Options</h5>
              
              <div class="payment-option" onclick="selectPayment('full')">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="pay" id="full_payment" value="full" required>
                  <label class="form-check-label fw-bold" for="full_payment">
                    Pay in Full
                  </label>
                  <p class="mb-0 text-muted" id="pay_plan">Select dates to see amount</p>
                </div>
              </div>
              
              <div class="payment-option" onclick="selectPayment('partial')">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="pay" id="partial_payment" value="partial">
                  <label class="form-check-label fw-bold" for="partial_payment">
                    Pay Partial Now
                  </label>
                  <p class="mb-0 text-muted" id="pay_plan1">Select dates to see payment plan</p>
                </div>
              </div>
            </div>

            <!-- Payment Method -->
            <div class="mb-4">
              <h5 class="fw-bold mb-3"><i class="bi bi-wallet2 text-primary me-2"></i>Payment Method</h5>
              <select class="form-select shadow-none mb-3" required>
                <option value="">Select payment method</option>
                <option value="paypal">PayPal</option>
                <option value="credit_card">Credit/Debit Card</option>
                <option value="kuraimi">Kuraimi IMB</option>
                <option value="jawali">Jawali</option>
              </select>
              <input name="account" type="password" class="form-control shadow-none" placeholder="Account/Card Number" required>
            </div>

            <!-- Submit Button -->
            <button name="pay_now" class="btn btn-primary w-100 py-3 fw-bold" disabled>
              <i class="bi bi-lock-fill me-2"></i>Complete Booking
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <?php require('inc/footer.php'); ?>

  <script>
    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');
    let pay_plan = document.getElementById('pay_plan');
    let pay_plan1 = document.getElementById('pay_plan1');

    function selectPayment(type) {
      document.querySelectorAll('.payment-option').forEach(opt => {
        opt.classList.remove('selected');
      });
      if(type === 'full') {
        document.getElementById('full_payment').checked = true;
        document.querySelector('#full_payment').closest('.payment-option').classList.add('selected');
      } else {
        document.getElementById('partial_payment').checked = true;
        document.querySelector('#partial_payment').closest('.payment-option').classList.add('selected');
      }
    }

    function check_availability() {
      let checkin_val = booking_form.elements['checkin'].value;
      let checkout_val = booking_form.elements['checkout'].value;

      booking_form.elements['pay_now'].setAttribute('disabled',true);

      if(checkin_val!='' && checkout_val!='') {
        pay_info.innerHTML = '<p class="mb-0 text-muted">Checking availability...</p>';
        info_loader.classList.remove('d-none');

        let data = new FormData();
        data.append('check_availability','');
        data.append('check_in',checkin_val);
        data.append('check_out',checkout_val);

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/confirm_booking.php",true);

        xhr.onload = function() {
          let data = JSON.parse(this.responseText);
          let html = '';

          if(data.status == 'check_in_out_equal') {
            html = '<p class="mb-0 text-danger">You cannot check-out on the same day!</p>';
          }
          else if(data.status == 'check_out_earlier') {
            html = '<p class="mb-0 text-danger">Check-out date is earlier than check-in date!</p>';
          }
          else if(data.status == 'check_in_earlier') {
            html = '<p class="mb-0 text-danger">Check-in date is earlier than today!</p>';
          }
          else if(data.status == 'unavailable') {
            html = '<p class="mb-0 text-danger">Room not available for selected dates!</p>';
          }
          else {
            html = `
              <div class="text-start">
                <p class="mb-1"><strong>Nights:</strong> ${data.days}</p>
                <p class="mb-1"><strong>Total Amount:</strong> YER ${data.payment}</p>
                <p class="mb-0 text-success">Room available for booking!</p>
              </div>
            `;
            pay_plan.innerHTML = `YER ${data.payment} today`;
            pay_plan1.innerHTML = `Pay YER ${data.payment/2} today, YER ${data.payment/2} on ${checkout_val}`;
            booking_form.elements['pay_now'].removeAttribute('disabled');
          }

          pay_info.innerHTML = html;
          info_loader.classList.add('d-none');
        }

        xhr.send(data);
      }
    }
  </script>

</body>
</html>