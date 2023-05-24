<?php
    include "connections.php";
    session_start();

    if(isset($_GET['guest'])){

        $user_id = $_GET['guest'];
        /* check if approved */
        $check_user = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id AND payment_status = 2");
        $check_user->bindvalue("user_id", $user_id);
        $check_user->execute();
        
        if($check_user->rowCount() > 0){
            echo "<div class='error_message'><p>User already approved!</p></div>";
            // header("Location: ../views/admin.php");

        }else{
            $update_payment = $connectdb->prepare("UPDATE users SET payment_status = 2 WHERE user_id = :user_id");

            $update_payment->bindvalue("user_id", $user_id);
            $update_payment->execute();

            if($update_payment){
                
                echo "<div class='success'><p>Guest payment confirmed!</p></div>";
                // header("Location: ../views/admin.php");
            }else{
                echo "<div class='error_message'><p>Failed to confirm payment!</p></div>";
                // header("Location: ../views/admin.php");
            }
        }
        
    }
?>