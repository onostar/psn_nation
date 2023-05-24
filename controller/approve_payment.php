<?php
    include "connections.php";
    session_start();

    if(isset($_GET['user'])){

        $user_id = $_GET['user'];
        $get_state = $connectdb->prepare('SELECT res_state FROM users WHERE user_id = :user_id');

        $get_state->bindvalue("user_id", $user_id);
        $get_state->execute();
        $states = $get_state->fetch();
        $state = $states->res_state;

        
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
                /* get state_id */
                $get_state_num = $connectdb->prepare('SELECT * FROM users WHERE res_state = :res_state');
                $get_state_num->bindvalue("res_state", $state);
                $get_state_num->execute();
                $state_id = $get_state_num->rowCount();
                $code = strtoupper(substr($state, 0, 3));
                $cur_time = Date("Y");
                $reg_number = $code."/".$cur_time ."/00".$state_id."/00".$user_id;
                /* update reg number */
                $update_reg = $connectdb->prepare("UPDATE users SET reg_number = :reg_number WHERE user_id = :user_id");
                $update_reg->bindvalue("reg_number", $reg_number);
                $update_reg->bindvalue("user_id", $user_id);
                $update_reg->execute();
                echo "<div class='success'><p>User payment confirmed!</p></div>";
                // header("Location: ../views/admin.php");
            }else{
                echo "<div class='error_message'><p>Failed to confirm payment!</p></div>";
                // header("Location: ../views/admin.php");
            }
        }
        
    }
?>