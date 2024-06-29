<?php 
include('partials/menu.php');  
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br>
            
            <?php
                session_start();
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <br><br><br>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter your name"></td>

                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Enter username"></td>

                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter password"></td>

                    </tr>
                    <tr>
                        
                        <td colspan="2"><br>
    
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary" style="font-size: 16px; padding: 1.5%">
                        </td>

                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php include('partials/footer.php');?>

<!-- PHP code for submitting form to the database-->
<?php
    if(isset($_POST['submit'])){
        //button cicked
        // echo "Button clicked";
       $full_name=$_POST['full_name'];
       $username=$_POST['username'];
       $password=md5($_POST['password']);   //md5 is used for encryption//
    
       $sql="INSERT INTO tbl_admin SET full_name='$full_name', username='$username', password='$password'";
    //    echo $sql;

    $res=mysqli_query($conn,$sql) or die(mysqli_error());
    if($res){
        // echo "Inserted successfully";
        $_SESSION['add']= "<div class='success'>Admin Added Successfully</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['add']="<div class='error'>Failed to add Admin</div>";
        header("location:".SITEURL.'admin/add-admin.php');
    }

    }
?>
