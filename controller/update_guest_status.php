<?php
    include "connections.php";

    // if(isset($_GET['user'])){

        $guest = $_GET['user'];
        $trans_ref = $_GET['transref'];

        //update status
        $update = $connectdb->prepare("UPDATE users SET payment_status = 2, transaction_num = :transaction_num WHERE user_id = :user_id");
        $update->bindValue("user_id", $guest);
        $update->bindValue("transaction_num", $trans_ref);
        $update->execute();
        if($update){
            header("Location: ../guests/guests.php");
        }
    // }
?>