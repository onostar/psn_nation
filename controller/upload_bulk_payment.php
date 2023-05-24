<?php
    include "connections.php";
    session_start();

    $_SESSION['success'] = "";
    $_SESSION['error'] = "";

    if(isset($_POST['add_bulk_payment'])){
        $user_id = htmlspecialchars(stripslashes($_POST['user_id']));
        // $hotel = htmlspecialchars(stripslashes($_POST['hotel']));
        $receipt = $_FILES['payment']['name'];
        $receipt_folder = "../receipts/".$receipt;

        
                if(move_uploaded_file($_FILES['payment']['tmp_name'], $receipt_folder)){
                    $update_status = $connectdb->prepare("UPDATE request_hotel set bulk = 1, bulk_evidence = :bulk_evidence WHERE pcn_number = :pcn_number");
                    $update_status->bindvalue("bulk_evidence", $receipt);
                    // $update_status->bindvalue("hotel", $hotel);
                    $update_status->bindvalue("pcn_number", $user_id);
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

?>