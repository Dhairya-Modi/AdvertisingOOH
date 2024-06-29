<?php include("partials/menu.php")?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1>
            <br><br>
            <?php
                session_start();
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <!-- <a href="#" class="btn-primary">Add Admin</a> -->
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>hoarding</th>
                    <th>Price</th>
                    <th>Order date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>

                </tr>
                <?php
                    $sql="SELECT * FROM tbl_order ORDER BY id DESC";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $hoarding=$row['hoarding'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $status=$row['status'];
                            $total=$row['total'];
                            $order_date=$row['order_date'];
                            $customer_name=$row['customer_name'];
                            $customer_contact=$row['customer_contact'];
                            $customer_email=$row['customer_email'];
                            $customer_address=$row['customer_address'];
                            ?>
                            <tr>
                                <td><?php echo $sn++;?> </td>
                                <td width="130px"><?php echo $hoarding;?></td>
                                <td width="60px"><?php echo $price;?></td>            
                                <td width="110px"><?php echo $order_date;?></td>

                                <td width="80px">
                                    <?php 
                                        if($status=="Ordered"){
                                            echo "<label>$status</label>";
                                        }
                                        elseif($status=="Pending"){
                                            echo "<label style='color: orange;'>$status</label>";
                                        }
                                        elseif($status=="Confirmed"){
                                            echo "<label style='color: green;'>$status</label>";
                                        }
                                        elseif($status=="Expired"){
                                            echo "<label style='color: red;'>$status</label>";
                                        }
                                    ?>
                                </td>
                                

                                <td width="100px"><?php echo $customer_name;?></td>
                                <td><?php echo $customer_contact;?></td>
                                <td><?php echo $customer_email;?></td></n>
                                <td width="160px"><?php echo $customer_address;?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary"> Update Order </a>
                                </td>
                            </tr>
                           <?php 
                        }
                    }
                    else{
                        echo "<tr><td colspan ='12' class='error'>Orders not available</td></tr>";
                    }
                    
                    ?>
                    
            </table>
        </div>
    </div>
<?php include("partials/footer.php")?>

