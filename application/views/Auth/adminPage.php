<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin2.css">
</head>
<body>
<div class="navbar">
    <div class="nav-links">
        <a href="<?php echo base_url('Auth/logout'); ?>" class="logout-button">Logout</a>
        <a href="<?php echo base_url('Auth/userManagement'); ?>" class="user-management-button">User Management</a>
    </div>
    <div class="search-box">
        <form method="post" action="<?php echo base_url('Auth/searchAdmin'); ?>">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="notification-icon" onclick="toggleNotification()">
        <span class="notification-count"><?php echo $newCommentCount; ?></span>
        &#128276;
        <div class="notification-popup" id="notification-popup">
            <h4>Yeni Bildirimler</h4>
            <?php if(!empty($comments)) {
                foreach($comments as $comment) { ?>
                    <div class="notification-item">
                        <p><?php echo $comment['comment']; ?> (<?php echo $comment['user_name']; ?>)</p>
                        <form method="post" action="<?php echo base_url('Auth/adminPage'); ?>">
                        <input type="hidden" name="commentId" value="<?php echo $comment['id']; ?>">
                        <button type="submit" name="notificationRead">Okundu</button>
                        </form>
                        <p>Yorum yapıldı: <?php echo $comment['created_at']; ?></p>
                        <p>Dosya: <?php echo $comment['title']; ?></p>
                    </div>
            <?php } } else { ?>
                <p>Henüz bildirim yok.</p>
            <?php } ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="upload-div">
        <h3>Upload Multiple Files And Images</h3>
        <!-- display status text -->
        <?php echo !empty($statusMsg) ? '<p class="status-msg">' . $statusMsg . '</p>' : ''; ?>
        <!-- file upload form  -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Choose Files">Choose Files</label>
                <input type="file" class="form-control" name="files[]" id="files" multiple>
            </div>
            <div class="form-group">
                <label for="File Titles">File Titles (comma separated)</label>
                <input type="text" class="form-control" name="titles" id="titles" placeholder="Title1, Title2, ...">
            </div>
            <div class="form-group">
                <input class="form-control" type="submit" name="fileSubmit" value="UPLOAD">
            </div>
        </form>
        <div class="row">
            <h3>Uploaded Files/Images</h3>
            <ul class="gallery">
                <?php if(!empty($files)) {
                    foreach($files as $file) { ?>
                        <li class="item">
                            <img src="<?php echo base_url('uploads/files/'.$file['file_name']); ?>" alt="">
                            <p><?php echo !empty($file['title']) ? $file['title'] : 'No Title'; ?></p>
                            <p>Uploaded On <?php echo date("j M Y", strtotime($file['uploaded_on'])); ?></p>
                            <a class="delete-button" href="<?php echo base_url('auth/deleteFile/'.$file['id']); ?>" onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
                        </li>
                <?php } } else { ?>
                    <p>File(s) not found...</p>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<script>
    function toggleNotification() {
        var popup = document.getElementById("notification-popup");
        popup.style.display = popup.style.display === 'block' ? 'none' : 'block';

        // Reset notification count when popup is opened
        if (popup.style.display === 'block') {
            document.querySelector('.notification-count').textContent = '0';
        }
    }

    // Close the popup when clicking outside
    window.onclick = function(event) {
        if (!event.target.closest('.notification-icon')) {
            var popup = document.getElementById("notification-popup");
            if (popup.style.display === 'block') {
                popup.style.display = 'none';
            }
        }
    }
</script>
</body>
</html>
