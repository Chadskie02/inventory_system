<?php
include('../connection.php');

$get_id=$_GET['product_id'];



$sql = "SELECT * FROM products WHERE product_id=$get_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
      // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $product_id=$row['product_id'];

$target_file = $row["image_name"];

unlink("$target_file");

} 
}
// sql to delete a record
$sql = "DELETE FROM products WHERE product_id=$get_id";

$qry2 = "DELETE FROM orders WHERE product_id=$get_id";
$conn->query($qry2); 

if ($conn->query($sql) === TRUE) {
  echo"<script>window.alert('succesfully deleted!');</script>";
  echo"<script>window.location='products.php'</script>"; 
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>