<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin.css">

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
        <div class="upload-div">
            <h3>Upload Multiple Files And Images</h3>
            <!-- display status text -->
            <?php echo !empty($statusMsg)?'<p class="status-msg">'.$statusMsg.'</p>':'';?>
            <!-- file upload form  -->
            <form method="post"  action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Choose Files"></label>
                    <input type="file" class="form-control" name="files[]" id="files" multiple>
                </div>
                <div class="form-group">
                    <input class="form-control"  type="submit" name="fileSubmit" value="UPLOAD">

                </div>
            </form>
            <div class="row">
                <h3>Uploaded Files/Images</h3>
                <ul class="gallery">
                    <?php if(!empty($files)){
                        foreach($files as $file){?>
                        <li class="item">
                            <img src="<?php echo base_url('uploads/files/'.$file['file_name']);?>" alt="">
                            <p>Uploaded On <?php echo date("j M Y", strtotime($file['uploaded_on'])); ?></p>
                        </li>
                    <?php }} else{ ?>
                        <p>File(s) not found...</p>
                    <?php }?>
                </ul>
            </div>
        
        </div>
    </div>
</body>
</html>