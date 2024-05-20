<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/usermanagement.css">
</head>
<body>
<div class="navbar">
    <div class="nav-links">
        <a href="<?php echo base_url('Auth/adminPage'); ?>" class="back-button">Back to Admin Page</a>
        <a href="<?php echo base_url('Auth/logout'); ?>" class="logout-button">Logout</a>
    </div>
</div>
<div class="container">
    <h3>User Management</h3>
    <?php if($this->session->flashdata('success')) { ?>
        <p class="status-msg success"><?php echo $this->session->flashdata('success'); ?></p>
    <?php } elseif($this->session->flashdata('error')) { ?>
        <p class="status-msg error"><?php echo $this->session->flashdata('error'); ?></p>
    <?php } ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($users)) {
                foreach($users as $user) { ?>
                    <tr>
                        <td><?php echo isset($user['id']) ? $user['id'] : ''; ?></td>
                        <td><?php echo isset($user['name']) ? $user['name'] : 'No Username'; ?></td>
                        <td><?php echo isset($user['email']) ? $user['email'] : 'No Email'; ?></td>
                        <td>
                            <a href="<?php echo base_url('auth/editUser/'.$user['id']); ?>">Edit</a> |
                            <a href="<?php echo base_url('auth/deleteUser/'.$user['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
            <?php } } else { ?>
                <tr><td colspan="4">No users found...</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
