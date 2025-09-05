<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo htmlspecialchars($settings_r['site_title']); ?> - HOME</title>
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #3498db;
      --accent-color: #e74c3c;
      --light-color: #ecf0f1;
      --dark-color: #2c3e50;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }
    
    .search-container {
      transition: all 0.3s ease;
      border-left: 4px solid var(--secondary-color);
      border-radius:40px 0;
    }
    
    .search-container:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .price-tag {
      background: linear-gradient(135deg, #3a7bd5, #00d2ff);
      color: white;
      padding: 5px 5px;
      border-radius: 20px;
      font-weight: 600;
    }
    
    
  </style>
</head>
<body class="bg-light">
  <?php require('inc/header.php'); ?>

  <!-- Hero Search Section -->
  <div class="container sticky-top my-2">
    <div class="row justify-content-center">
      <div class="col-lg-10" >
        <div class="search-container p-2 bg-white shadow-sm d-flex align-items-center justify-content-between" 
            data-bs-toggle="modal" data-bs-target="#filterModal" role="button" >
          <div>
            <h5 class="text-dark mb-1">Check Booking Availability</h5>
            <p class="text-muted small mb-0">Click to search for available rooms</p>
          </div>
          <button type="button" class="btn btn-primary rounded-circle" style="width: 40px; height: 40px;">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Rooms Section -->
  <div class="container mb-5">
    <div class="row px-lg-4" id="rooms-data">
      <!-- Rooms will be loaded here dynamically -->
      <div class="spinner-border text-info mb-3 d-block mx-auto" id="loader" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>

  <!-- Password Reset Modal -->
  <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="recovery-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-shield-lock fs-3 me-2"></i> Set up New Password
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-4">
              <label class="form-label fw-bold">New Password</label>
              <div class="input-group">
                <input type="password" name="pass" required class="form-control shadow-none" placeholder="Enter new password">
                <span class="input-group-text"><i class="bi bi-key"></i></span>
              </div>
              <div class="form-text">Minimum 8 characters with at least one number and one letter</div>
              <input type="hidden" name="email">
              <input type="hidden" name="token">
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button type="button" class="btn btn-outline-secondary me-md-2" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>
  
  <?php
    if(isset($_GET['account_recovery']))
    {
      $data = filteration($_GET);
      $t_date = date("Y-m-d");
      $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
        [$data['email'],$data['token'],$t_date],'sss');
      if(mysqli_num_rows($query)==1)
      {
        // Escape email and token for safe JS output
        $email_js = htmlspecialchars($data['email'], ENT_QUOTES);
        $token_js = htmlspecialchars($data['token'], ENT_QUOTES);
        echo<<<showModal
          <script>
            var myModal = document.getElementById('recoveryModal');
            myModal.querySelector("input[name='email']").value = '$email_js';
            myModal.querySelector("input[name='token']").value = '$token_js';
            var modal = bootstrap.Modal.getOrCreateInstance(myModal);
            modal.show();
          </script>
        showModal;
      }
      else{
        alert("error","Invalid or Expired Link !");
      }
    }
  ?>

  <script>
    // recover account
    let recovery_form = document.getElementById('recovery-form');
    recovery_form.addEventListener('submit', (e)=>{
      e.preventDefault();
      let data = new FormData();
      data.append('email',recovery_form.elements['email'].value);
      data.append('token',recovery_form.elements['token'].value);
      data.append('pass',recovery_form.elements['pass'].value);
      data.append('recover_user','');
      
      var myModal = document.getElementById('recoveryModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();
      
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/login_register.php",true);

      xhr.onload = function(){
        if(this.responseText == 'failed'){
          alert('error',"Account reset failed!");
        }
        else{
          alert('success',"Account Reset Successful !");
          recovery_form.reset();
        }
      }
      xhr.send(data);
    });

    // filter functions remain the same as original
    let rooms_data = document.getElementById('rooms-data');
    let checkin = document.getElementById('checkin');
    let checkout = document.getElementById('checkout');
    let chk_avail_btn = document.getElementById('chk_avail_btn');
    let adults = document.getElementById('adults');
    let children = document.getElementById('children');
    let guests_btn = document.getElementById('guests_btn');
    let facilities_btn = document.getElementById('facilities_btn');
    let price_range = document.getElementById('price_range');
    let price_value = document.getElementById('price_value');
    let price_btn = document.getElementById('price_btn');
    let search = document.getElementById('search');
    let search_btn = document.getElementById('search_btn');

    function fetch_rooms() {
      let chk_avail = JSON.stringify({
        checkin: checkin.value,
        checkout: checkout.value
      });

      let guests = JSON.stringify({
        adults: adults.value,
        children: children.value
      });

      let facility_list = {"facilities":[]};
      let get_facilities = document.querySelectorAll('[name="facilities"]:checked');
      if(get_facilities.length>0) {
        get_facilities.forEach((facility)=>{
          facility_list.facilities.push(facility.value);
        });
        facilities_btn.classList.remove('d-none');
      }
      else {
        facilities_btn.classList.add('d-none');
      }

      facility_list = JSON.stringify(facility_list);
      let price = price_range.value;
      let xhr = new XMLHttpRequest();
      xhr.open("GET","ajax/rooms.php?fetch_rooms&chk_avail="+chk_avail+"&guests="+guests+"&facility_list="+facility_list+"&price="+price+"&search="+search.value,true);
      xhr.onprogress = function(){
        rooms_data.innerHTML = `<div class="spinner-border text-info mb-3 d-block mx-auto" id="loader" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>`;
      }

      xhr.onload = function(){
        rooms_data.innerHTML = this.responseText;
      }

      xhr.send();
    }

    function search_filter(){
      if(search.value.trim() != ''){
        fetch_rooms();
        search_btn.classList.remove('d-none');
      }
    }

    function search_clear(){
      search.value='';
      search_btn.classList.add('d-none');
      fetch_rooms();
    }

    function price_filter(){
      price_value.innerText = price_range.value;
      fetch_rooms();
      price_btn.classList.remove('d-none');
    }

    function price_clear(){
      price_range.value = 5000;
      price_value.innerText = price_range.value;
      price_btn.classList.add('d-none');
      fetch_rooms();
    }

    function chk_avail_filter(){
      if(checkin.value!='' && checkout.value !=''){
        fetch_rooms();
        chk_avail_btn.classList.remove('d-none');
      }
    }

    function chk_avail_clear(){
      checkin.value='';
      checkout.value='';
      chk_avail_btn.classList.add('d-none');
      fetch_rooms();
    }

    function guests_filter(){
      if(adults.value>0 || children.value>0){
        fetch_rooms();
        guests_btn.classList.remove('d-none');
      }
    }

    function guests_clear(){
      adults.value='';
      children.value='';
      guests_btn.classList.add('d-none');
      fetch_rooms();
    }

    function facilities_clear(){
      let get_facilities = document.querySelectorAll('[name="facilities"]:checked');
      get_facilities.forEach((facility)=>{
        facility.checked=false;
      });
      facilities_btn.classList.add('d-none');
      fetch_rooms();
    }
    
    window.onload = function(){
      fetch_rooms();
    }
  </script>
</body>
</html>