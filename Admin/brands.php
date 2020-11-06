<?php include('header.php'); ?>
<?php include('navigation.php'); ?>
            <!-- Page Content -->
            <div id="page-wrapper">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                        <!-- Trigger the modal with a button -->
                            <h1 class="page-header">Brands</h1>
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
                                                    <th>Brand ID</th>
                                                    <th>Brand Name</th>
                                                    <th>Brand Status</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $sql = "SELECT * FROM brands";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                  // output data of each row
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    $brand_id=$row['brand_id'];
                                            ?>
                                                <tr role="row">
                                                    <td class="sorting_1"><?php echo $row["brand_id"]; ?></td>
                                                    <td><?php echo $row["brand_name"]; ?></td>
                                                    <td><?php echo $row["brand_status"]; ?></td>
                                                    <td> <a href="editbrands.php<?php echo '?brand_id='.$brand_id; ?>" class="btn btn-outline btn-success">Edit</a>
                                                         <a href="#delete<?php echo $brand_id;?>"  data-toggle="modal"  class="btn btn-outline btn-danger">Delete </a>
                                                    </td>
                                                </tr>

                                                    <div id="delete<?php  echo $brand_id;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
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
                                                                    <a href="deletebrands.php<?php echo '?brand_id='.$brand_id; ?>" class="btn btn-danger">Yes</a>
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
        <h4 class="modal-title">Add Brands</h4>
      </div>
        <div class="modal-body">
            <div style="margin: auto; width: 100%;">
                <form id="fupForm" name="form1" method="post">
                    <div class="form-group">
                        <label for="email">Brand Name:</label>
                        <input type="text" class="form-control" id="brand_name" placeholder="Brand Name" name="brand_name">
                    </div>
                    <div class="form-group" >
                        <label for="pwd">Brand Status:</label>
                        <select name="brand_status" id="brand_status" class="form-control">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
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

    $brand_name=$_POST['brand_name'];
    $brand_status=$_POST['brand_status'];
 
        $sql = "INSERT INTO brands (brand_name, brand_status)
        VALUES ('$brand_name', '$brand_status')";
        
        if (mysqli_query($conn, $sql)) {  
          echo"<script>window.location='brands.php'</script>"; 
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }        
        
    mysqli_close($conn);

}

?>
<?php include('footer.php'); ?>