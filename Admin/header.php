<?php
    session_start(); 

    if(isset($_SESSION["id"])){
        include('../connection.php');
        $user_id = $_SESSION["id"];
        $get_record = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
        $row = mysqli_fetch_assoc($get_record);
        @$account_type = $row["account_type"];

        if($account_type == 0){
            // redirect to User panel
            header('Location: ../User/index'); 
        }

        $get_record = mysqli_query($conn, "SELECT * FROM user_registration WHERE id = '$user_id'");
        $row = mysqli_fetch_assoc($get_record);

        $db_first_name = $row["firstname"];
        $db_middle_name = $row["middlename"];
        $db_last_name = $row["lastname"];

        $db_full_name = $row["firstname"] .' '. $row["middlename"] .' '. $row["lastname"];

    }else{

        echo "<script>window.location='../login.php'</script>";

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Inventory System</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Style CSS -->
        <link href="../css/style.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>






  

            