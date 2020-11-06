<?php
include('../connection.php');
include('header.php');

$get_id=$_GET['order_id'];
    
// $categories_id=$_REQUEST['categories_id'];

$sql = "SELECT * FROM orders WHERE order_id = $get_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $order_id=$row['order_id'];
?>
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Forms</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Basic Form Elements
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="container">
                                        <form class="form-horizontal" method="post"  enctype="multipart/form-data">                                               
                                            <h4>Update orders</h4>
                                            <hr> 
                                            <div class="control-group">
                                                    <label class="control-label">Order Name:</label>
                                                    <input type="text" class="form-control" name="order_name" required value="<?php echo $row['order_name']; ?>">
                                            </div>
                                                                                            
                                            <div class="control-group">
                                                    <label class="control-label">Order Quantity:</label>
                                                    <input type="text" class="form-control" name="order_quantity" required value="<?php echo $row['order_quantity']; ?>" id="order_quantity" min="1" max="9999">
                                            </div>
                                                                                            
                                            <div class="control-group" >
                                                    <label class="control-label">Order Status:</label>
                                                <select name="order_status" id="status" class="form-control">
                                                <?php
                                                 if($row['order_status'] == 'approve'){
                                                ?>
                                                    <option value="approve">Approve</option>
                                                    <option value="pending">Pending</option>
                                                <?php
                                                 }  else {
                                                ?>
                                                    <option value="approve">Approve</option>
                                                    <option value="pending">Pending</option>                                                  
                                                <?php  
                                                 }
                                                 ?>
                                                </select>
                                            </div>

                                            <div class="control-group">
                                                    <label class="control-label">Product Rate:</label>
                                                    <input type="text" class="form-control" required value="<?php echo $row['product_rate']; ?>" disabled>
                                            </div>

                                            <div class="control-group">
                                                <label>Client Name:</label>
                                                <input type="text" class="form-control" value="<?php echo $row['client_name']; ?>" name="client_name" required>
                                            </div>

                                            <div class="control-group">
                                                <label>Client Contact Number:</label>
                                                <input type="number" class="form-control" value="<?php echo $row['client_number']; ?>" name="client_number" required>
                                            </div>

                                            <div class="control-group">
                                                    <label class="control-label">Order Date:</label>
                                                    <input type="date" class="form-control" value="<?php echo $row['order_date']; ?>" name="order_date" required>
                                            </div>
                                                                                                                                                                    
                                            <div class="control-group" style="margin-top:12px;">
                                                <button type="submit" name="update" class="btn btn-outline btn-success">Update</button>
                                                <a href="orders.php" class="btn btn-outline btn-default">Back</a>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>


<?php
  }
}

if (isset($_POST['update'])) {
    
    $order_name_save= $_POST['order_name'];
    $order_status_save= $_POST['order_status'];
    $order_quantity_save= $_POST['order_quantity'];

    $order_date_save= $_POST['order_date'];
    $client_name_save= $_POST['client_name'];
    $client_number_save= $_POST['client_number'];
             
    $sql = "UPDATE orders SET order_name='$order_name_save',order_status='$order_status_save',order_quantity='$order_quantity_save',order_date='$order_date_save',client_name='$client_name_save',client_number='$client_number_save' WHERE order_id=$get_id";
    $conn->query($sql);        
    
    echo"<script>window.location='orders.php'</script>"; 
}
?>
<?php include('footer.php'); ?>