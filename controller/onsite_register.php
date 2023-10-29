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
        $pcn = htmlspecialchars(stripslashes($_POST['pcn_number']));
        $state = ucwords(htmlspecialchars(stripslashes($_POST['res_state'])));
        $tech_group = ucwords(htmlspecialchars(stripslashes($_POST['tech_group'])));
        $onsite_del = 1;
        $cur_time = Date("Y");
        if($guest_type == 6){
            $user_type = "Delegate";
            $reg_number = "/.$cur_time" ."/00";
        }else{
            $user_type = "Guest";
            $reg_number = "GUEST/".$cur_time ."/00";
        }
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
        // $reg_number = "GUEST/".$cur_time ."/00";
/*         if(strlen($password) < 5){
            $_SESSION['error'] = "Password is too short!";
            header("Location: ../guests/guest_registration.php");
        }else{ */
            /* check if user already exists */
            if($guest_type == 6){
                $check_user = $connectdb->prepare("SELECT * FROM users WHERE pcn_number = :pcn_number");
                $check_user->bindvalue("pcn_number", $pcn);
                $check_user->execute();
            }else{
                $check_user = $connectdb->prepare("SELECT * FROM users WHERE user_email = :user_email");
                $check_user->bindvalue("user_email", $username);
                $check_user->execute();
            }
            

            if($check_user->rowCount() > 0){
                $_SESSION['error'] = "User already exists!";
                header("Location: ../views/onsite_registration.php");
            }else{
                if(in_array($file_ext, $allowed_ext)){
                    // if($passport_size <= 1000000){
                        //compress image
                        function compressImage($source, $destination, $quality){
                            //get image info
                            $imgInfo = getimagesize($source);
                            $mime = $imgInfo['mime'];
                            //create new image from file
                            switch($mime){
                                case 'image/png':
                                    $image = imagecreatefrompng($source);
                                    imagejpeg($image, $destination, $quality);
                                    break;
                                case 'image/jpeg':
                                    $image = imagecreatefromjpeg($source);
                                    imagejpeg($image, $destination, $quality);
                                    break;
                                
                                case 'image/webp':
                                    $image = imagecreatefromwebp($source);
                                    imagejpeg($image, $destination, $quality);
                                    break;
                                default:
                                    $image = imagecreatefromjpeg($source);
                                    imagejpeg($image, $destination, $quality);
                            }
                            //return compressed image
                            return $destination;
                        }
                        $compress = compressImage($_FILES['passport']['tmp_name'], $passport_folder, 80);
                        /* update profile */
                        if($compress){
                        // if(move_uploaded_file($_FILES['passport']['tmp_name'], $passport_folder)){
                            $insert_user = $connectdb->prepare("INSERT INTO users (guest_type, gender, pcn_number, res_state, tech_group, last_name, first_name, user_email, whatsapp, dob, country, fee, guest_password, passport, reg_number, user_type, barcode, onsite_delegate) VALUES (:guest_type, :gender, :pcn_number, :res_state, :tech_group, :last_name, :first_name, :user_email, :whatsapp, :dob, :country, :fee, :guest_password, :passport, :reg_number, :user_type, :barcode, :onsite_delegate)");
                            $insert_user->bindvalue("guest_type", $guest_type);
                            $insert_user->bindvalue("last_name", $last_name);
                            $insert_user->bindvalue("first_name", $other_name);
                            $insert_user->bindvalue("user_email", $username);
                            $insert_user->bindvalue("whatsapp", $phone);
                            $insert_user->bindvalue("gender", $gender);
                            $insert_user->bindvalue("pcn_number", $pcn);
                            $insert_user->bindvalue("res_state", $state);
                            $insert_user->bindvalue("tech_group", $tech_group);
                            $insert_user->bindvalue("dob", $dob);
                            $insert_user->bindvalue("country", $country);
                            $insert_user->bindvalue("fee", $fee);
                            $insert_user->bindvalue("reg_number", $reg_number);
                            $insert_user->bindvalue("guest_password", $password);
                            $insert_user->bindvalue("user_type", $user_type);
                            $insert_user->bindvalue("barcode", $barcode_num);
                            $insert_user->bindvalue("passport", $passport);
                            $insert_user->bindvalue("onsite_delegate", $onsite_del);
                            $insert_user->execute();
                            // echo $reg_number;
                            if($insert_user){
                                if($guest_type == 6){
                                    $_SESSION['user'] = $pcn;
                                }else{
                                    $_SESSION['user'] = $username;
                                }
                                // // $get_id = PDO::lastInsertId();
                                // $mem_id = $connectdb->lastInsertId();
                                // $new_reg = $reg_number.$mem_id;
                                // $barcode = $barcode_num.$mem_id;
                                // /* update reg_num and barcode */
                                // $update_reg = $connectdb->prepare("UPDATE users SET reg_number = :reg_number, barcode = :barcode WHERE user_email = :user_email");
                                // $update_reg->bindvalue("reg_number", $new_reg);
                                // $update_reg->bindvalue("barcode", $barcode);
                                // $update_reg->bindvalue("user_email", $username);
                                // $update_reg->execute();
                                /* update payment status */
                                
                                $_SESSION['reg_success'] = "Your registration was successful. Proceed to make payment for registration approval!";
                                if($guest_type == 6){
                                    header("Location: ../views/user.php");
                                }else{
                                    header("Location: ../guests/guests.php");
                                }
                                
                                
                            }else{
                                $_SESSION['error'] = "failed to register";
                                header("Location: ../views/onsite_registration.php");

                            }
                        }else{
                            $_SESSION['failed'] = "logo upload failed";
                        header("Location: ../views/onsite_registration.php");
                        }
                    /* }else{
                        $_SESSION['error'] = "Error! Image size too large! Image should not be larger than 300kb";
                        header("Location: ../guests/guest_registration.php");
                    } */
                }else{
                    $_SESSION['error'] = "Error! Image format not supported";
                    header("Location: ../views/onsite_registration.php");
                }
            }    
        // }
        
    }
?>