<?php
include('../connection.php');

$get_id=$_GET['order_id'];
// sql to delete a record
$sql = "DELETE FROM orders WHERE order_id=$get_id";

if ($conn->query($sql) === TRUE) {
  echo"<script>window.alert('succesfully deleted!');</script>";
  echo"<script>window.location='orders.php'</script>"; 
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>