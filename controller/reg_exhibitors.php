<?php
    include "connections.php";
    // session_start();

    // $_SESSION['reg_success'] = "";

    // if(isset($_POST['register_exhibitor'])){
        $name = ucwords(htmlspecialchars(stripslashes($_POST['company_name'])));
        $address = ucwords(htmlspecialchars(stripslashes($_POST['company_address'])));
        $com_phone = ucwords(htmlspecialchars(stripslashes($_POST['company_phone'])));
        $designation = ucwords(htmlspecialchars(stripslashes($_POST['designation'])));
        $contact_person = ucwords(htmlspecialchars(stripslashes($_POST['contact_person'])));
        $contact_phone = ucwords(htmlspecialchars(stripslashes($_POST['contact_phone'])));
        $staff = htmlspecialchars(stripslashes($_POST['staff_number']));
        $email = ucwords(htmlspecialchars(stripslashes($_POST['company_email'])));
        $hall = htmlspecialchars(stripslashes($_POST['booth_halls']));
        $booth = htmlspecialchars(stripslashes($_POST['booth_id']));
        $cur_time = Date("Y");
        $reg_number = "EXH/".$cur_time ."/00";
        // if(strlen($password) < 5){
            // $_SESSION['error'] = "Password is too short!";
            // header("Location: ../views/company_registration.php");
        // }else{
            /* check if user already exists */
            $check_user = $connectdb->prepare("SELECT * FROM exhibitors WHERE company_email = :company_email OR company_phone = :company_phone");
            $check_user->bindvalue("company_email", $email);
            $check_user->bindvalue("company_phone", $com_phone);
            $check_user->execute();

            if($check_user->rowCount() > 0){
                echo "<div class='exist'><p style='color:red'>$name already exists!</p></div>";
                // header("Location: ../views/company_registration.php");
            }else{
                // if(move_uploaded_file($_FILES['company_logo']['tmp_name'], $logo_folder)){
                    $insert_user = $connectdb->prepare("INSERT INTO exhibitors (company_name, company_address, company_phone, contact_person, designation, contact_phone, company_email, staff_number, hall, booth, reg_number) VALUES (:company_name, :company_address, :company_phone, :contact_person, :designation, :contact_phone, :company_email, :staff_number, :hall, :booth, :reg_number)");
                    $insert_user->bindvalue("company_name", $name);
                    $insert_user->bindvalue("company_address", $address);
                    $insert_user->bindvalue("company_phone", $com_phone);
                    $insert_user->bindvalue("contact_person", $contact_person);
                    // $insert_user->bindvalue("company_password", $password);
                    $insert_user->bindvalue("company_email", $email);
                    $insert_user->bindvalue("staff_number", $staff);
                    $insert_user->bindvalue("contact_phone", $contact_phone);
                    $insert_user->bindvalue("designation", $designation);
                    $insert_user->bindvalue("hall", $hall);
                    $insert_user->bindvalue("booth", $booth);
                    // $insert_user->bindvalue("booth", $booth);
                    $insert_user->bindvalue("reg_number", $reg_number);
                    $insert_user->execute();
                    // echo $reg_number;
                    if($insert_user){
                        // $_SESSION['user'] = $email;
                        // $get_id = PDO::lastInsertId();
                        $mem_id = $connectdb->lastInsertId();
                        $new_reg = $reg_number.$mem_id;
                        /* update reg_num */
                        $update_reg = $connectdb->prepare("UPDATE exhibitors SET reg_number = :reg_number, payment_status = 2 WHERE company_email = :company_email");
                        $update_reg->bindvalue("reg_number", $new_reg);
                        $update_reg->bindvalue("company_email", $email);
                        $update_reg->execute();
                        /* update payment status */
                        
                        echo "<p>$name registered successfully!</p>";
                        
                    }else{
                        echo "<div class='exist'><p>Failed to register</p></div>";

                    }
    //             }else{
    //                 $_SESSION['failed'] = "logo upload failed";
    //                 header("Location: ../views/company_registration.php");

    //             }
    //         }    
        }
        
    // }
?>