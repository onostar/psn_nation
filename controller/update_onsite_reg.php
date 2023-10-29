<?php
    include "connections.php";

    // if(isset($_GET['user'])){

        $guest = $_GET['user'];
        $trans_ref = $_GET['transref'];
        //get user details
        $get_details = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $get_details->bindValue("user_id", $guest);
        $get_details->execute();
        $rows = $get_details->fetchAll();
        foreach($rows as $row){
            $old_barcode = $row->barcode;
            $old_reg_num = $row->reg_number;
            $guest_type = $row->guest_type;
            $state = $row->res_state;
        }
        $cur_time = date("Y");
        $barcode = $old_barcode.$guest;
        if($guest_type == 6){
            /* get state_id */
            $get_state_num = $connectdb->prepare('SELECT * FROM users WHERE res_state = :res_state');
            $get_state_num->bindvalue("res_state", $state);
            $get_state_num->execute();
            if($get_state_num->rowCount() > 0){
                $state_id = $get_state_num->rowCount();
            }else{
                $state_id = 1;
            }
            $code = strtoupper(substr($state, 0, 3));
            $cur_time = Date("Y");
            $reg_number = $code."/".$cur_time ."/0".$state_id."/0".$guest;
        }else{
            $reg_number = "GUEST/.$cur_time" ."/00".$guest;
        }
        //update status
        $update = $connectdb->prepare("UPDATE users SET payment_status = 2, transaction_num = :transaction_num, barcode =:barcode, reg_number = :reg_number WHERE user_id = :user_id");
        $update->bindValue("user_id", $guest);
        $update->bindValue("transaction_num", $trans_ref);
        $update->bindValue("barcode", $barcode);
        $update->bindValue("reg_number", $reg_number);
        $update->execute();
        if($update){
            if($guest_type == 6){
                header("Location: ../views/user.php");
            }else{
                header("Location: ../guests/guests.php");

            }
        }
    // }
?>