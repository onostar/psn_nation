<?php
    include "connections.php";
    session_start();
    $_SESSION['success'] = "";
    $_SESSION['failed'] = "";

    if(isset($_POST['recover_password'])){
        $email = htmlspecialchars(stripslashes($_POST['user_email']));

        /* check if email exists */
        $check_mail = $connectdb->prepare("SELECT * FROM employers WHERE email_address = :email_address");
        $check_mail->bindvalue("email_address", $email);
        $check_mail->execute();

        if($check_mail->rowCount() > 0){
            /* fetch user password */
            $rows = $check_mail->fetchAll();
            foreach ($rows as $row ) {
                $password = $row->user_password;
            }
            /* send password to mail */
            $subject = "Macro Jobs Password recovery";
            $message = "Your macro Jobs password is \n $password";
            $header = "FROM: admin@macrojobs.com";
            mail($email, $subject, $message, $header) or die("!Error");
            $_SESSION['success'] = "Your password has been sent to your mail box";
            header("Location: ../views/employers_login.php");
        }else{
            $_SESSION['failed'] = "The provided email is invalid";
            header("Location: ../views/employers_login.php");
        }
    }
?>