<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php require('inc/links.php'); ?>
    <title><?= $settings_r['site_title'] ?> - Your Messages</title>

    <style>
    :root {
        --message-primary: #4f46e5;
        --message-primary-light: #e0e7ff;
        --message-text: #374151;
        --message-text-light: #6b7280;
        --message-bg: #f9fafb;
        --message-card-bg: #ffffff;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        background-color: var(--message-bg);
    }

    .message-card {
        background-color: var(--message-card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .message-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(79, 70, 229, 0.1);
        border-color: var(--message-primary-light);
    }

    .message-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background-color: var(--message-primary);
        transition: all 0.3s ease;
    }

    .message-card:hover::before {
        width: 6px;
    }

    .host-profile {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid var(--message-primary-light);
        flex-shrink: 0;
        margin-right: 15px;
    }

    .host-name {
        font-weight: 600;
        font-size: 1.05rem;
        color: var(--message-text);
        margin: 0;
        line-height: 1.3;
    }

    .room-name {
        font-size: 0.85rem;
        color: var(--message-text-light);
        margin: 0;
        font-weight: 500;
    }

    .message-text {
        font-size: 0.95rem;
        color: var(--message-text);
        margin: 1rem 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
    }

    .message-time {
        font-size: 0.75rem;
        color: var(--message-text-light);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .message-btn {
        background: transparent;
        border: none;
        padding: 0;
        width: 100%;
        text-align: left;
    }

    .messages-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        padding-bottom: 3rem;
    }

    .header-container {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .page-title {
        font-weight: 700;
        font-size: 1.75rem;
        color: var(--message-text);
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: var(--message-text-light);
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .divider {
        height: 4px;
        width: 80px;
        background-color: var(--message-primary);
        margin: 1rem auto;
        border-radius: 2px;
        opacity: 0.8;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem 0;
    }

    .empty-icon {
        font-size: 3.5rem;
        color: #d1d5db;
        margin-bottom: 1.5rem;
    }

    .empty-title {
        font-weight: 600;
        font-size: 1.25rem;
        color: var(--message-text);
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: var(--message-text-light);
        margin-bottom: 1.5rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-primary {
        background-color: var(--message-primary);
        border-color: var(--message-primary);
    }

    @media (max-width: 768px) {
        .messages-container {
            grid-template-columns: 1fr;
        }
        
        .message-card {
            padding: 1.25rem;
        }
    }
</style>

</head>
<body class="bg-light">

<?php 
    require('inc/header.php'); 

    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }
?>

<div class="container py-5">
    <div class="header-container">
        <h1 class="page-title">Your Messages</h1>
        <p class="page-subtitle">View and manage your conversations with hosts</p>
        <div class="divider"></div>
    </div>

    <div class="messages-container">
    <?php
        $query = "SELECT m.*, hc.name AS hname, hc.profile AS hprofile, r.name AS rname 
                  FROM messages m
                  INNER JOIN rooms r ON m.room_id = r.id
                  INNER JOIN host_cred hc ON r.host_id = hc.id
                  WHERE m.user_id = ?
                  GROUP BY m.room_id
                  ORDER BY m.datentime DESC";

        $res = select($query, [$_SESSION['uId']], 'i');
        $path = HOSTS_IMG_PATH;

        if (mysqli_num_rows($res) == 0) {
            echo <<<HTML
            <div class="empty-state">
                <i class="bi bi-chat-square-text empty-icon"></i>
                <h3 class="empty-title">No messages yet</h3>
                <p class="empty-text">When you message hosts about rooms, your conversations will appear here.</p>
                <a href="index.php" class="btn btn-primary">Browse Rooms</a>
            </div>
            HTML;
        }

        while ($row = mysqli_fetch_assoc($res)) {
            $profile_img = $row['hprofile'] ? $path . $row['hprofile'] : 'images/default-profile.jpg';
            $hname = htmlspecialchars($row['hname']);
            $rname = htmlspecialchars($row['rname']);
            $message = htmlspecialchars($row['message']);
            $roomId = (int)$row['room_id'];
            $datentime = date("M j, Y g:i A", strtotime($row['datentime']));

            echo <<<HTML
            <form action="chat.php" method="POST">
                <input type="hidden" name="roomId" value="$roomId" />
                <button type="submit" class="message-btn">
                    <div class="message-card">
                        <div class="d-flex align-items-center">
                            <img src="$profile_img" alt="$hname" class="host-profile" loading="lazy" />
                            <div>
                                <h5 class="host-name">$hname</h5>
                                <p class="room-name">$rname</p>
                            </div>
                        </div>
                        <p class="message-text">$message</p>
                        <p class="message-time">
                            <i class="bi bi-clock"></i> $datentime
                        </p>
                    </div>
                </button>
            </form>
            HTML;
        }
    ?>
    </div>
</div>

<?php require('inc/footer.php'); ?>

</body>
</html>