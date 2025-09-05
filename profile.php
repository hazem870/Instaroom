<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - PROFILE</title>
</head>
<body class="bg-light">
  <?php 
    require('inc/header.php'); 

    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
      redirect('index.php');
    }

    $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 's');

    if (mysqli_num_rows($u_exist) == 0) {
      redirect('index.php');
    }

    $u_fetch = mysqli_fetch_assoc($u_exist);
  ?>

  <div class="container py-4">
    <!-- Page Title & Breadcrumb -->
    <div class="mb-4">
      <h2 class="fw-bold mb-1"><i class="bi bi-person-circle me-2"></i>My Profile</h2>
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb small">
          <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Home</a></li>
          <li class="breadcrumb-item active text-dark" aria-current="page">Profile</li>
        </ol>
      </nav>
    </div>

    <!-- Switch Button -->
    <div class="mb-3">
      <?php
        $host_switch = select("SELECT * FROM `host_cred` WHERE `email`=?", [$u_fetch['email']], 's');
        $row = mysqli_fetch_assoc($host_switch);

        if (mysqli_num_rows($host_switch) > 0) {
          echo "<a href='host/index.php' class='btn btn-outline-primary'><i class='bi bi-house-door me-1'></i> Switch To Hosting</a>";
        } else {
          echo "<a href='contact.php' class='btn btn-outline-secondary'><i class='bi bi-plus-circle me-1'></i> Want To Be A Host?</a>";
        }
      ?>
    </div>

    <div class="row gy-4">
      <!-- Basic Info -->
      <div class="col-12">
        <div class="bg-white p-4 rounded shadow-sm">
          <form id="info-form">
            <h5 class="fw-bold mb-4"><i class="bi bi-info-circle me-2"></i>Basic Information</h5>
            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Phone Number</label>
                <input name="phonenum" type="number" value="<?php echo $u_fetch['phonenum'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Date of Birth</label>
                <input name="dob" type="date" value="<?php echo $u_fetch['dob'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Pincode</label>
                <input name="pincode" type="number" value="<?php echo $u_fetch['pincode'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-8 mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none" rows="2" required><?php echo $u_fetch['address'] ?></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-primary shadow-none"><i class="bi bi-save me-1"></i>Save Changes</button>
          </form>
        </div>
      </div>

      <!-- Profile Picture -->
      <div class="col-md-4">
        <div class="bg-white p-4 rounded shadow-sm text-center">
          <form id="profile-form">
            <h5 class="fw-bold mb-3"><i class="bi bi-image me-2"></i>Profile Picture</h5>
            <img src="<?php echo USERS_IMG_PATH.$u_fetch['profile'] ?>" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="mb-3">
              <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
            </div>
            <button type="submit" class="btn btn-primary shadow-none"><i class="bi bi-upload me-1"></i>Upload New Picture</button>
          </form>
        </div>
      </div>

      <!-- Change Password -->
<div class="col-md-8">
  <div class="bg-white p-4 rounded shadow-sm">
    <form id="pass-form">
      <h5 class="fw-bold mb-3"><i class="bi bi-lock me-2"></i>Change Password</h5>
      <div class="row">
        <div class="col-md-6 mb-3 position-relative">
          <label class="form-label">New Password</label>
          <div class="input-group">
            <input name="new_pass" type="password" class="form-control shadow-none pe-5" required>
            <span class="position-absolute end-0 top-50 translate-middle-y pe-3 toggle-password" style="cursor: pointer; z-index: 5;">
              <i class="bi bi-eye-fill text-muted"></i>
            </span>
          </div>
        </div>
        <div class="col-md-6 mb-3 position-relative">
          <label class="form-label">Confirm Password</label>
          <div class="input-group">
            <input name="confirm_pass" type="password" class="form-control shadow-none pe-5" required>
            <span class="position-absolute end-0 top-50 translate-middle-y pe-3 toggle-password" style="cursor: pointer; z-index: 5;">
              <i class="bi bi-eye-fill text-muted"></i>
            </span>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary shadow-none"><i class="bi bi-key me-1"></i>Update Password</button>
    </form>
  </div>
</div>

  <?php require('inc/footer.php'); ?>


  <script>

    let info_form = document.getElementById('info-form');

    info_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('info_form','');
      data.append('name',info_form.elements['name'].value);
      data.append('phonenum',info_form.elements['phonenum'].value);
      data.append('address',info_form.elements['address'].value);
      data.append('pincode',info_form.elements['pincode'].value);
      data.append('dob',info_form.elements['dob'].value);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function(){
        if(this.responseText == 'phone_already'){
          alert('error',"Phone number is already registered!");
        }
        else if(this.responseText == 0){
          alert('error',"No Changes Made!");
        }
        else{
          alert('success','Changes saved!');
          window.location.href=window.location.pathname;
        }
      }

      xhr.send(data);

    });

    
    let profile_form = document.getElementById('profile-form');

    profile_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('profile_form','');
      data.append('profile',profile_form.elements['profile'].files[0]);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function()
      {
        if(this.responseText == 'inv_img'){
          alert('error',"Only JPG, WEBP & PNG images are allowed!");
        }
        else if(this.responseText == 'upd_failed'){
          alert('error',"Image upload failed!");
        }
        else if(this.responseText == 0){
          alert('error',"Updation failed!");
        }
        else{
          alert('success','Changes saved!');
          window.location.href=window.location.pathname;
        }
      }

      xhr.send(data);
    });


    let pass_form = document.getElementById('pass-form');

    pass_form.addEventListener('submit',function(e){
      e.preventDefault();

      let new_pass = pass_form.elements['new_pass'].value;
      let confirm_pass = pass_form.elements['confirm_pass'].value;

      if(new_pass!=confirm_pass){
        alert('error','Password do not match!');
        return false;
      }


      let data = new FormData();
      data.append('pass_form','');
      data.append('new_pass',new_pass);
      data.append('confirm_pass',confirm_pass);

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/profile.php",true);

      xhr.onload = function()
      {
        if(this.responseText == 'mismatch'){
          alert('error',"Password do not match!");
        }
        else if(this.responseText == 0){
          alert('error',"Updation failed!");
        }
        else{
          alert('success','Changes saved!');
          pass_form.reset();
        }
      }

      xhr.send(data);
    });

  </script>


</body>
</html>