<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title']; ?> - Chat Room</title>
  <style>
    body {
      background: #eef2f7;
      font-family: 'Segoe UI', sans-serif;
    }

    .chat-container {
      height: 90vh;
      max-width: 700px;
      margin: auto;
      background: #fff;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
    }

    .chat-header {
      background: #fff;
      padding: 12px 20px;
      border-bottom: 1px solid #ddd;
      display: flex;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .chat-header img {
      border-radius: 50%;
      width: 40px;
      height: 40px;
    }

    .chat-header h6 {
      margin: 0;
      font-weight: 600;
    }

    .chat-header small {
      color: gray;
      font-size: 12px;
    }

    .chat-box {
      flex-grow: 1;
      overflow-y: auto;
      padding: 20px;
      background:rgb(255, 255, 255);
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .message {
      max-width: 70%;
      padding: 10px 14px;
      border-radius: 15px;
      font-size: 14px;
      line-height: 1.4;
      word-break: break-word;
    }

    .message.ltext {
      align-self: flex-start;
      background:rgb(214, 228, 221);
      border: 1px solid #dee2e6;
    }

    .message.rtext {
      align-self: flex-end;
      background:rgb(168, 220, 196);
    }

    .chat-footer {
      background: #fff;
      padding: 10px 15px;
      border-top: 1px solid #ddd;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .chat-footer textarea {
      resize: none;
      flex-grow: 1;
      border-radius: 10px;
      padding: 10px;
    }

    .chat-footer button {
      border-radius: 10px;
    }

    .back-btn {
      font-size: 1.2rem;
      color: #444;
      margin-right: 10px;
    }

    ::-webkit-scrollbar {
      width: 6px;
    }

    ::-webkit-scrollbar-thumb {
      background-color: #ccc;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<?php 
if (!(isset($_SESSION['login']) && $_SESSION['login'] == true && isset($_POST['roomId']))) {
    redirect('index.php');
}

$roomId = $_POST['roomId'];

$host = "SELECT r.name AS rname, hc.name AS hname, hc.profile AS hprofile 
          FROM rooms r
          INNER JOIN host_cred hc ON hc.id = r.host_id 
          WHERE r.id = ?";
$hostres = select($host, [$roomId], 'i');
$hostdata = mysqli_fetch_assoc($hostres);
$path = HOSTS_IMG_PATH;
?>

<div class="chat-container">
  <div class="chat-header">
    <a href="Messages.php" class="back-btn"><i class="bi bi-arrow-left-circle-fill"></i></a>
    <img src="<?= $path . $hostdata['hprofile'] ?>" alt="Host Image">
    <div class="ms-3">
      <h6><?= htmlspecialchars($hostdata['hname']) ?></h6>
      <small><?= htmlspecialchars($hostdata['rname']) ?></small>
    </div>
  </div>

  <div class="chat-box" id="chatBox">
    <!-- Messages will be loaded here -->
  </div>

  <div class="chat-footer">
    <input type="hidden" id="sender" name="sender" value="user">
    <input type="hidden" id="room_id" name="room_id" value="<?= $roomId ?>">
    <textarea id="message" rows="1" class="form-control" placeholder="Type your message..."></textarea>
    <button class="btn btn-success" id="sendBtn"><i class="bi bi-send-fill"></i></button>
  </div>
</div>

<script>
let chatBox = document.getElementById('chatBox');
let room_id = document.getElementById('room_id').value;
let sender = document.getElementById('sender').value;

function scrollDown() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

function getMessage() {
  let data = new FormData();
  data.append('getMessage', '');
  data.append('room_id', room_id);

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/Messages.php", true);
  xhr.onload = function () {
    chatBox.innerHTML = this.responseText;
    scrollDown();
  };
  xhr.send(data);
}

getMessage();
setInterval(getMessage, 5000);

document.getElementById('sendBtn').addEventListener('click', function () {
  let message = document.getElementById('message').value.trim();
  if (message === '') return;

  let data = new FormData();
  data.append('messagehost_form', '');
  data.append('room_id', room_id);
  data.append('sender', sender);
  data.append('message', message);

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/Messages.php", true);
  xhr.onload = function () {
    if (this.responseText == 1) {
      document.getElementById('message').value = '';
      getMessage();
    } else {
      alert("Message not sent.");
    }
  };
  xhr.send(data);
});
</script>
</body>
</html>
