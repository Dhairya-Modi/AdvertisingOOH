<?php 
include("../config/constants.php");
session_start();

if(isset($_POST['submit'])){
  //1.get data from login form
   $username=mysqli_real_escape_string($conn,$_POST['username']);
   $raw_password=md5($_POST['password']);
   $password=mysqli_real_escape_string($conn,$raw_password);

   //2.SQL to check whether user exist or not
   $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
   $res=mysqli_query($conn,$sql);
  
     $count=mysqli_num_rows($res);
    //  echo $count;
     if($count==1){
          $_SESSION['authenticated']=true;
          $_SESSION['login']="<div class='success'>Admin logged in Successfully</div>";
          header("location:".SITEURL.'admin/index.php');
          exit();
      }
      else{
          $_SESSION['login']="<div class='error'>Admin login Failed</div>";
          header("location: ".SITEURL.'admin/login.php');
          exit();
   }
   }  
?>
<html>
  <head>
    <title>Login-hoarding Order Website</title>
    <link rel="stylesheet" href="../css/admin.css"></link>
    </head>  
    
    <body style="background-image: url('../images/background3.jpg'); background-repeat: no-repeat; background-size: cover; ">
      
      <!-- <div class="full"> -->
        <div class="login text-center">
        <h1 class="text-center" style="color: white;"> Login</h1>
        <?php
          if(isset($_SESSION['login'])){
          echo $_SESSION['login'];
          unset($_SESSION['login']);
      }
      ?>
        <form action="" method="POST">
            <br>
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username"></input><br><br>
            Password:</br>
            <input type="password" name="password" placeholder="Enter Password"></input><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary" style="border:none; padding:5px; "></input><br>

        </form>
        <!-- </div>   -->
    </div>     
</body>
</html>

