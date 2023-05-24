<?php
    include "connections.php";
    session_start();

    $_SESSION['success'] = "";
    $_SESSION['error'] = "";

    if(isset($_POST['upload_passport'])){
        $user_id = htmlspecialchars(stripslashes($_POST['user_id']));
        // $hotel = htmlspecialchars(stripslashes($_POST['hotel']));
        $passport = $_FILES['passport']['name'];
        $passport_folder = "../passports/".$passport;

        if(move_uploaded_file($_FILES['passport']['tmp_name'], $passport_folder)){
            $update_status = $connectdb->prepare("UPDATE users set passport = :passport WHERE user_id = :user_id");
            $update_status->bindvalue("passport", $passport);
            $update_status->bindvalue("passport", $passport);
            $update_status->bindvalue("user_id", $user_id);
            $update_status->execute();
            if($update_status){
                $_SESSION['success'] = "Passport uploaded successfully";
                header("Location: ../views/user.php");
            }else{
                $_SESSION['error'] = "failed to upload receipt";
            }
        }else{
            $_SESSION['error'] = "failed to upload passport";
            header("Location: ../views/user.php");
        }
            

    }

?>