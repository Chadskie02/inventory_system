<?php session_start(); ?>
<?php include('header.php'); ?>
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
        
    }

$email = $password = "";
$emailError = $passwordError = "";

if(isset($_POST["log"])){
 
    if(empty($_POST["email"])){
        $emailError = "Email is Required";
    } else {
        $email = $_POST["email"];
    }

    if(empty($_POST["password"])){
        $passwordError = "Password is Required";
    } else {
        $password = $_POST["password"];
    }

    if($email && $password){
        $check_email = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
        $check_email_row = mysqli_num_rows($check_email);

        if($check_email_row > 0){
            $row = mysqli_fetch_assoc($check_email);
            $user_id = $row["id"];
            $db_password = $row["password"];
            $account_type = $row["account_type"];
            $verify=password_verify($_POST['password'],$row["password"]);


            if($verify == 1){

                $_SESSION["id"] = $user_id;

                if($account_type == 1){
                    // redirect to admin panel
                    sleep(3);
                    echo"<script>window.location='Admin/index'</script>"; 
                }  //else {
                    // redirect to user panel
                     //echo"<script>window.location='User/index'</script>"; 
                // }
                    
            } else {
                $passwordError = "Password is Incorrect!";
            }

        } else {
            $emailError = "Email is not registered!";
        }

    }

}

?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" value="<?php echo $email; ?>">
                                        <span class="error"><?php echo $emailError; ?></span> 
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                        <span class="error"><?php echo $passwordError; ?></span> 
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" name="log" class="btn btn-lg btn-success btn-block">Login</button>
                                </fieldset>
                            </form>
                        </div>
                    <ol class="breadcrumb" style="background-color:#ffffff;">
                        <li><a href="register">Register</a></li>		  
                        <li class="active">Login</li>
                    </ol>                        
                    </div>
                </div>
            </div>
        </div>
</body>
<?php include('footer.php'); ?>