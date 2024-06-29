<?php include("partials-front/menu.php");
?>

    <!-- hoarding sEARCH Section Starts Here -->
    <section class="hoarding-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>hoarding-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Places.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- hoarding sEARCH Section Ends Here -->

    <?php
    session_start();

        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        if(isset($_SESSION['display'])){
            echo $_SESSION['display'];

            unset($_SESSION['display']);
        }
        // echo "<br>";
        // if(isset($_SESSION['currentStatus'])){
        //     echo $_SESSION['currentStatus'];
        //     // unset($_SESSION['currentStatus']);
        // }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Available Boards</h2>
            <?php 
            //Create SQL query to Display categories 
            $sql="SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes' LIMIT 3";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    //get values like id,title,etc
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL;?>category-hoardings.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
                            <?php
                                if($image_name==""){
                                    echo "<div class='error'>Image not available</div>";
                                }
                                else{
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                    <?php
                                }
                                
                            ?>

                        <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                    </a>
                    <?php
                }
            }
            else{
                echo "<div class='error'>Category not added</div>";
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
    
           

    <!-- hoarding MEnu Section Starts Here -->
    <section class="hoarding-menu">
        <div class="container">
            <h2 class="text-center">Hoarding List</h2>
            <?php
                $sql2="SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 6";
                $res2=mysqli_query($conn,$sql2);
                $count2=mysqli_num_rows($res2);
                if($count2>0){
                    while($row=mysqli_fetch_assoc($res2)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
        ?>
                    <div class="hoarding-menu-box">
                    <div class="hoarding-menu-img">
                        <?php
                            if($image_name==""){
                                echo "<div class='error'>Image not available</div>";
                            }
                            else{
                                ?>
                                <img src="<?php echo SITEURL;?>images/hoarding/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                <?php
                                        
                                }
                            ?>
                    </div>

                    <div class="hoarding-menu-desc">
                        <h4><?php echo $title;?></h4>
                        <p class="hoarding-price"><?php echo "Rs. ".$price;?></p>
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
            ?>
            
            
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <!-- <a href="#">See All hoardings</a> -->
        </p>
    </section>
    <!-- hoarding Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>