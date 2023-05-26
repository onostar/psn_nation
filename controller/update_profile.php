<?php
    session_start();
    include "connections.php";
    // require "../barcodes/vendor/autoload.php";
    //barcode generator

    

    $_SESSION['success'] = "";
    $_SESSION['error'] = "";
    if(isset($_POST['update'])){
        
        $first_name = strtolower(htmlspecialchars(stripslashes($_POST['first_name'])));
        $last_name = strtolower(htmlspecialchars(stripslashes($_POST['last_name'])));
        $whatsapp = htmlspecialchars(stripslashes($_POST['whatsapp']));
        $other_number = htmlspecialchars(stripslashes($_POST['other_number']));
        $state = ucwords(htmlspecialchars(stripslashes($_POST['res_state'])));
        $email = htmlspecialchars(stripslashes($_POST['user_email']));
        $gender = htmlspecialchars(stripslashes($_POST['gender']));
        $user_type  = "Delegate";
        $country  = "Nigeria";
        $group = htmlspecialchars(stripslashes($_POST['tech_group']));
        // $int_group = htmlspecialchars(stripslashes($_POST['interest_group']));
        $passport = $_FILES['passport']['name'];
        $passport_folder = "../passports/".$passport;
        $id = $_POST['user_id'];
        $passport_size = $_FILES['passport']['size'];
        $allowed_ext = array('png', 'jpg', 'jpeg', 'webp');
        /* get current file extention */
        $file_ext = explode('.', $passport);
        $file_ext = strtolower(end($file_ext));

        
        /* get barcode details and create */
        $barcode_num = random_int(100000000, 200000000).$id;
        
        
        // $barcode_type = 'code128';
        // $barcode_display = 'horizontal';
        // $barcode_size = '20';
        // $printText = true;
        // $barcode_type = 'code39';
        // $barcode_type = 'codebar';

        // check image type and size before updating profile
        if(in_array($file_ext, $allowed_ext)){
            if($passport_size <= 300000){
                /* update profile */
                if(move_uploaded_file($_FILES['passport']['tmp_name'], $passport_folder)){
                    
                    // update values
                    $update_profile = $connectdb->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, whatsapp = :whatsapp, other_number = :other_number, res_state = :res_state, user_email = :user_email, passport = :passport, gender = :gender, tech_group = :tech_group, user_type = :user_type, country = :country, barcode = :barcode WHERE user_id = :user_id");
                    $update_profile->bindvalue("first_name", $first_name);
                    $update_profile->bindvalue("last_name", $last_name);
                    $update_profile->bindvalue("whatsapp", $whatsapp);
                    $update_profile->bindvalue("other_number", $other_number);
                    $update_profile->bindvalue("res_state", $state);
                    $update_profile->bindvalue("user_email", $email);
                    $update_profile->bindvalue("passport", $passport);
                    // $update_profile->bindvalue("reg_number", $reg_number);
                    $update_profile->bindvalue("gender", $gender);
                    $update_profile->bindvalue("tech_group", $group);
                    // $update_profile->bindvalue("interest_group", $int_group);
                    $update_profile->bindvalue("user_type", $user_type);
                    $update_profile->bindvalue("country", $country);
                    $update_profile->bindvalue("barcode", $barcode_num);
                    // $update_profile->bindvalue("barcode_img", $barcode_img);
                    $update_profile->bindvalue("user_id", $id);
                    $update_profile->execute();

                    if($update_profile){
                        /* get state_id */
                        $get_state_num = $connectdb->prepare('SELECT * FROM users WHERE res_state = :res_state');
                        $get_state_num->bindvalue("res_state", $state);
                        $get_state_num->execute();
                        if($get_state_num->rowCount() > 0){
                            $state_id = $get_state_num->rowCount();
                        }else{
                            $state_id = 1;
                        }
                        $code = strtoupper(substr($state, 0, 3));
                        $cur_time = Date("Y");
                        $reg_number = $code."/".$cur_time ."/0".$state_id."/0".$id;
                        // update reg number with state
                        $update_reg = $connectdb->prepare("UPDATE users SET reg_number = :reg_number WHERE user_id = :user_id");
                        $update_reg->bindValue("reg_number", $reg_number);
                        $update_reg->bindValue("user_id", $id);
                        $update_reg->execute();
                        if($update_reg){
                            $_SESSION['success'] = "Profile updated successfully!";
                            header("Location: ../views/user.php");
                        }else{
                            $_SESSION['error'] = "Update registration failed";
                            header("Location: ../views/welcome_page.php");
                        }
                        
                    }else{
                        $_SESSION['error'] = "Update failed";
                        header("Location: ../views/welcome_page.php");
                    }
                }else{
                    $_SESSION['error'] = "image upload failed";
                    header("Location: ../views/welcome_page.php");
                }
            }else{
                $_SESSION['error'] = "Error! Image size too large! Image should not be larger than 300kb";
                header("Location: ../views/welcome_page.php");
            }
        }else{
            $_SESSION['error'] = "Error! Image format not supported";
            header("Location: ../views/welcome_page.php");
        }
    }else{
        $_SESSION['error'] = "update failed!";
        header("Location: ../views/welcome_page.php");

    }
        

    

?>