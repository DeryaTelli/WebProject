<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login.css">
</head>
<body>
    <div class="container" id="signUp" >
        <h1 class="form-title">Register</h1>
        <?php echo form_open('Auth/registration_form');?>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" if="name" placeholder="First Name" required>
                <label for="fname">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="surname" if="surname" placeholder="Last Name" required>
                <label for="lname">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        <?php echo form_close();?>
        <div class="link">
            <p>Already have account? </p>
            <a href="<?php echo base_url();?>Auth">Sign In</a>
        </div>
    </div>
    
    <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/login.js"></script> -->
    
    <script type="text/javascript">
    <?php if($this->session->flashdata('suc')){?>
        toastr.success("<?php echo $this->session->flashdata('suc');?>");
    <?php }else if($this->session->flashdata('wrong')){ ?>
        toastr.error("<?php echo $this->session->flashdata('wrong'); ?>");
    <?php }else if($this->session->flashdata('warning')){ ?>
        toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php } else if($this->session->flashdata('info')){ ?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
        <?php 
        $this->session->unset_userdata('suc');?>
        <?php 
        $this->session->unset_userdata('wrong');?>
    </script>

    </body>
</html>