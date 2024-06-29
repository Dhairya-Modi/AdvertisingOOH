<?php include('partials-front/menu.php'); 
?>

<?php
session_start();

    if(isset($_GET['hoarding_id'])){
        $hoarding_id=$_GET['hoarding_id'];

        $sql="SELECT * FROM tbl_hoarding WHERE id=$hoarding_id";
        $res=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($res);
        if($count==1){
            $row=mysqli_fetch_assoc($res);
            //get data from database
            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
        }
        else{
            header("location:".SITEURL);
        }
    }
    else{
        header("location:".SITEURL);
    }
?>
    <!-- hoarding sEARCH Section Starts Here -->
    <section class="hoarding-search">
        <div class="container">
            
            <h2 class="text-center text-black">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="post">
                <fieldset>
                    <legend>Selected Hoarding</legend>

                    <div class="hoarding-menu-img">
                        <?php
                            if($image_name==""){
                                //image not available
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else{
                                //image available
                                ?>
                                    <img src="<?php echo SITEURL;?>images/hoarding/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="hoarding-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="hoarding" value="<?php echo $title;?>">
                        
                        <p class="hoarding-price"><?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <!-- <div class="order-label">Location</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required> -->
                        
                    </div>

                </fieldset>
                
                <legend style="margin-left: 2rem; font-size: 20px;">Hoarding Details</legend>
                <fieldset class="details1">
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John Marieo" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                if(isset($_POST['submit'])){
                    //get all details
                    $hoarding=$_POST['hoarding'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];

                    $total=$price*$qty; //total price
                    $order_date=date("Y-m-d h-i-sa");// read as year-month-date hour-minute-second a.m/p.m 
                    $status="Ordered";  //ordered, On-Delievery, Delivered, Cancelled
                    
                    $customer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];

                    $sql2="INSERT INTO tbl_order SET
                    hoarding='$hoarding',
                    price=$price,
                    qty=$qty,
                    total=$total,
                    order_date='$order_date',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact=$customer_contact,
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    ";

                    $res2=mysqli_query($conn,$sql2);
                    if($res2){
                        //query executed 
                        $_SESSION['order']="<div class='success text-center'>hoarding Ordered Successfully</div>";

                        $_SESSION['display']="<div class='text-center'>Your Order of $hoarding is $status</div>";
                        
                        header("location:".SITEURL.'index.php');
                    }
                    else{
                        $_SESSION['order']="<div class='error text-center'>Failed to Order hoarding!</div>";
                        header("location:".SITEURL);
                        //failed to execute query
                    }

                }
            
            ?>

        </div>
    </section>
    <!-- hoarding sEARCH Section Ends Here -->
<?php include('partials-front/footer.php'); ?>