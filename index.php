<?php session_start(); ?>
<?php include('connection.php'); ?>

<?php 
    if(isset($_SESSION["id"])){
        $user_id = $_SESSION["id"];
        $get_record = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
        $row = mysqli_fetch_assoc($get_record);
        @$account_type = $row["account_type"];

        if($account_type == 1){
            // redirect to admin panel
            echo"<script>window.location='Admin/index'</script>"; 
        } else {
            // redirect to user panel
            echo"<script>window.location='User/index'</script>"; 
        }
        
    } else {
        echo"<script>window.location='/inventory_system/login'</script>"; 
    }

?>   