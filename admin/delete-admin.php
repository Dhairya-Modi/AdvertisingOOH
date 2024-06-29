<?php
session_start();
if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
    include('../config/constants.php');
    //get the id of admin to be deleted
    echo $id=$_GET['id'];

    //Create SQL query for deleting
    $sql="DELETE FROM tbl_admin WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res){
        $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['delete']= "<div class='error'>Failed to Delete Admin</div>";
        header("location".SITEURL.'admin/manage-admin.php');
    }

?>