<?php
    include "connections.php";
    session_start();

    if(isset($_POST['add_payment'])){
        $user_id = htmlspecialchars(stripslashes($_POST['user_id']));
        // $hotel = htmlspecialchars(stripslashes($_POST['hotel']));
        $receipt = $_FILES['payment']['name'];
        $receipt_folder = "../receipts/".$receipt;

        $check_status = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id AND payment_status = 1");
        $check_status->bindvalue("user_id", $user_id);
        $check_status->execute();

        if($check_status->rowCount() > 0){
            $_SESSION['error'] = "You have already submitted payment. Kindly Await approval!";
            header("Location: ../views/user.php");
        }else{
            $check_status = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id AND payment_status = 2");
            $check_status->bindvalue("user_id", $user_id);
            $check_status->execute();
            if($check_status->rowCount() > 0){
                $_SESSION['error'] = "You have been Approved already! Kindly print your slip";
                header("Location: ../views/user.php");
            }else{
                if(move_uploaded_file($_FILES['payment']['tmp_name'], $receipt_folder)){
                    $update_status = $connectdb->prepare("UPDATE users set payment_status = 1, payment_receipt = :payment_receipt WHERE user_id = :user_id");
                    $update_status->bindvalue("payment_receipt", $receipt);
                    // $update_status->bindvalue("hotel", $hotel);
                    $update_status->bindvalue("user_id", $user_id);
                    $update_status->execute();
                    if($update_status){
                        $_SESSION['success'] = "Payment uploaded successfully";
                        header("Location: ../views/user.php");
                    }else{
                        $_SESSION['error'] = "failed to upload receipt";
                    }
                }else{
                    $_SESSION['error'] = "failed to upload receipt";
                    header("Location: ../views/user.php");
                }
            }
            
        }

    }

?>