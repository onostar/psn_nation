<?php
    include "connections.php";
    session_start();

    if(isset($_GET['guest'])){

        $user_id = $_GET['guest'];
        /* check if approved */
        
        $delete_payment = $connectdb->prepare("UPDATE guests SET payment_status = -1 WHERE guest_id = :guest_id");

        $delete_payment->bindvalue("guest_id", $user_id);
        $delete_payment->execute();

        if($delete_payment){
            echo "<div class='error_message'><p>Guest payment declined!";
            // header("Location: ../views/admin.php");
        }else{
            echo "<div class='error_message'><p>Failed to confirm payment!";
            // header("Location: ../views/admin.php");
        }
        
        
    }
?>