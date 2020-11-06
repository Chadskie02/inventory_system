<?php
include('../connection.php');
include('header.php');

$get_id=$_GET['product_id'];
    
// $categories_id=$_REQUEST['categories_id'];

$sql = "SELECT * FROM products WHERE product_id = $get_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $product_id=$row['product_id'];
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
                                        <form class="form-horizontal" action="" method="post"  enctype="multipart/form-data">                                               
                                            <h4>Update Products</h4>
                                            <hr> 
                                            <div class="form-group">
                                                <label>Select image to upload:</label>
                                                <p></p>
                                                <img src="<?php echo $row["image_name"]; ?>" width="100px" height="100px" style="border:1px dashed black;" />
                                                <p></p>
                                                <input type="file" name="fileToUpload" value="" id="fileToUpload">
                                                
                                            </div>  
                                            <div class="control-group">
                                                    <label class="control-label">Products Name:</label>
                                                    <input type="text" class="form-control" name="product_name" required value="<?php echo $row['product_name']; ?>">
                                            </div>

                                            <div class="control-group">
                                                    <label class="control-label">Rate:</label>
                                                    <input type="text" class="form-control" name="product_rate" required value="<?php echo $row['product_rate']; ?>">
                                            </div>

                                            <div class="control-group">
                                                    <label class="control-label">Brand:</label>
                                                    <input type="text" class="form-control" name="product_brand" required value="<?php echo $row['product_brand']; ?>">
                                            </div>

                                            <div class="control-group">
                                                    <label class="control-label">Category:</label>
                                                    <input type="text" class="form-control" name="product_category" required value="<?php echo $row['product_category']; ?>">
                                            </div>                                            

                                            <div class="control-group">
                                                    <label class="control-label">Quantity:</label>
                                                    <input type="text" class="form-control" name="product_quantity" required value="<?php echo $row['product_quantity']; ?>">
                                            </div>
                                                                                            
                                            <div class="control-group" >
                                                    <label class="control-label">Product Status:</label>
                                                <select name="product_status" id="status" class="form-control">
                                                <?php
                                                 if($row['product_status'] == 'available'){
                                                ?>
                                                    <option value="available">Available</option>
                                                    <option value="unavailable">Unavailable</option>
                                                <?php
                                                 }  else {
                                                ?>
                                                    <option value="unavailable">Unavailable</option>
                                                    <option value="available">Available</option>                                                    
                                                <?php  
                                                 }
                                                 ?>
                                                </select>
                                            </div>
                                                                                                                                                                    
                                            <div class="control-group" style="margin-top:10px;">
                                                <button type="submit" name="update" class="btn btn-outline btn-success">Update</button>
                                                <a href="products.php" class="btn btn-outline btn-default">Back</a>
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
    
    $product_name_save=$_POST['product_name'];
    $product_rate_save=$_POST['product_rate'];
    $product_brand_save=$_POST['product_brand'];
    $product_category_save=$_POST['product_category'];
    $product_status_save=$_POST['product_status'];
    $product_quantity_save=$_POST['product_quantity'];
   
    $check = $_FILES["fileToUpload"]["tmp_name"];

    if($check == ""){

        $sql = "UPDATE products 
        SET product_name='$product_name_save', product_rate='$product_rate_save', product_brand='$product_brand_save', product_category='$product_category_save', product_status='$product_status_save', product_quantity='$product_quantity_save'
        WHERE product_id=$get_id";

        if ($conn->query($sql) === TRUE) {
            echo "<script>window.alert('Details updated successfully');</script>";
            echo"<script>window.location='editproducts?product_id=$get_id'</script>";  
        } else {
            echo "Error updating record: " . $conn->error;
        }


    }else{   

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
          echo "File is not an image.";
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
            window.location='editproducts?product_id=$get_id'
            </script>";   
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
            #sql query to insert into database
            $qry2 = "UPDATE products 
            SET product_name='$product_name_save', product_rate='$product_rate_save', product_brand='$product_brand_save', product_category='$product_category_save', product_status='$product_status_save', product_quantity='$product_quantity_save', image_name='$target_file'
            WHERE product_id=$get_id";
                   
            } else {
            echo"
            <script>
            window.alert('Sorry, there was an error uploading your file.'); 
            window.location='editproducts?product_id=$get_id'
            </script>"; 
            }
        }        

        if ($conn->query($qry2) === TRUE) {
            echo"
            <script>
            window.alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " and details has been updated.');
            window.location='editproducts?product_id=$get_id'
            </script>"; 
          } else {
            echo "Error: " . $qry2 . "<br>" . $conn->error;
          }                 
        }
    }
}
?>
<?php include('footer.php'); ?>