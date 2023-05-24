<?php
    include "connections.php";
    session_start();

    $_SESSION['success'] = "";
    $_SESSION['error'] = "";
    if(isset($_POST['update'])){
        $company_name = ucwords(htmlspecialchars(stripslashes($_POST['company_name'])));
        $address = ucwords(htmlspecialchars(stripslashes($_POST['company_address'])));
        $company_phone = htmlspecialchars(stripslashes($_POST['company_phone']));
        $company_email = htmlspecialchars(stripslashes($_POST['company_email']));
        $contact_person = ucwords(htmlspecialchars(stripslashes($_POST['contact_person'])));
        $contact_phone = ucwords(htmlspecialchars(stripslashes($_POST['contact_phone'])));
        $portal_manager = ucwords(htmlspecialchars(stripslashes($_POST['portal_manager'])));
        $designation = htmlspecialchars(stripslashes($_POST['designation']));
        $manager_contact = htmlspecialchars(stripslashes($_POST['manager_contact']));
        // $logo = $_FILES['company_logo']['name'];
        // $logo_folder = "../logos/".$logo;
        $id = $_POST['user_id'];
        /* update profile */
        // if(move_uploaded_file($_FILES['company_logo']['tmp_name'], $logo_folder)){

            $update_profile = $connectdb->prepare("UPDATE exhibitors SET company_name = :company_name, company_address = :company_address, company_phone = :company_phone, company_email = :company_email, contact_person = :contact_person, contact_phone = :contact_phone, designation = :designation, portal_manager =:portal_manager, manager_contact =:manager_contact WHERE exhibitor_id = :exhibitor_id");
            $update_profile->bindvalue("company_name", $company_name);
            $update_profile->bindvalue("company_address", $address);
            $update_profile->bindvalue("company_phone", $company_phone);
            $update_profile->bindvalue("company_email", $company_email);
            $update_profile->bindvalue("contact_person", $contact_person);
            $update_profile->bindvalue("contact_phone", $contact_phone);
            $update_profile->bindvalue("designation", $designation);
            $update_profile->bindvalue("manager_contact", $manager_contact);
            $update_profile->bindvalue("portal_manager", $portal_manager);
            // $update_profile->bindvalue("company_logo", $company_logo);
            $update_profile->bindvalue("exhibitor_id", $id);
            $update_profile->execute();

            if($update_profile){
                $_SESSION['success'] = "Profile updated successfully!";
                header("Location: ../views/exhibitors.php");
            }else{
                $_SESSION['error'] = "Update failed";
                header("Location: ../views/exhibitors.php");
            }
        // }else{
        //     $_SESSION['error'] = "image upload failed";
        //     header("Location: ../views/exhibitors.php");
        // }
    }else{
        $_SESSION['error'] = "update failed!";
        header("Location: ../views/exhibitors.php");

    }
        

    

?>