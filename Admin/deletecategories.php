<?php
include('../connection.php');

$get_id=$_GET['category_id'];
// sql to delete a record
$sql = "DELETE FROM categories WHERE category_id=$get_id";

if ($conn->query($sql) === TRUE) {
  echo"<script>window.alert('succesfully deleted!');</script>";
  echo"<script>window.location='categories.php'</script>"; 
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>