<?php include('header.php'); ?>
<?php include('connection.php'); ?>
<?php 

$first_name =  $middle_name =  $last_name = $email = $password = $cpassword = $gender ="";

$first_nameError = $middle_nameError = $last_nameError = $emailError = $passwordError = $cpasswordError = $genderError ="";

if(isset($_POST["submit"])){

    if(empty($_POST["email"])){
        $emailError = "You Forgot to Enter Your Email!";
    }else{
        $email = $_POST["email"];
    }

    if(empty($_POST["password"])){
        $passwordError = "field is required";
    }else{
        $password = $_POST["password"];
    }

    if(empty($_POST["cpassword"])){
        $cpasswordError = "field is required";
    }else{
        $cpassword = $_POST["password"];
    }    
 
    if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        if (strlen($_POST["password"]) <= '8') {
            $passwordError = "Your Password Must Contain At Least 8 Characters!";
        }
        elseif(!preg_match("#[0-9]+#",$password)) {
            $passwordError = "Your Password Must Contain At Least 1 Number!";
        }
        elseif(!preg_match("#[A-Z]+#",$password)) {
            $passwordError = "Your Password Must Contain At Least 1 Capital Letter!";
        }
        elseif(!preg_match("#[a-z]+#",$password)) {
            $passwordError = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }
    }
    elseif(!empty($_POST["password"])) {
        $cpasswordError = "Please Check You've Entered Or Confirmed Your Password!";
    } else {
         $passwordError = "Please enter password";
    }   

    if(empty($_POST["first_name"])){
        $first_nameError = "field is required";
    }else{
        $first_name = $_POST["first_name"];
    }
    
    if(empty($_POST["middle_name"])){
        $middle_nameError = "field is required";
    }else{
        $middle_name = $_POST["middle_name"];
    }
    
    if(empty($_POST["last_name"])){
        $last_nameError = "field is required";
    }else{
        $last_name = $_POST["last_name"];
    }    

    if(empty($_POST["gender"])){
        $genderError = "field is required";
    }else{
        $gender = $_POST["gender"];
    }    

    if($first_name && $middle_name && $last_name && $email && $password && $gender ){

        $check_first_name = strlen($first_name);
        if($check_first_name < 2){
            $first_nameError = "Your first name is too short";
        }else{
            $check_middle_name = strlen($middle_name);
            if($check_middle_name < 2){
                $middle_nameError = "Your middle name is too short";
            }else {
                $check_last_name = strlen($last_name);
                if($check_last_name < 2){
                    $middle_nameError = "Your last name is too short";
                }else{

                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $emailError = "You Entered An Invalid Email Format";
                    }else{

                         
                        $first_name=$_POST['first_name'];
                        $middle_name=$_POST['middle_name'];
                        $last_name=$_POST['last_name'];
                        $email=$_POST['email'];
                        $password=$_POST['password'];
                        $hash=password_hash($password, PASSWORD_DEFAULT);
                        $gender=$_POST['gender'];
                        $birthday=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
                        
                        $qry2 = ("SELECT * FROM user_registration WHERE email = '$email'");
                        $res = mysqli_query($conn, $qry2);

                        if (mysqli_num_rows($res) <= 0) {

                            $qry2 = ("INSERT INTO user_registration (firstname,middlename,lastname,password,email,gender,birthday) 
                            VALUES('$first_name','$middle_name','$last_name','$hash','$email','$gender','$birthday')") or die("query error");    



                            if ($conn->query($qry2) === TRUE) {

                                $last_id = mysqli_insert_id($conn);

                                $qry3 = mysqli_query($conn, "INSERT INTO user (user_registration_id,account_type,email,password) 
                                VALUES('$last_id','1','$email','$hash')") or die("query error");

                                echo"
                                <script>
                                window.alert('$first_name $middle_name $last_name details has been sent');
                                </script>"; 

                                echo"
                                <script>
                                window.location='User/index'
                                </script>"; 
                                
                              } else {
                                echo "Error: " . $qry2 . "<br>" . $conn->error;
                              }  
                            }else{
                                $emailError = "".$email." is already taken";
                            }
                    }

                }
            }

        }
    }

}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body> 
        <div class="container">
            <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sign Up</h3>                                                   
                        </div>
                        <div class="panel-body">
                            <form method="POST" role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" name="email" type="text" autofocus="" value="<?php echo $email; ?>">
                                        <span class="error"><?php echo $emailError; ?></span> 
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" id="myInput" value="">
                                        <span class="error"><?php echo $passwordError; ?></span> 
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Confirm Password" name="cpassword" type="password" id="myInput2" value="">
                                        <span class="error"><?php echo $cpasswordError; ?></span> 
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4"> 
                                                <input class="form-control" placeholder="First Name" name="first_name" type="text" value="<?php echo $first_name; ?>"> 
                                                <span class="error"><?php echo $first_nameError; ?></span>
                                            </div>

                                            <div class="col-md-4"> 
                                                <input class="form-control" placeholder="Middle Name" name="middle_name" type="text" value="<?php echo $middle_name; ?>">
                                                <span class="error"><?php echo $middle_nameError; ?></span> 
                                            </div>

                                            <div class="col-md-4"> 
                                                <input class="form-control" placeholder="Last Name" name="last_name" type="text" value="<?php echo $last_name; ?>">
                                                <span class="error"><?php echo $last_nameError; ?></span> 
                                            </div>    
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" id="optionsRadiosInline1" value="male" checked="">male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="gender" id="optionsRadiosInline2" value="female">female
                                            </label>
                                            <span class="error"><?php echo $genderError; ?></span>
                                    </div>                                       

                                    <div class="form-group">
                                        <div class="row">
                                            <?php
                                            //get the current year
                                            $Startyear=date('Y');
                                            $endYear=$Startyear-120;

                                            $yearArray = range($Startyear,$endYear);                                        
                                            ?>   
                                            <div class="col-md-4"> 
                                            <label>Year</label>
                                                <select class="form-control" name="year">
                                                <option value="">Select Year</option>
                                                    <?php
                                                    foreach ($yearArray as $year) {
                                                        $selected = ($year == $Startyear) ? 'selected' : '';
                                                        echo '<option '.$selected.' value="'.$year.'">'.$year.'</option>';
                                                    }
                                                    ?>
                                                </select>  
                                            </div>

                                            <div class="col-md-4"> 
                                            <label>Month</label>
                                                <select class="form-control" name="month">
                                                    <option>January</option>
                                                    <option>February</option>
                                                    <option>March</option>
                                                    <option>April</option>
                                                    <option>May</option>
                                                    <option>June</option>
                                                    <option>July</option>
                                                    <option>August</option>
                                                    <option>September</option>
                                                    <option>October</option>
                                                    <option>November</option>
                                                    <option>December</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">     
                                            <label>Day</label>
                                                <select class="form-control" name="day">
                                                    <?php  for( $i=1; $i<=31; $i++ ){ ?>
                                                    <option><?php echo $i; ?></option>
                                                    <?php } ?> 
                                                </select>   
                                            </div>
                                        </div>    
                                    </div>  
                                
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" onclick="myFunction()" value="">Show Password
                                        </label>
                                    </div>                                    
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" name="submit" class="btn btn-outline btn-primary btn-md btn-block">Register</button>
                                </fieldset>
                            </form>
                        </div>
                    <ol class="breadcrumb" style="background-color:#ffffff;">
                        <li><a href="login">Login</a></li>		  
                        <li class="active">Register</li>
                    </ol>                        
                    </div>
                </div>
            <div class="col-md-2">          
            </div>    
        </div>    
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  var y = document.getElementById("myInput2");
  if (x.type === "password" && y.type === "password") {
    x.type = "text";
    y.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
  }
}  
</script>

</body>
<?php include('footer.php'); ?>