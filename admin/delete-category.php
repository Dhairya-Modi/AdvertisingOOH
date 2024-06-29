<?php
session_start();

if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
include("../config/constants.php");
if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    if($image_name!=""){
        //that means we have image and remove it here:
        $path="../images/category/".$image_name;
        $remove=unlink($path);

        //if failde to remove image: $remove will be false 
        if($remove==false){
            $_SESSION['remove']="<div class='error'>Failed to remove Category Image</div>";
            header("location:".SITEURL.'admin/manage-category.php');
            die();
        }

    }
    //remove date of category
    $sql="DELETE FROM tbl_category WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res){
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
        header("location:".SITEURL.'admin/manage-category.php');

    }
    else{
        $_SESSION['delete']="<div class='error'>Failed to Delete Category </div>";
        header("location:".SITEURL.'admin/manage-category.php');

    }
    //redirect to manage-category page
}
else{
    header("location:".SITEURL.'admin/manage-category.php');
}
?>