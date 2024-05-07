<?php 
session_start();
if(!isset($_SESSION['user_name'])){
    header('location:login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
            margin:0; 
            padding:0;
            box-sizing:border-box;
            outline:none; border:none;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h3>hi, <span>User</span></h3>
            <h1>WELCOME <span> <?php echo $_SESSION['user_name']?></span></h1>
            <p>this is an user page</p>
            <a href="login_form.php" class="btn">login</a>
            <a href="logout.php" class="btn">logout</a>
        </div>
    </div>
</body>
</html>