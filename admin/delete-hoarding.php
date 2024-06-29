<?php
session_start();
include("../config/constants.php");
            
    if(isset($_GET['id'])&&isset($_GET['image_name'])){
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
        if($image_name!=""){
        $path="../images/hoarding/".$image_name;
        $remove=unlink($path);
            if($remove==false){
            $_SESSION['remove']="<div class='error'>Failed to remove hoarding Image</div>";
            header("location:".SITEURL.'admin/manage-hoarding.php');
            die();
            }

        }
    $sql="DELETE FROM tbl_hoarding WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res){
        $_SESSION['delete']="<div class='success'>hoarding Deleted Successfully</div>";
        header("location:".SITEURL.'admin/manage-hoarding.php');

    }
    else{
        $_SESSION['delete']="<div class='error'>Failed to Delete hoarding </div>";
        header("location:".SITEURL.'admin/manage-hoarding.php');

    }

}
else{
    $_SESSION['unauthorized']="<div class='error'>Unauthorized Access</div>";
    header("location:".SITEURL.'admin/manage-hoarding.php');
}
?>