<?php include('partials/menu.php')?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update hoarding</h1>            
            <br><br>
            <?php
            session_start();
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $sql2="SELECT * FROM tbl_hoarding WHERE id=$id";
                    $res2=mysqli_query($conn,$sql2);
                    if($res2){
                    $count2=mysqli_num_rows($res2);
                    if($count2==1){
                        $row2=mysqli_fetch_assoc($res2);
                        $title=$row2['title'];
                        $description=$row2['description'];
                        $price=$row2['price'];
                        $current_image=$row2['image_name'];
                        $current_category=$row2['category_id'];
                        $featured=$row2['featured'];
                        $active=$row2['active'];
                    }
                    else{
                    $_SESSION['no-hoarding-found']="<div class='error'>No hoarding item found</div>";
                    header('location:'.SITEURL.'admin/manage-hoarding.php');
                    }
                }
                }
            
            ?>
            <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image!=""){
                            //we have image
                            ?>
                            <img src="<?php echo SITEURL;?>images/hoarding/<?php echo $current_image;?>" width="80px" >
                            <?php
                            
                        }
                        else{
                            //No image
                            echo "<div class='error'>No image uploaded</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                                $res=mysqli_query($conn,$sql);
                                $count=mysqli_num_rows($res);
                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $category_id=$row['id'];
                                        $category_title=$row['title'];
                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
        
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>                        
                        <input type="radio" <?php if($featured=="Yes"){echo "checked";}?> name="featured" value="Yes">Yes
                        <input type="radio" <?php if($featured=="No"){echo "checked";}?> name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" <?php if($active=="Yes"){echo "checked";}?> name="active" value="Yes">Yes
                        <input type="radio" <?php if($active=="No"){echo "checked";}?>name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update hoarding" class="btn-secondary">
                    </td>
                </tr>

            </table>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $current_image=$_POST['current_image'];
                    $price=$_POST['price'];
                    $featured=$_POST['featured'];
                    $category=$_POST['category'];
                    $active=$_POST['active'];

                if(isset($_FILES['image']['name'])){
                    $image_name=$_FILES['image']['name'];
                    if($image_name!=""){
                        //image available
                        $ext_array=explode('.',$image_name);
                        $ext=end($ext_array);
                        $image_name="hoarding_name_".rand(0000,9999).'.'.$ext;
                        $source_path=$_FILES['image']['tmp_name'];
                        $dest_path="../images/hoarding/".$image_name;

                        $upload=move_uploaded_file($source_path,$dest_path);
                        if($upload==false){
                            $_SESSION['upload']="<div class='error'>Image Upload Failed!..</div>";
                            header("location:".SITEURL.'admin/manage-hoarding');
                            die();
                        }
                        if($current_image!=""){
                            $remove_path="../images/hoarding/".$current_image;
                            $remove=unlink($remove_path);
                            if($remove==false){
                                $_SESSION['failed-unlink']="<div>Failed to remove old image</div>";
                                header("location:".SITEURL.'admin/manage-hoarding.php');
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

                    $sql3="UPDATE tbl_hoarding SET
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id=$category,
                        featured='$featured',
                        active='$active'
                        WHERE id=$id
                    ";
                    $res3=mysqli_query($conn,$sql3);
                    if($res3){
                        $_SESSION['updated']="<div class='success'>hoarding Updated successfully</div>";
                        header("location:".SITEURL.'admin/manage-hoarding.php');
                    }
                    else{
                        $_SESSION['updated']="<div class='error'>Failed to update hoarding</div>";
                        header("location:".SITEURL.'admin/manage-hoarding.php');
                    }
                    
                }
            
            ?>
        </div>
    </div>
<?php include('partials/footer.php')?>
    