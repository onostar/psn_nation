<?php
    include "connections.php";
    session_start();

    if(isset($_POST['guest_login'])){
        $username = htmlspecialchars(stripslashes($_POST['username']));
        $password = htmlspecialchars(stripslashes($_POST['password']));
        $get_user = $connectdb->prepare("SELECT * FROM users WHERE user_email = :user_email AND guest_password = :guest_password");
        $get_user->bindvalue("user_email", $username);
        $get_user->bindvalue("guest_password", $password);
        $get_user->execute();
        if($get_user->rowCount() > 0){
            $_SESSION['user'] = $username;
            
            header("Location: ../guests/guests.php");
            $_SESSION['reg_success'] = "Welcome Guest!";
            
        }else{
            $_SESSION['error'] = "Invalid Username or password";
            header("Location: ../guests/guest_login.php");
        }
         
    }

?>