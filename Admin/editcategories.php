<?php
include('../connection.php');
include('header.php');

$get_id=$_GET['category_id'];
    
// $categories_id=$_REQUEST['categories_id'];

$sql = "SELECT * FROM categories WHERE category_id = $get_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $category_id=$row['category_id'];
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
                                            <h4>Update categorys</h4>
                                            <hr>   
                                            <div class="control-group">
                                                    <label class="control-label" for="inputPassword">categorys Name:</label>
                                                    <input type="text" class="form-control" name="category_name" required value=<?php echo $row['category_name']; ?>>
                                            </div>
                                                                                                                                   
                                            <div class="control-group" >
                                                    <label class="control-label" for="pwd">category Status:</label>
                                                <select name="category_status" id="status" class="form-control">
                                                <?php
                                                 if($row['category_status'] == 'available'){
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
                                                <a href="categorys.php" class="btn btn-outline btn-default">Back</a>
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
    
    $category_name_save= $_POST['category_name'];
    $category_status_save= $_POST['category_status'];
             
    $sql = "UPDATE categories SET category_name='$category_name_save',category_status='$category_status_save' WHERE category_id=$get_id";
    $conn->query($sql);        
    
    echo"<script>window.location='categories.php'</script>"; 
}
?>
<?php include('footer.php'); ?>