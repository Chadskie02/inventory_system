<?php
include('../connection.php');

$get_id=$_GET['brand_id'];
// sql to delete a record
$sql = "DELETE FROM brands WHERE brand_id=$get_id";

if ($conn->query($sql) === TRUE) {
  echo"<script>window.alert('succesfully deleted!');</script>";
  echo"<script>window.location='brands.php'</script>"; 
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>