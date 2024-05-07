<?php 
//Registering a new user 
@include 'config.php';
session_start();
if(isset($_POST['signUp'])){
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $surname=mysqli_real_escape_string($conn,$_POST['surname']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=md5($_POST['password']);

    $select="SELECT*FROM user_form WHERE email='$email' && password='$password'";
    $result=mysqli_query($conn,$select);
    if(mysqli_num_rows($result)>0){
        echo '<script>
        alert("User already exists");
        </script>';
    }else{
        $insert="INSERT INTO user_form(name,surname,email,password)VALUES('$name','$surname','$email','$password')";
        $result=mysqli_query($conn,$insert);
        if($result){
            echo '<script>alert("User registered successfully");</script>';
        }else{
            echo '<script>alert("Error");</script>';
        }
        header('location:login.php');
    }
    
};
?>
<?php 
// sign in 
@include 'config.php';
if(isset($_POST['signIn'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=md5($_POST['password']);

    $select="SELECT*FROM user_form WHERE email='$email' && password='$password'";
    $result=mysqli_query($conn,$select);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_array($result);
        if($row['user_type']=='admin'){
            $_SESSION['admin_name']=$row['name'];
            header('location:admin_main_page.php');
        }elseif($row['user_type']=='user'){
            $_SESSION['user_name']=$row['name'];
            header('location:user_main_page.php');
        }
    }else{
        echo '<script>alert("Incorrect email or password!");</script>';
    }
    
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="login_style.css">
</head>
<body>
    
    <div class="container" id="signUp" style="display: none;">
        <h1 class="form-title">Register</h1>
        <form action="" method="post">
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
        </form>
        <div class="link">
            <p>Already have account? </p>
            <button id="signInButton">Sign In</button>
        </div>
    </div>
    
    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form action="" method="post">
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
            <p class="recover">
                <a href="#">Recover Password</a>
            </p>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <div class="link">
            <p>Don't have account yet?</p>
            <button  id="signUpButton">Sign Up</button>
        </div>
    </div>
    <script src="login.js"></script>
</body>
</html>