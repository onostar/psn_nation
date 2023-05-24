<?php
    include "connections.php";
    session_start();

    $_SESSION['success'] = "";
    $_SESSION['error'] = "";

    if(isset($_POST['add_booth_pay'])){
        $user_id = htmlspecialchars(stripslashes($_POST['exhibitor_id']));
        $booth = htmlspecialchars(stripslashes($_POST['booth_id']));
        $receipt = $_FILES['payment']['name'];
        $receipt_folder = "../exh_receipts/".$receipt;

                 if(move_uploaded_file($_FILES['payment']['tmp_name'], $receipt_folder)){
                    $update_status = $connectdb->prepare("UPDATE exhibitors set payment_status = 1, booth = :booth, payment_slip = :payment_slip WHERE exhibitor_id = :exhibitor_id");
                    $update_status->bindvalue("payment_slip", $receipt);
                    $update_status->bindvalue("booth", $booth);
                    $update_status->bindvalue("exhibitor_id", $user_id);
                    $update_status->execute();
                    if($update_status){
                        $_SESSION['success'] = "Payment uploaded successfully";
                        header("Location: ../views/exhibitors.php");
                    }else{
                        $_SESSION['error'] = "failed to upload receipt";
                        header("Location: ../views/exhibitors.php");

                    }
                }else{
                    $_SESSION['error'] = "failed to upload receipt";
                    header("Location: ../views/exhibitors.php");
                }
            
            
        

    }

?>