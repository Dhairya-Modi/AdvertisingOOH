<?php include('partials-front/menu.php');?>
    <!-- hoarding sEARCH Section Starts Here -->
    <section class="hoarding-search text-center">
        <div class="container">
            <?php
                // $search=$_POST['search'];
                $search=mysqli_real_escape_string($conn,$_POST['search']);
            
            ?>
            <h2>hoardings on Your Search <a href="#" class="text-white"><?php echo $search;?></a></h2>

        </div>
    </section>
    <!-- hoarding sEARCH Section Ends Here -->



    <!-- hoarding MEnu Section Starts Here -->
    <section class="hoarding-menu">
        <div class="container">
            <h2 class="text-center">hoarding Menu</h2>
            <?php
                $sql="SELECT * FROM tbl_hoarding WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
            ?>
                <div class="hoarding-menu-box">
                    <div class="hoarding-menu-img">
                        <?php
                        if($image_name==""){
                            echo "<div class='error'>Image Not Available.</div>";
                            
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
                    <a href="<?php echo SITEURL;?>order.php?hoarding_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <?php
                    }
                }
                else{
                    echo "<div class='error'>hoarding Not Found</div>";
                }
            ?>

            <div class="clearfix"></div>           

        </div>

    </section>
    <!-- hoarding Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>