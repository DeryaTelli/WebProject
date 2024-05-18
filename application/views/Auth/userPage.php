<!-- application/views/Auth/userPage.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/user.css">
</head>
<body>
<div class="navbar">
    <div class="nav-links">
        <a href="<?php echo base_url('Auth/logout'); ?>" class="logout-button">Logout</a>
    </div>
    <div class="search-box">
        <form method="post" action="<?php echo base_url('Auth/search'); ?>">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>
</div>
<div class="container">
    <h3>Uploaded Files/Images</h3>
    <div class="gallery">
        <?php if(!empty($files)) { 
            foreach($files as $file) { ?>
                <div class="item">
                    <img src="<?php echo base_url('uploads/files/'.$file['file_name']); ?>" alt="<?php echo $file['title']; ?>">
                    <p><?php echo !empty($file['title']) ? $file['title'] : 'No Title'; ?></p>
                    <p>Uploaded On <?php echo date("j M Y", strtotime($file['uploaded_on'])); ?></p>
                    <!-- Yorum ekleme formu -->
                    <form method="post" action="<?php echo base_url('Auth/addComment'); ?>">
                        <input type="hidden" name="file_id" value="<?php echo $file['id']; ?>">
                        <textarea name="comment" placeholder="Enter your comment"></textarea>
                        <button type="submit">Add Comment</button>
                    </form>
                    <!-- Yorumları göster -->
                    <?php if(!empty($file['comments'])) { ?>
                        <div class="comments">
                            <h4>Comments:</h4>
                            <?php foreach($file['comments'] as $comment) { ?>
                                <p><?php echo $comment['comment']; ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } 
        } else { ?>
            <p>File(s) not found...</p>
        <?php } ?>
    </div>
</div>
</body>
</html>
