<?php
    include "connections.php";
    session_start();

    if(isset($_GET['exhibitor'])){

        $user_id = $_GET['exhibitor'];
        /* check if approved */
        $check_user = $connectdb->prepare("SELECT * FROM exhibitors WHERE exhibitor_id = :exhibitor_id AND payment_status = 2");
        $check_user->bindvalue("exhibitor_id", $user_id);
        $check_user->execute();
        
        if($check_user->rowCount() > 0){
            echo "<div class='error_message'><p>User already approved!</p></div>";
            // header("Location: ../views/admin.php");

        }else{
            $update_payment = $connectdb->prepare("UPDATE exhibitors SET payment_status = 2 WHERE exhibitor_id = :exhibitor_id");

            $update_payment->bindvalue("exhibitor_id", $user_id);
            $update_payment->execute();

            if($update_payment){
                /* updat booth status */
                /* get booth first */
                $get_booth = $connectdb->prepare("SELECT booth FROM exhibitorS WHERE exhibitor_id = :exhibitor_id");
                $get_booth->bindvalue("exhibitor_id", $user_id);
                $get_booth->execute();
                $booth = $get_booth->fetch();
                /* now update booth status in booth table */
                $update_booth = $connectdb->prepare("UPDATE booths SET booth_status = 1 WHERE booth_id = :booth_id");
                $update_booth->bindvalue("booth_id", $booth->booth);
                $update_booth->execute();
                echo "<div class='success'><p>Exhibitor payment confirmed!</p></div>";
                // header("Location: ../views/admin.php");
            }else{
                echo "<div class='error_message'><p>Failed to confirm payment!</p></div>";
                // header("Location: ../views/admin.php");
            }
        }
        
    }
?>