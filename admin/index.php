<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['authenticated'])) {
    // If not authenticated, redirect to login.php
    header("Location: login.php");
    exit(); // Ensure no further code is executed
}
// session_unset();
// session_destroy();
?>

<?php include('partials/menu.php'); ?>

<!--Main-Content Section Starts-->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <div class="col-4 text-center">
             <?php
                // $sql="SELECT * FROM tbl_category";
                // $res=mysqli_query($conn,$sql);
                // $count=mysqli_num_rows($res);

            ?>
            <h2><?php echo 180;?></h2>
            <br>
            Our Users
        </div>
        <div class="col-4 text-center">
            <?php
                // $sql2="SELECT * FROM tbl_hoarding";
                // $res2=mysqli_query($conn,$sql2);
                // $count2=mysqli_num_rows($res2);

            ?>
            <h2><?php echo 59;?></h2>
            <br>
            Space Owners Connected
        </div>
        <div class="col-4 text-center">
            <?php
                // $sql3="SELECT * FROM tbl_order";
                // $res3=mysqli_query($conn,$sql3);
                // $count3=mysqli_num_rows($res3);

            ?>
            <h2><?php echo 87;?></h2>
            <br>
            Total Successfull Billboards
        </div>
        <div class="col-4 text-center">
            <?php
                $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='delivered'";
                $res4=mysqli_query($conn,$sql4);
                $row4=mysqli_fetch_assoc($res4);
                $total_revenue=$row4['Total']; 
            ?>
            <h2><?php echo 78990;?></h2>
            <br>
            Revenue Generated
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--Main-Content Section Ends-->

<?php include('partials/footer.php'); ?>
