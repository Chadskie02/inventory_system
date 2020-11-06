<?php include('header.php'); ?>
<?php include('navigation.php'); ?>
            <!-- Page Content -->
            <div id="page-wrapper">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                        <!-- Trigger the modal with a button -->
                            <h1 class="page-header">Products</h1>
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
                                                    <th>Product ID</th>
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Rate</th>
                                                    <th>Brand</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th>Quantity</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $sql = "SELECT * FROM products";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                  // output data of each row
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $product_id=$row['product_id'];
                                            ?>
                                                <tr role="row">
                                                    <td class="sorting_1"><?php echo $row["product_id"]; ?></td>
                                                    <td><img src="<?php echo $row["image_name"]; ?>" width="100px" height="100px" /></td>
                                                    <td><?php echo $row["product_name"]; ?></td>
                                                    <td><?php echo $row["product_rate"]; ?></td>
                                                    <td><?php echo $row["product_brand"]; ?></td>
                                                    <td><?php echo $row["product_category"]; ?></td>
                                                    <td><?php echo $row["product_status"]; ?></td>

                                                    <?php if($row["product_quantity"] <= 10){ ?>
                                                    <td><label class="label label-danger"><?php echo $row["product_quantity"]; ?></label></td>
                                                    <?php }else{ ?>
                                                    <td><?php echo $row["product_quantity"]; ?></td>
                                                    <?php } ?>

                                                    <td> <a href="editproducts.php<?php echo '?product_id='.$product_id; ?>" class="btn btn-outline btn-success">Edit</a>
                                                         <a href="#delete<?php echo $product_id;?>"  data-toggle="modal"  class="btn btn-outline btn-danger">Delete </a>
                                                    </td>
                                                </tr>

                                                    <div id="delete<?php  echo $product_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
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
                                                                    <a href="deleteproducts.php<?php echo '?product_id='.$product_id; ?>" class="btn btn-danger">Yes</a>
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
        <h4 class="modal-title">Add Materials</h4>
      </div>
        <div class="modal-body">
            <div style="margin: auto; width: 100%;">
                <form name = "form1" action="" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label>Select image to upload:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <div class="form-group">
                        <label>Product Name:</label>
                        <input type="text" class="form-control" id="product_name" placeholder="Product Name" name="product_name">
                    </div>
                    <div class="form-group">
                        <label>Product Rate:</label>
                        <input type="text" class="form-control" id="product_rate" placeholder="Product Rate" name="product_rate">
                    </div>
                    <div class="form-group">
                        <label>Product Brand:</label>
                        <select name="product_brand" id="product_brand" class="form-control">
                            <option value="">--Select Option--</option>
                            <?php 
                            $sql = "SELECT * FROM brands WHERE brand_status = 'available'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                            $brand_id=$row['brand_id'];

                            ?>
                            
                            <option value="<?php echo $row["brand_name"]; ?>"><?php echo $row["brand_name"];  ?></option>
    
                            <?php } } ?>
                        </select>                        
                    </div>   
                    <div class="form-group">
                        <label>Product Category:</label>
                        <select name="product_category" id="product_category" class="form-control">
                            <option value="">--Select Option--</option>
                            <?php 
                            $sql = "SELECT * FROM categories WHERE category_status = 'available'";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                            $category_id=$row['category_id'];

                            ?>
                            
                            <option value="<?php echo $row["category_name"]; ?>"><?php echo $row["category_name"];  ?></option>
    
                            <?php } } ?>
                        </select>                    
                    </div>                                                         
                    <div class="form-group" >
                        <label>Product Status:</label>
                        <select name="product_status" id="product_status" class="form-control">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Quantity:</label>
                        <input type="number" class="form-control" id="product_quantity" placeholder="Product Quantity" name="product_quantity" min="1" max="9999">
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

    $product_name=$_POST['product_name'];
    $product_rate=$_POST['product_rate'];
    $product_brand=$_POST['product_brand'];
    $product_category=$_POST['product_category'];
    $product_status=$_POST['product_status'];
    $product_quantity=$_POST['product_quantity'];


    $qry2 = ("SELECT * FROM products WHERE product_name = '$product_name'");
    $res = mysqli_query($conn, $qry2);

    if (mysqli_num_rows($res) <= 0) {

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "<script>window.alert('File is not an image.');</script>";
          $uploadOk = 0;
        }        

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>window.alert('Sorry, your file was not uploaded. Because file already exists.');</script>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "<script>window.alert('Sorry, your file was not uploaded. Because your file is too large.');</script>";
            $uploadOk = 0;
        }      
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "<script>window.alert('Sorry, your file was not uploaded. Because only JPG, JPEG, PNG & GIF files are allowed.');</script>";
            $uploadOk = 0;
        }      
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo"
            <script>
            window.location='products.php'
            </script>";   
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
            #sql query to insert into database
            $qry2 = "INSERT INTO products (product_name, product_rate, product_brand, product_category, product_quantity, product_status, image_name) 
            VALUES ('$product_name', '$product_rate', '$product_brand', '$product_category', '$product_quantity', '$product_status', '$target_file')";
        

            } else {
            echo"
            <script>
            window.alert('Sorry, there was an error uploading your file.'); 
            window.location='products.php'
            </script>"; 
            }
        }        

        if ($conn->query($qry2) === TRUE) {
            echo"
            <script>
            window.alert('$product_name details has been sent');
            window.location='products.php'
            </script>"; 
          } else {
            echo "Error: " . $qry2 . "<br>" . $conn->error;
          }  

    } else{
        
        $product_quantity;

        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
        
                $product_id=$row['product_id'];
                $product_name=$row['product_name'];
                $row['product_quantity'];

                $total=$product_quantity+$row['product_quantity'];        

                if($total >= 10000){

                    echo "<script>window.alert('Sorry we cannot process your request because $product_name exceed the limit 10,000');</script>";

                } else{

                $sql = "UPDATE products SET product_quantity='$total' WHERE product_id=$product_id";

                if (mysqli_query($conn, $sql)) {  
                    echo "<script>window.alert('$product_quantity has been added to $product_name ');</script>";
                    echo"<script>window.location='products.php'</script>"; 
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                }
            }
        }
    }
    mysqli_close($conn);

}

?>
<?php include('footer.php'); ?>