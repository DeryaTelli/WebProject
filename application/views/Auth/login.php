
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login.css">
</head>
<body>
    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <?php echo form_open('Auth/login_form');?>
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
            <br>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        <?php echo form_close();?>
        <div class="link">
            <p>Don't have account yet?</p>
            <a  href="Auth/register">Sign Up</a>
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