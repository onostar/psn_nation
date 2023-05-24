<?php
    include "connections.php";
    session_start();

    $_SESSION['success'] = "";
    $_SESSION['error'] = "";
    $_SESSION['reg_success'] = "";

    if(isset($_POST['register_user'])){
        $name = ucwords(htmlspecialchars(stripslashes($_POST['first_name'])));
        $last_name = ucwords(htmlspecialchars(stripslashes($_POST['last_name'])));
        $state = ucwords(htmlspecialchars(stripslashes($_POST['res_state'])));
        $whatsapp = ucwords(htmlspecialchars(stripslashes($_POST['whatsapp'])));
        $other_number = ucwords(htmlspecialchars(stripslashes($_POST['other_number'])));
        $email = ucwords(htmlspecialchars(stripslashes($_POST['user_email'])));
        $pcn = ucwords(htmlspecialchars(stripslashes($_POST['pcn_number'])));
        // $password = 123;
        $passport = $_FILES['passport']['name'];
        $passport_folder = "../passports/".$passport;
        $code = strtoupper(substr($state, 0, 3));
        $cur_time = Date("Y");
        $reg_number = $code."/".$cur_time ."/00";
        if(strlen($whatsapp) != 11){
            $_SESSION['error'] = "Phone Number is too short!";
            header("Location: ../views/regist.php");
        }else{
            /* check if user already exists */
            $check_user = $connectdb->prepare("SELECT * FROM users WHERE whatsapp = :whatsapp OR user_email = :user_email OR pcn_number = :pcn_number OR other_number = :other_number OR reg_number = :reg_number ");
            $check_user->bindvalue("whatsapp", $whatsapp);
            $check_user->bindvalue("user_email", $email);
            $check_user->bindvalue("pcn_number", $pcn);
            $check_user->bindvalue("other_number", $other_number);
            $check_user->bindvalue("reg_number", $reg_number);
            $check_user->execute();

            if($check_user->rowCount() > 0){
                $_SESSION['error'] = "User already exists!";
                header("Location: ../views/regist.php");
            }else{
                if(move_uploaded_file($_FILES['passport']['tmp_name'], $passport_folder)){
                    $insert_user = $connectdb->prepare("INSERT INTO users (first_name, last_name, res_state, whatsapp, other_number, user_email, passport, pcn_number, reg_number) VALUES (:first_name, :last_name, :res_state, :whatsapp, :other_number, :user_email, :passport, :pcn_number, :reg_number)");
                    $insert_user->bindvalue("first_name", $name);
                    $insert_user->bindvalue("last_name", $last_name);
                    $insert_user->bindvalue("whatsapp", $whatsapp);
                    $insert_user->bindvalue("res_state", $state);
                    // $insert_user->bindvalue("user_password", $password);
                    $insert_user->bindvalue("user_email", $email);
                    $insert_user->bindvalue("other_number", $other_number);
                    $insert_user->bindvalue("passport", $passport);
                    $insert_user->bindvalue("pcn_number", $pcn);
                    $insert_user->bindvalue("reg_number", $reg_number);
                    // $insert_user->bindvalue("reg_number", $reg_number);
                    $insert_user->execute();
                    // echo $reg_number;
                    if($insert_user){
                        $_SESSION['user'] = $pcn;
                        // $get_id = PDO::lastInsertId();
                        $mem_id = $connectdb->lastInsertId();
                        $new_reg = $reg_number.$mem_id;
                        /* update reg_num */
                        $update_reg = $connectdb->prepare("UPDATE users SET reg_number = :reg_number WHERE pcn_number = :pcn_number");
                        $update_reg->bindvalue("reg_number", $new_reg);
                        $update_reg->bindvalue("pcn_number", $pcn);
                        $update_reg->execute();
                        /* update payment status */
                        $get_payment = $connectdb->prepare("SELECT * FROM paid_members WHERE pcn_number = :pcn_number");
                        $get_payment->bindvalue("pcn_number", $pcn);
                        $get_payment->execute();
                        if($get_payment->rowCount() > 0){
                            $update_payment = $connectdb->prepare("UPDATE users SET payment_status = 2 WHERE pcn_number = :pcn_number");
                            $update_payment->bindvalue("pcn_number", $pcn);
                            $update_payment->execute();
                            if($update_payment){
                                $_SESSION['reg_success'] = "Your registration was successful, Your username is your phone number! \r\n While Your password is your PCN number";
                                header("Location: ../views/user.php");
                            }else{
                                
                                $_SESSION['error'] = "Failed to update";
                                header("Location: ../views/user.php");
                            }

                        }else{
                            $_SESSION['reg_success'] = "Your registration was successful, Your username is your phone number! \r\n While Your password is your PCN number";
                                $_SESSION['error'] = "You have not made payment this year";
                                header("Location: ../views/user.php");
                        }
                    }else{
                        $_SESSION['error'] = "failed to register";
                        header("Location: ../views/regist.php");

                    }
                }else{
                    $_SESSION['failed'] = "passport upload failed";
                    header("Location: ../view/regist.php");

                }
            }    
        }
        
    }
?>