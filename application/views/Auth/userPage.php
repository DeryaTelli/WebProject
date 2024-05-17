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
            <input type="text" placeholder="Search...">
            <button>Search</button>
        </div>
    </div>
    <div class="container">
        <h3>Uploaded Files/Images</h3>
        <button class="scroll-button left">&lt;</button>
        <div class="gallery">
            <?php if(!empty($files)) { 
                foreach($files as $file) { ?>
                    <div class="item">
                        <img src="<?php echo base_url('uploads/files/'.$file['file_name']); ?>" alt="">
                        <p>Uploaded On <?php echo date("j M Y", strtotime($file['uploaded_on'])); ?></p>
                    </div>
                <?php } 
            } else { ?>
                <p>File(s) not found...</p>
            <?php } ?>
        </div>
        <button class="scroll-button right">&gt;</button>
    </div>

    <script src="<?php echo base_url('assets/js/scroll.js'); ?>"></script>
</body>
</html>
