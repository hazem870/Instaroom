<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - Contact Us</title>
  <style>
    :root {
      --primary-color: #4e73df;
      --primary-hover: #3a5ec2;
      --success-color: #1cc88a;
      --teal: #20c997;
      --teal-dark: #17a673;
    }
    
    body {
      background-color: #f8f9fc;
      font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    
    .contact-info i {
      color: var(--teal);
      margin-right: 8px;
      font-size: 1.1rem;
    }
    
    .contact-info a {
      transition: all 0.3s ease;
    }
    
    .contact-info a:hover {
      color: var(--teal-dark);
      transform: translateX(3px);
    }
    
    .custom-bg {
      background-color: var(--teal);
      border: none;
      transition: all 0.3s ease;
    }
    
    .custom-bg:hover {
      background-color: var(--teal-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(32, 201, 151, 0.3);
    }
    
    .contact-card {
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(58, 59, 69, 0.1);
      transition: all 0.3s ease;
    }
    
    .contact-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(58, 59, 69, 0.15);
    }
    
    .social-icon {
      font-size: 1.3rem;
      transition: all 0.3s ease;
    }
    
    .social-icon:hover {
      transform: scale(1.2);
      color: var(--teal-dark);
    }
    
    .form-control, .form-control:focus {
      border-radius: 8px;
      padding: 12px 15px;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: var(--teal);
      box-shadow: 0 0 0 0.25rem rgba(32, 201, 151, 0.25);
    }
    
    .h-line {
      height: 3px;
      background: linear-gradient(90deg, var(--teal), var(--teal-dark));
    }
    
    .file-input-label {
      display: block;
      padding: 12px;
      border: 2px dashed #d1d3e2;
      border-radius: 8px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .file-input-label:hover {
      border-color: var(--teal);
      background-color: rgba(32, 201, 151, 0.05);
    }
    
    .file-input-label i {
      font-size: 2rem;
      color: var(--teal);
      margin-bottom: 10px;
    }
    
    .file-name {
      margin-top: 10px;
      font-size: 0.9rem;
      color: #6c757d;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .contact-card {
        margin-bottom: 2rem;
      }
    }
  </style>
</head>
<body class="bg-light">

<?php 
require('inc/header.php');
$user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], "i");
$user_data = mysqli_fetch_assoc($user_res);
?>

<!-- Title Section -->
<div class="my-5 px-4 text-center">
  <h2 class="fw-bold h-font">CONTACT US</h2>
  <div class="h-line mx-auto my-3" style="width: 100px;"></div>
  <p class="text-muted mt-3 fs-5">
    Have questions or inquiries? Our team is ready to assist you.
  </p>
</div>

<!-- Main Content -->
<div class="container">
  <div class="row">
    
    <!-- Contact Info -->
    <div class="col-lg-6 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 contact-card">
        <iframe class="w-100 rounded mb-4" height="320" src="<?php echo $contact_r['iframe'] ?>" loading="lazy" style="border: none;"></iframe>

        <div class="contact-info">
          <h5 class="fw-semibold mb-3"><i class="bi bi-geo-alt-fill"></i> Address</h5>
          <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-block text-decoration-none text-dark mb-4">
            <?php echo $contact_r['address'] ?>
          </a>

          <h5 class="fw-semibold mb-3"><i class="bi bi-telephone-fill"></i> Call Us</h5>
          <a href="tel:+<?php echo $contact_r['pn1'] ?>" class="d-block text-decoration-none text-dark mb-2">
            +<?php echo $contact_r['pn1'] ?>
          </a>
          <?php if($contact_r['pn2']) : ?>
            <a href="tel:+<?php echo $contact_r['pn2'] ?>" class="d-block text-decoration-none text-dark mb-4">
              +<?php echo $contact_r['pn2'] ?>
            </a>
          <?php endif; ?>

          <h5 class="fw-semibold mb-3"><i class="bi bi-envelope-fill"></i> Email</h5>
          <a href="mailto:<?php echo $contact_r['email'] ?>" class="d-block text-decoration-none text-dark mb-4">
            <?php echo $contact_r['email'] ?>
          </a>

          <h5 class="fw-semibold mb-3"><i class="bi bi-people-fill"></i> Follow Us</h5>
          <div class="d-flex gap-3">
            <?php if($contact_r['tw']): ?>
              <a href="<?php echo $contact_r['tw'] ?>" class="text-dark social-icon"><i class="bi bi-twitter"></i></a>
            <?php endif; ?>
            <?php if($contact_r['fb']): ?>
              <a href="<?php echo $contact_r['fb'] ?>" class="text-dark social-icon"><i class="bi bi-facebook"></i></a>
            <?php endif; ?>
            <?php if($contact_r['insta']): ?>
              <a href="<?php echo $contact_r['insta'] ?>" class="text-dark social-icon"><i class="bi bi-instagram"></i></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Form -->
    <div class="col-lg-6 col-md-6 px-4">
      <div class="bg-white rounded shadow p-4 contact-card">
        <form method="POST" enctype="multipart/form-data" id="contactForm">
          <h5 class="mb-4 fw-semibold">Send us a message</h5>
          
          <div class="mb-4">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" readonly>
          </div>

          <div class="mb-4">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" value="<?php echo $user_data['email'] ?>" class="form-control shadow-none" required>
          </div>

          <div class="mb-4">
            <label class="form-label fw-semibold">Upload CV (PDF Only)</label>
            <label for="cvUpload" class="file-input-label">
              <i class="bi bi-file-earmark-pdf"></i>
              <div>Click to upload or drag and drop</div>
              <div class="file-name" id="fileName">No file selected</div>
            </label>
            <input type="file" id="cvUpload" name="subject" accept="application/pdf" class="d-none" required>
          </div>

          <div class="mb-4">
            <label class="form-label fw-semibold">Message</label>
            <textarea name="message" class="form-control shadow-none" rows="5" required style="resize: none;" placeholder="Type your message here..."></textarea>
          </div>

          <button type="submit" name="send" class="btn text-white custom-bg w-100 py-2 mt-2">
            <i class="bi bi-send-fill me-2"></i> Send Message
          </button>
        </form>
      </div>
    </div>

  </div>
</div>

<!-- PHP Handler -->
<?php 
if (isset($_POST['send'])) {
  $frm_data = filteration($_POST);
  $subject = $_FILES['subject'];
  $fileType = mime_content_type($subject['tmp_name']);

  if ($fileType !== 'application/pdf') {
    alert('error', 'Only PDF files are allowed.');
    exit;
  }

  $subject_name = time() . "_" . basename($subject['name']);
  $subject_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $subject_name;

  if (!move_uploaded_file($subject['tmp_name'], $subject_path)) {
    alert('error', 'Upload failed. Try again.');
    exit;
  }

  $q = "INSERT INTO user_queries(name, email, subject, message) VALUES (?,?,?,?)";
  $values = [$frm_data['name'], $frm_data['email'], $subject_name, $frm_data['message']];
  $res = insert($q, $values, 'ssss');

  if($res == 1) {
    alert('success', 'Message sent successfully.');
    echo "<script>document.getElementById('contactForm').reset();</script>";
    echo "<script>document.getElementById('fileName').textContent = 'No file selected';</script>";
  } else {
    alert('error', 'Server error. Please try later.');
  }
}
?>

<script>
  // File input display
  document.getElementById('cvUpload').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 'No file selected';
    document.getElementById('fileName').textContent = fileName;
  });
  
  // Drag and drop functionality
  const fileInputLabel = document.querySelector('.file-input-label');
  const fileInput = document.getElementById('cvUpload');
  
  fileInputLabel.addEventListener('dragover', (e) => {
    e.preventDefault();
    fileInputLabel.style.borderColor = 'var(--teal)';
    fileInputLabel.style.backgroundColor = 'rgba(32, 201, 151, 0.1)';
  });
  
  fileInputLabel.addEventListener('dragleave', () => {
    fileInputLabel.style.borderColor = '#d1d3e2';
    fileInputLabel.style.backgroundColor = '';
  });
  
  fileInputLabel.addEventListener('drop', (e) => {
    e.preventDefault();
    fileInputLabel.style.borderColor = '#d1d3e2';
    fileInputLabel.style.backgroundColor = '';
    
    if (e.dataTransfer.files.length) {
      fileInput.files = e.dataTransfer.files;
      const fileName = fileInput.files[0] ? fileInput.files[0].name : 'No file selected';
      document.getElementById('fileName').textContent = fileName;
    }
  });
</script>

<?php require('inc/footer.php'); ?>
</body>
</html>