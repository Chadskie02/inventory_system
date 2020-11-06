<?php
    sleep(3);
    session_start();
    include('../connection.php');
    $user_id = $_SESSION["id"];
    $user_md5 = md5($user_id);

    function rand_a( $length = 50 ){
        $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shuffled = substr( str_shuffle( $str), 0, $length);
        return $shuffled;
    }
    $shuffled_logout = rand_a(57);
    unset($_SESSION['id']);
    session_unset();
    session_destroy();  
    echo "<script>window.location.href='../login.php?logout=$shuffled_logout&v_1=$user_md5';</script>";
    exit();
?>        

