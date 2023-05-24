<?php
    include "connections.php";
    session_start();

    $_SESSION['success'] = "";
    $_SESSION['error'] = "";
    $_SESSION['reg_success'] = "";


    if(isset($_POST['exh_login'])){
        $username = ucwords(htmlspecialchars(stripslashes($_POST['exh_username'])));
        $password = htmlspecialchars(stripslashes($_POST['password']));

        $get_user = $connectdb->prepare("SELECT * FROM exhibitors WHERE company_email = :company_email AND company_password = :company_password");
        $get_user->bindvalue("company_email", $username);
        $get_user->bindvalue("company_password", $password);
        $get_user->execute();

        if($get_user->rowCount() > 0){
            $_SESSION['user'] = $username;
            
            header("Location: ../views/exhibitors.php");
            $_SESSION['reg_success'] = "Welcome Exhibitor!";
            
        }else{
            $_SESSION['error'] = "Invalid Username or password";
            header("Location: ../views/exhibitor_login.php");
        }
         
    }




?>