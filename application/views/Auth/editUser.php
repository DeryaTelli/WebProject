<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/edituser1.css">
</head>
<body>
<div class="navbar">
    <div class="nav-links">
        <a href="<?php echo base_url('Auth/userManagement'); ?>" class="back-button">Back to User Management</a>
        <a href="<?php echo base_url('Auth/logout'); ?>" class="logout-button">Logout</a>
    </div>
</div>
<div class="container">
    <h3>Edit User</h3>
    <?php if($this->session->flashdata('error')) { ?>
        <p class="status-msg error"><?php echo $this->session->flashdata('error'); ?></p>
    <?php } ?>
    <form method="post" action="<?php echo base_url('auth/updateUser'); ?>">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <input class="form-control" type="submit" value="Update User">
        </div>
    </form>
</div>
</body>
</html>
