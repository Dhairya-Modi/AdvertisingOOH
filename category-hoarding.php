<?php include('partials-front/menu.php');?>

<?php
    session_start();
    if(isset($_GET['category_id'])){
        $category_id=$_GET['category_id'];
        $sql="SELECT title FROM tbl_category WHERE id=$category_id";
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);
        $category_title=$row['title'];

    }
    else{
        header("location:".SITEURL);
    }
?>

    <!-- hoarding sEARCH Section Starts Here -->
    <section class="hoarding-search text-center">
        <div class="container">
            
            <h2>List of <a href="#" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- hoarding sEARCH Section Ends Here -->



    <!-- hoarding MEnu Section Starts Here -->
    <section class="hoarding-menu">
        <div class="container">
            <h2 class="text-center">Hoarding List</h2>
            
            <?php
                $sql2="SELECT * FROM tbl_hoarding WHERE category_id=$category_id";
                $res2=mysqli_query($conn,$sql2);
                $count=mysqli_num_rows($res2);
                if($count>0){
                    while($row=mysqli_fetch_assoc($res2)){
                        $hoarding_id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        
              ?> 
                        <div class="hoarding-menu-box">
                        <div class="hoarding-menu-img">
                            <?php
                            if($image_name==""){
                             echo "<div class='error'>Category Not Available!</div>";
  
                        }
                            else{
                                ?>
                                <img src="<?php echo SITEURL;?>images/hoarding/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                            }
                            ?>
                        </div>

                        <div class="hoarding-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="hoarding-price"><?php echo $price;?></p>
                            <p class="hoarding-detail">
                                <?php echo $description;?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?hoarding_id=<?php echo $hoarding_id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                <?php
                    }
                }
                else{
                    echo "<div class='error'>Category Not Available!</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- hoarding Menu Section Ends Here -->
<?php include('partials-front/footer.php');?>