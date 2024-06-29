<?php include("partials/menu.php")?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Hoardings</h1>
            <br><br>
            <?php
            session_start();
                if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
                }
                if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
                }
                if(isset($_SESSION['unauthorized'])){
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
                }
                if(isset($_SESSION['no-hoarding-found'])){
                echo $_SESSION['no-hoarding-found'];
                unset($_SESSION['no-hoarding-found']);
                }
                if(isset($_SESSION['failed-unlink'])){
                echo $_SESSION['failed-unlink'];
                unset($_SESSION['failed-unlink']);
                }
                if(isset($_SESSION['updated'])){
                echo $_SESSION['updated'];
                unset($_SESSION['updated']);
                }
                if(isset($_SESSION['no-hoarding-found'])){
                echo $_SESSION['no-hoarding-found'];
                unset($_SESSION['no-hoarding-found']);
                }
                if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
                }
            ?>
            <br><br>
            <a href="<?php echo SITEURL;?>admin/add-hoarding.php" class="btn-primary">Add Hoarding</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>

                </tr>

                <?php
                    $sql="SELECT * FROM tbl_hoarding";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            $location=$row['Location'];
                        ?>
                            <tr>
                                <td><?php echo $sn++;?> </td>
                                <td><?php echo $title;?></td>
                                <td><?php echo $price;?> </td>
                                <td>
                                    <?php 
                                        // if($image_name==""){
                                        //     echo "<div class='error'>Image not added</div>";
                                        // }
                                        // else{
                                        //     ?>
                                           <?php echo $location;?>
                                           

                                           <?php
                                        // }
                                        
                                    ?>
                                </td>
                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-hoarding.php?id=<?php echo $id;?>" class="btn-secondary">Update Campaign</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-hoarding.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Campaign</a>         
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo "<tr><td colspan='7' class='error'>hoarding not added yet</td></tr>";
                    }
                ?>
                
            </table>
        </div>
    </div>
<?php include("partials/footer.php")?>
