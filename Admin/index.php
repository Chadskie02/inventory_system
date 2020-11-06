<?php include('header.php'); ?>
<?php include('navigation.php'); ?>
            <!-- Page Content -->
            <div id="page-wrapper">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Dashboard</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">                        
                        <div class="col-lg-4 col-md-12">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-tasks fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php 
                                            $sql = "SELECT * FROM products WHERE product_status = 'available'";
                                            $result = mysqli_query($conn, $sql);

                                            $rows_count_value = mysqli_num_rows($result);
                                            ?>
                                            <div class="huge"><?php echo $rows_count_value; ?></div>
                                            <div>Total Products!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="products">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-support fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php 
                                            $sql = "SELECT * FROM products WHERE product_status = 'available' AND product_quantity <= '10'";
                                            $result = mysqli_query($conn, $sql);

                                            $rows_count_value = mysqli_num_rows($result);
                                            ?>
                                            <div class="huge"><?php echo $rows_count_value; ?></div>
                                            <div>Low Stock!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="products">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-money fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php 
                                            $total = 0;
                                            $sql = "SELECT * FROM orders";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                            while($row = mysqli_fetch_assoc($result)) {

                                            $total += $row['product_rate'] * $row['order_quantity'];
                                            }
                                            ?>
                                            <div class="huge"><?php echo $total; ?></div>
                                            
                                            <?php  } ?>
                                            <div>Total Revenue!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="products">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div> 
               
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-shopping-cart fa-3x"></i>
                                            <div>Total Orders</div>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php 
                                            $sql = "SELECT * FROM orders WHERE order_status = 'approve'";
                                            $result = mysqli_query($conn, $sql);

                                            $rows_count_value = mysqli_num_rows($result);
                                            ?>
                                            <div class="huge"><?php echo $rows_count_value; ?></div>
                                        </div>
                                    </div>
                                </div>                               
                                <div class="panel-body">
                                    <table class="table" id="productTable">
                                        <thead>
                                        <tr>			  			
                                            <th style="width:40%;">Name</th>
                                            <th style="width:20%;">Orders</th>
                                        </tr>
                                        </thead>                                        
                                            <?php 
                                            $sql = "SELECT * FROM orders WHERE order_status = 'approve'";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                  // output data of each row
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $order_id=$row['order_id'];
                                            ?>

                                        <tbody>
                                            <tr>
                                                <td><?php echo $row["client_name"]; ?></td>
                                                <td><?php echo $row["product_rate"]; ?></td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                    <!--<div id="calendar"></div>-->
                                </div>
                                
                                    <div class="panel-footer">
                                        <div class="clearfix"></div>
                                    </div>	
                            </div>
                        </div> 
                                               
                    </div>
                </div>            
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

<?php include('footer.php'); ?>

