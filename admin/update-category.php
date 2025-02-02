<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        session_start();
        // 1.Get id
        if(isset($_GET['id'])){
        $id=$_GET['id'];

        //2.Create SQL query to fetch current value
        $sql="SELECT * FROM tbl_category WHERE id='$id'";
        //Execute the query
        $res=mysqli_query($conn,$sql);
        if($res){
            $count=mysqli_num_rows($res);
            if($count==1){
                // echo "Admin Available";
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];    
                $featured=$row['featured'];
                $active=$row['active'];
            }
            else{
                $_SESSION['no-category-found']="<div class='error'>No Category Found</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
    }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?>">
                    </td>   
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image!=""){
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
                                <?php
                            }
                            else{
                                echo "<div class='error'>No image uploaded</div>";
                            }
                        ?>
                    </td>  
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>  
                </tr>
                <tr>
                    <td>featured </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No

                    </td>   
                </tr>
                <tr>
                    <td>Active </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="<?php echo $featured?>">Yes
                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="<?php echo $featured?>">No

                    </td>   
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image?>">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>   
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['submit'])){
        $id=$_POST['id'];
        $title=$_POST['title'];
        $current_image=$_POST['current_image'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];

        if(isset($_FILES['image']['name'])){
            $image_name=$_FILES['image']['name'];

            if($image_name!=""){
                $ext=end(explode('.',$image_name));
                $image_name="hoarding_Category_".rand(000,999).'.'.$ext;
                $source_path=$_FILES['image']['tmp_name'];
                $dest_path="../images/category/".$image_name;

                $upload=move_uploaded_file($source_path,$dest_path);
                if($upload==false){
                    $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                    header("location:".SITEURL.'admin/manage-category.php');
                    die();
                }
                if($current_image!=""){
                    $remove_path="../images/category/".$current_image;
                    $remove=unlink($remove_path);
                    if($remove==false){
                        $_SESSION['failed-remove']="<div>Failed to remove old image</div>";
                        header("location:".SITEURL.'admin/manage-category.php');
                        die();
                    }
                }
            }
            else{
                $image_name=$current_image;
            }
        }
        else{
                $image_name=$current_image;
        }

        $sql2="UPDATE tbl_category SET 
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active' 
        WHERE id='$id'
        ";

        $res2=mysqli_query($conn,$sql2);
        if($res2){
            $_SESSION['update']="<div class='success'>category Updated successfully</div>";
            header("location:".SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['update']="<div class='error'>Failed to update category</div>";
            header("location:".SITEURL.'admin/manage-category.php');
        }
        
    }
?>
<?php include('partials/footer.php')?>