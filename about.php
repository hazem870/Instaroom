<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"> -->
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - ABOUT</title>
  <style>
    :root {
      --primary-color: #4e73df;
      --primary-hover: #3a5ec2;
      --teal: #20c997;
      --teal-dark: #17a673;
    }
    
    .hero-section {
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6));
      background-size: cover;
      background-position: center;
      color: white;
      padding: 10px 0;
    }
    
    .h-line {
      height: 3px;
      background: linear-gradient(90deg, var(--teal), var(--teal-dark));
      width: 100px;
      margin: 15px auto;
    }
    
    .feature-box {
      border-top: 4px solid var(--teal);
      transition: all 0.3s ease;
      height: 100%;
    }
    
    .feature-box:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .team-member {
      transition: all 0.3s ease;
      border-radius: 10px;
      overflow: hidden;
    }
    
    .team-member:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .team-member img {
      transition: all 0.5s ease;
    }
    
    .team-member:hover img {
      transform: scale(1.05);
    }
    
    .team-member h5 {
      color: var(--primary-color);
      margin-top: 15px;
    }
    
    .team-member p {
      color: #6c757d;
    }
    
    /* .swiper-pagination-bullet-active {
      background: var(--teal) !important;
    } */
    
    @media (max-width: 768px) {
      .hero-section {
        padding: 60px 0;
      }
    }
  </style>
</head>
<body class="bg-light">

  <?php require('inc/header.php'); ?>

  <!-- Hero Section -->
  <div class="hero-section">
    <div class="container text-center">
      <h1 class="fw-bold display-4 mb-3">About Our Instaroom WebSite</h1>
      <div class="h-line"></div>
      <p class="lead mb-0">Discover our story and what makes us special</p>
    </div>
  </div>

  <!-- About Content -->
  <div class="container py-5">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-4 col-md-4 mb-4">
        <img src="images/about/aboutus.jpg" class="w-100 h-100 rounded shadow" alt="Our Hotel">
      </div>
      <div class="col-lg-6 col-md-6 mb-4">
        <h2 class="fw-bold mb-4">Our Story</h2>
        <p class="lead">
          Founded in 2025, our hotel has been providing exceptional hospitality services to guests from around the world.
        </p>
        <p>
          The InstaRoom platform was designed, developed, and tested to meet the needs of a modern, secure, 
          and user-centric hotel booking system. It serves as a strong foundation for future innovation in the 
          tourism and hospitality sector in Yemen and beyond.
        </p>
        <p>
          Our mission is to create unforgettable experiences for our guests through personalized service, luxurious accommodations, and attention to every detail.
        </p>
        <div class="d-flex gap-3 mt-4">
          
          <a href="contact.php" class="btn btn-outline-primary px-4">Contact Us</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Section -->
  <div class="container py-5">
    <div class="row">
      <div class="col-12 text-center mb-5">
        <h2 class="fw-bold">By The Numbers</h2>
        <div class="h-line mx-auto"></div>
        <p class="text-muted">Our achievements in hospitality</p>
      </div>
      
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="bg-white rounded shadow p-4 feature-box text-center h-100">
          <img src="images/about/hotel.svg" width="70px" alt="Rooms Icon">
          <h3 class="mt-3 fw-bold">100+</h3>
          <p class="mb-0 text-muted">Luxurious Rooms</p>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="bg-white rounded shadow p-4 feature-box text-center h-100">
          <img src="images/about/customers.svg" width="70px" alt="Customers Icon">
          <h3 class="mt-3 fw-bold">200+</h3>
          <p class="mb-0 text-muted">Happy Customers</p>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="bg-white rounded shadow p-4 feature-box text-center h-100">
          <img src="images/about/rating.svg" width="70px" alt="Reviews Icon">
          <h3 class="mt-3 fw-bold">150+</h3>
          <p class="mb-0 text-muted">5-Star Reviews</p>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="bg-white rounded shadow p-4 feature-box text-center h-100">
          <img src="images/about/staff.svg" width="70px" alt="Staff Icon">
          <h3 class="mt-3 fw-bold">200+</h3>
          <p class="mb-0 text-muted">Dedicated Staff</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Team Section -->
  <div class="container-fluid bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-5">
          <h2 class="fw-bold">Meet Our Team</h2>
          <div class="h-line mx-auto"></div>
          <p class="text-muted">The passionate people behind our success</p>
        </div>
      </div>
      
      <div class="container">
        <div class="row pb-5">
          <?php 
            $about_r = selectAll('team_details');
            $path = ABOUT_IMG_PATH;
            while($row = mysqli_fetch_assoc($about_r)){
              echo<<<data
                <div class="col-lg-3 col-md-6 mb-4 px-3">
                  <div class="team-member bg-white p-2 text-center rounded shadow">
                    <div class="overflow-hidden rounded">
                      <img src="$path$row[picture]" class="w-100" alt="$row[name]">
                    </div>
                    <h3 class="fw-bold mt-3">$row[name]</h3>
                    
                  </div>
                </div>
              data;
            }
          ?>
        </div>
        <div class=""></div>
      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>

  

</body>
</html>