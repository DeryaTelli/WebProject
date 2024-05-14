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
    <title>User Login & Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/views/login_style.css'); ?>">
    <style>
        *{
    margin:0;
    padding: 0;
    box-sizing:border-box;
    font-family: "poppins",sans-serif;

}
body{
    background-color: cyan;
    background:linear-gradient(to right, rgb(205, 205, 238),cyan) ;
}
.container{
    background: #fff;
    width: 450px;
    padding: 1.5rem;
    margin:50px auto;
    border-radius: 10px;
    box-shadow: 0 20px 35px rgba(0,0,1,0.9);
}
form{
    margin:0 2rem;

}
.form-title{
    font-size:1.5rem;
    font-weight:bold;
    text-align:center;
    padding:1.3rem;
    margin-bottom:0.4rem;

}
input{
    color:inherit;
    width: 100%;
    background-color: transparent;
    border:none;
    border-bottom:1px solid #757575;
    padding-left:1.5rem;
    font-size:15px;

}
.input-group{
    padding:1% 0;
    position: relative;
}
.input-group i{
    position: absolute;
    color:black;
    
}
input:focus{
    background-color: transparent;
    outline: transparent;
    border-bottom: 2px solid rgb(16, 113, 137);
}
input::placeholder{
    color:transparent;
}
label{
    color:#757575;
    position: relative;
    left:1.2em;
    top:-1.3em;
    cursor: auto;
    transition: 0.3s ease all;
}
input:focus~label,input:not(:placeholder-shown)~label{
    top:-3em;
    color:rgb(16, 113, 137);
    fon: size 15px;
}
.recover{
    text-align: right;
    font-size: 1rem;
    margin-bottom: 1rem;
}
.recover a{
    text-decoration: none;
    color:rgb(6, 218, 179)  
}

.recover a:hover{
    color:blue;
    text-decoration: underline;
}
.btn{
    font-size:1.1rem;
    padding: 8px 0;
    border-radius: 5px;
    outline: none;
    border:none;
    width:100%;
    background: cyan;
    cursor:pointer;
    transition: 0.9s;
}

.link{
    display: flex;
    justify-content: space-around;
    padding: 0 5rem;
    margin-top:0.9rem;
    

}
button{
    color:rgb(6, 218, 179) ;
    border:none;
    background-color: transparent;
    font-size: 1rem;

}
button:hover{
    text-decoration: underline;
    color:blue;
}
    </style>
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
    <script src="<?php echo base_url('WebProject/login.js'); ?>"></script>
    <script>
        const signUpButton=document.getElementById('signUpButton');
        const signInButton=document.getElementById('signInButton');
        const signInForm=document.getElementById('signIn');
        const signUpForm=document.getElementById('signUp');

        signUpButton.addEventListener('click',()=>{
            signInForm.style.display='none';
            signUpForm.style.display='block';
        });

        signInButton.addEventListener('click',()=>{
            signUpForm.style.display='none';
            signInForm.style.display='block';
        })
    </script>
</body>
</html>