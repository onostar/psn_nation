<?php
    include "connections.php";
    session_start();

    if(isset($_POST['register_guest'])){
        $guest_type = htmlspecialchars(stripslashes($_POST['guest_type']));
        $fee = ucwords(htmlspecialchars(stripslashes($_POST['guest_fee'])));
        $last_name = ucwords(htmlspecialchars(stripslashes($_POST['last_name'])));
        $other_name = ucwords(htmlspecialchars(stripslashes($_POST['first_name'])));
        $username = htmlspecialchars(stripslashes($_POST['username']));
        $dob = ucwords(htmlspecialchars(stripslashes($_POST['dob'])));
        $country = ucwords(htmlspecialchars(stripslashes($_POST['country'])));
        $gender = ucwords(htmlspecialchars(stripslashes($_POST['gender'])));
        $user_type = "Guest";
        $barcode_num = random_int(100000000, 200000000);
        $phone = htmlspecialchars(stripslashes($_POST['phone_number']));
        $password = htmlspecialchars(stripslashes($_POST['user_password']));
        $passport = $_FILES['passport']['name'];
        $passport_folder = "../passports/".$passport;
        $passport_size = $_FILES['passport']['size'];
        $allowed_ext = array('png', 'jpg', 'jpeg', 'webp');
        /* get current file extention */
        $file_ext = explode('.', $passport);
        $file_ext = strtolower(end($file_ext));
        $cur_time = Date("Y");
        $reg_number = "GUEST/".$cur_time ."/00";
        if(strlen($password) < 5){
            $_SESSION['error'] = "Password is too short!";
            header("Location: ../views/guest_registration.php");
        }else{
            /* check if user already exists */
            $check_user = $connectdb->prepare("SELECT * FROM users WHERE user_email = :user_email");
            $check_user->bindvalue("user_email", $username);
            $check_user->execute();

            if($check_user->rowCount() > 0){
                $_SESSION['error'] = "User already exists!";
                header("Location: ../guests/guest_registration.php");
            }else{
                if(in_array($file_ext, $allowed_ext)){
                    if($passport_size <= 300000){
                        if(move_uploaded_file($_FILES['passport']['tmp_name'], $passport_folder)){
                            $insert_user = $connectdb->prepare("INSERT INTO users (guest_type, gender, last_name, first_name, user_email, whatsapp, dob, country, fee, guest_password, passport, reg_number, user_type, barcode) VALUES (:guest_type, :gender, :last_name, :first_name, :user_email, :whatsapp, :dob, :country, :fee, :guest_password, :passport, :reg_number, :user_type, :barcode)");
                            $insert_user->bindvalue("guest_type", $guest_type);
                            $insert_user->bindvalue("last_name", $last_name);
                            $insert_user->bindvalue("first_name", $other_name);
                            $insert_user->bindvalue("user_email", $username);
                            $insert_user->bindvalue("whatsapp", $phone);
                            $insert_user->bindvalue("gender", $gender);
                            $insert_user->bindvalue("dob", $dob);
                            $insert_user->bindvalue("country", $country);
                            $insert_user->bindvalue("fee", $fee);
                            $insert_user->bindvalue("reg_number", $reg_number);
                            $insert_user->bindvalue("guest_password", $password);
                            $insert_user->bindvalue("user_type", $user_type);
                            $insert_user->bindvalue("barcode", $barcode_num);
                            $insert_user->bindvalue("passport", $passport);
                            $insert_user->execute();
                            // echo $reg_number;
                            if($insert_user){
                                $_SESSION['user'] = $username;
                                // $get_id = PDO::lastInsertId();
                                $mem_id = $connectdb->lastInsertId();
                                $new_reg = $reg_number.$mem_id;
                                $barcode = $barcode_num.$mem_id;
                                /* update reg_num and barcode */
                                $update_reg = $connectdb->prepare("UPDATE users SET reg_number = :reg_number, barcode = :barcode WHERE user_email = :user_email");
                                $update_reg->bindvalue("reg_number", $new_reg);
                                $update_reg->bindvalue("barcode", $barcode);
                                $update_reg->bindvalue("user_email", $username);
                                $update_reg->execute();
                                /* update payment status */
                                
                                $_SESSION['reg_success'] = "Your registration was successful. Proceed to make payment for registration approval!";
                                header("Location: ../guests/guests.php");
                                
                            }else{
                                $_SESSION['error'] = "failed to register";
                                header("Location: ../guests/guest_registration.php");

                            }
                        }else{
                            $_SESSION['failed'] = "logo upload failed";
                        header("Location: ../guests/guest_registration.php");
                        }
                    }else{
                        $_SESSION['error'] = "Error! Image size too large! Image should not be larger than 300kb";
                        header("Location: ../guests/guest_registration.php");
                    }
                }else{
                    $_SESSION['error'] = "Error! Image format not supported";
                    header("Location: ../guests/guest_registration.php");
                }
            }    
        }
        
    }
?>