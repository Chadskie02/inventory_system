<?php
    include('../connection.php');
    
	$material_name=$_POST['material_name'];
	$material_status=$_POST['material_status'];
    $material_quantity=$_POST['material_quantity'];
    
    $sql = "INSERT INTO materials (material_name, material_status, material_quantity)
    VALUES ('$material_name', '$material_status', '$material_quantity')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
    



    // $material_name=$_POST['material_name'];
    // $material_status=$_POST['material_status'];
    // $material_quantity=$_POST['material_quantity'];

    // $sql = "INSERT INTO materials (material_name, material_status, material_quantity)
    // VALUES ('$material_name', '$material_status', '$material_quantity')";
    
    // if (mysqli_query($conn, $sql)) {  
    //   echo"<script>window.location='materials.php'</script>"; 
    // } else {
    //   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
    
    // mysqli_close($conn);




?>