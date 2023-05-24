<?php
    include "connections.php";
    session_start();

    if(isset($_GET['request'])){

        $user_id = $_GET['request'];
        $update_payment = $connectdb->prepare("DELETE FROM request_hotel WHERE request_id = :request_id");

        $update_payment->bindvalue("request_id", $user_id);
        $update_payment->execute();

        if($update_payment){
            echo "<div class='success'><p>Accomodation request Declined!</p></div>";
            // header("Location: ../views/admin.php");
        }else{
            echo "<div class='error_message'><p>Failed to confirm payment!</p></div>";
            // header("Location: ../views/admin.php");
        }
        
        
    }
?>