<?php include('header.php'); ?>
<?php include('navigation.php'); ?>
            <!-- Page Content -->
            <div id="page-wrapper">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                        <!-- Trigger the modal with a button -->
                            <h1 class="page-header">Orders</h1>
                            <button type="button" class="btn btn-outline btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Add</button>
                            </br>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Tables
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">                            
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Order Name</th>
                                                    <th>Order Status</th>
                                                    <th>Order Quantity</th>
                                                    <th>Product ID</th>
                                                    <th>Product Rate</th>
                                                    <th>Order Date</th>
                                                    <th>Client Name</th>
                                                    <th>Client Number</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $sql = "SELECT * FROM orders";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                  // output data of each row
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $order_id=$row['order_id'];
                                            ?>
                                                <tr role="row">
                                                    <td class="sorting_1"><?php echo $row["order_id"]; ?></td>
                                                    <td><?php echo $row["order_name"]; ?></td>
                                                    <td><?php echo $row["order_status"]; ?></td>
                                                    <td><?php echo $row["order_quantity"]; ?></td>
                                                    <td><?php echo $row["product_id"]; ?></td>
                                                    <td><?php echo $row["product_rate"]; ?></td>
                                                    <td><?php echo $row["order_date"]; ?></td>
                                                    <td><?php echo $row["client_name"]; ?></td>
                                                    <td><?php echo $row["client_number"]; ?></td>
                                                    <td> <a href="editorders.php<?php echo '?order_id='.$order_id; ?>" class="btn btn-outline btn-success">Edit</a>
                                                         <a href="#delete<?php echo $order_id;?>"  data-toggle="modal"  class="btn btn-outline btn-danger">Delete </a>
                                                    </td>
                                                </tr>

                                                    <div id="delete<?php  echo $order_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                                                        <div class="container">    
                                                            <div class="modal-content" style="margin-top:100px;">
                                                                <div class="modal-header">
                                                                    <h3 id="myModalLabel">Delete</h3>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div style="margin: auto; width: 100%;">
                                                                        <p><div class="alert alert-danger">Are you Sure you want Delete?</p>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
                                                                    <a href="deleteorders.php<?php echo '?order_id='.$order_id; ?>" class="btn btn-danger">Yes</a>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    </div>

                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Orders</h4>
      </div>
        <div class="modal-body">
            <div style="margin: auto; width: 100%;">
                <form id="fupForm" name="form1" method="post">
                    <div class="form-group">
                        <label>Order Date:</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" required>
                    </div>
                    <div class="form-group">
                        <label>Client Name:</label>
                        <input type="text" class="form-control" id="client_name" placeholder="Client Name" name="client_name" required>
                    </div>
                    <div class="form-group">
                        <label>Client Contact Number:</label>
                        <input type="number" class="form-control" id="client_number" placeholder="Contact Number" name="client_number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Order Name:</label>
                        <select name="order_name" id="order_name" class="form-control">
                            <?php 
                            $sql = "SELECT * FROM products WHERE product_status = 'available'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                            $product_id=$row['product_id'];

                            ?>
                            
                            <option value="<?php echo $row["product_name"]; ?>"><?php echo $row["product_name"];  ?></option>
    
                            <?php } } ?>
                        </select>
                    </div>
                    <div class="form-group" >
                        <label>Order Status:</label>
                        <select name="order_status" id="order_status" class="form-control">
                            <option value="approve">Approve</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Order Quantity:</label>
                        <input type="number" class="form-control" id="order_quantity" placeholder="Order Quantity" name="order_quantity" min="1" max="9999" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save to database" id="butsave">
                </form>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php

if(isset($_POST["submit"])){


    $order_date=$_POST['order_date'];
    $client_name=$_POST['client_name'];
    $client_number=$_POST['client_number'];
    $order_name=$_POST['order_name'];
    $order_status=$_POST['order_status'];
    $order_quantity=$_POST['order_quantity'];    
    

    $qry2 = ("SELECT * FROM orders WHERE order_name = '$order_name'");
    $res = mysqli_query($conn, $qry2);

    if (mysqli_num_rows($res) <= 0) {

        $qry3 = ("SELECT * FROM products WHERE product_name = '$order_name'");
        $res3 = mysqli_query($conn, $qry3);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $res3->fetch_assoc()) {
            
            $product_id=$row['product_id'];
            $product_name=$row['product_name'];
            $product_rate=$row['product_rate'];
            $product_quantity=$row['product_quantity'];

            $reduceProd=$row['product_quantity']-$order_quantity;

            if($row['product_quantity'] <= $order_quantity){
                
                echo "<script>window.alert('Sorry we cannot process your request because $product_name remaining stock is $product_quantity');</script>";

            } else{

                $qry2 = "UPDATE products SET product_quantity='$reduceProd' WHERE product_id=$product_id";  
                $conn->query($qry2); 
        
                $sql = "INSERT INTO orders (order_name, order_status, order_quantity, product_id, product_rate, order_date, client_name, client_number)
                VALUES ('$order_name', '$order_status', '$order_quantity', '$product_id', '$product_rate', '$order_date', '$client_name', '$client_number')";
                
                        if (mysqli_query($conn, $sql)) {  
        
                        echo"<script>window.location='orders.php'</script>"; 
        
                        } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
            }
            }
        }    
    } else{
        
        $order_quantity;

        if ($res->num_rows > 0) {
            while($row2 = $res->fetch_assoc()) {

                $qry3 = ("SELECT * FROM products WHERE product_name = '$order_name'");
                $res3 = mysqli_query($conn, $qry3);
        
                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $res3->fetch_assoc()) {
                    
                    $product_id=$row['product_id'];
                    $product_name=$row['product_name'];
                    $product_quantity=$row['product_quantity'];
        
                    $reduceProd=$row['product_quantity']-$order_quantity;
        
                    if($row['product_quantity'] <= $order_quantity){
                        
                        echo "<script>window.alert('Sorry we cannot process your request because $product_name remaining stock is $product_quantity');</script>";
        
                    } else{

                        $qry2 = "UPDATE products SET product_quantity='$reduceProd' WHERE product_id=$product_id";  
                        $conn->query($qry2); 

                        $row2['order_quantity'];
                        $id=$row2['order_id'];
        
                        $total=$row2['order_quantity']+$order_quantity;        
        
                        $sql = "UPDATE orders SET order_quantity='$total' WHERE order_id=$id";
        
                        if (mysqli_query($conn, $sql)) {  
                            echo "<script>window.alert('$order_quantity has been added to $order_name ');</script>";
                            echo"<script>window.location='orders.php'</script>"; 
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                }
            } 
            }
        }
    }
    mysqli_close($conn);

}

?>
<?php include('footer.php'); ?>