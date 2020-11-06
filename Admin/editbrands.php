<?php
include('../connection.php');
include('header.php');

$get_id=$_GET['brand_id'];
    
// $categories_id=$_REQUEST['categories_id'];

$sql = "SELECT * FROM brands WHERE brand_id = $get_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $brand_id=$row['brand_id'];
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
                                            <h4>Update brands</h4>
                                            <hr>   
                                            <div class="control-group">
                                                    <label class="control-label" for="inputPassword">brands Name:</label>
                                                    <input type="text" class="form-control" name="brand_name" required value=<?php echo $row['brand_name']; ?>>
                                            </div>
                                                                                            
                                            <div class="control-group" >
                                                    <label class="control-label" for="pwd">brand Status:</label>
                                                <select name="brand_status" id="status" class="form-control">
                                                <?php
                                                 if($row['brand_status'] == 'available'){
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
                                                <a href="brands.php" class="btn btn-outline btn-default">Back</a>
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
    
    $brand_name_save= $_POST['brand_name'];
    $brand_status_save= $_POST['brand_status'];
             
    $sql = "UPDATE brands SET brand_name='$brand_name_save',brand_status='$brand_status_save' WHERE brand_id=$get_id";
    $conn->query($sql);        
    
    echo"<script>window.location='brands.php'</script>"; 
}
?>
<?php include('footer.php'); ?>