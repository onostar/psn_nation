<?php
    include "connections.php";
    session_start();

    if(isset($_POST['login'])){
        $username = ucwords(htmlspecialchars(stripslashes($_POST['username'])));
        $pcn = htmlspecialchars(stripslashes($_POST['password']));

        //make sure password is exactly 6 characters
        if(strlen($pcn) != 6){
            $_SESSION['error'] = "PCN number is not correct";
            header("Location: ../views/registration.php");
        }else{

        $get_user = $connectdb->prepare("SELECT * FROM users WHERE pcn_number = :pcn_number");
        // $get_user->bindvalue("last_name", $username);
        $get_user->bindvalue("pcn_number", $pcn);
        $get_user->execute();

        if($get_user->rowCount() > 0){
            
            $_SESSION['user'] = $pcn;
            if($username === "Admin" && $pcn == 123456){
                header("Location: ../views/admin.php");
            }elseif($username === "User" && $pcn == 222222){
                header("Location: ../views/admin.php");
            }else{
                //check image
                $get_details = $connectdb->prepare('SELECT passport FROM users WHERE pcn_number = :pcn_number');
                $get_details->bindValue("pcn_number", $pcn);
                $get_details->execute();
                $row = $get_details->fetch();
                $passport = $row->passport;
                if(empty($passport)){

                    $_SESSION['reg_success'] = "Update your information to Complete your registration! \r\n ";
                    header("Location: ../views/welcome_page.php");
                }else{
                    header("Location: ../views/user.php");
                }
            }
        }else{
            /* check payment table */
            $get_payment = $connectdb->prepare("SELECT * FROM paid_members WHERE pcn_number = :pcn_number");
            $get_payment->bindvalue("pcn_number", $pcn);
            // $get_payment->bindvalue("last_name", $username);
            $get_payment->execute();
            if($get_payment->rowCount() > 0){
                /* copy details into users table */
                $insert_user = $connectdb->prepare("INSERT INTO users (last_name, first_name, pcn_number, whatsapp, res_state, user_email, gender, fellow) SELECT last_name, first_name, pcn_number, whatsapp, res_state, user_email, gender, fellow FROM paid_members WHERE pcn_number = :pcn_number");
                $insert_user->bindvalue("pcn_number", $pcn);
                $insert_user->execute();
                if($insert_user){
                    $_SESSION['user'] = $pcn;
                    /* update new user reg_number */
                    /* get new user id */
                    $id = $connectdb->lastInsertId();
                    /* get new user detail */
                    $get_state = $connectdb->prepare("SELECT res_state FROM users WHERE user_id = :user_id");
                    $get_state->bindvalue("user_id", $id);
                    $get_state->execute();
                    $view = $get_state->fetch();
                    $state = $view->res_state;
                    /* get state_id */
                    
                    /* set reg number */
                    $code = strtoupper(substr($state, 0, 3));
                    $cur_time = Date("Y");
                    $reg_number = $code."/".$cur_time ."/00";
                    $new_reg = $reg_number.$id;
                    $update_reg = $connectdb->prepare("UPDATE users SET reg_number = :reg_number WHERE pcn_number = :pcn_number");
                    $update_reg->bindvalue("reg_number", $new_reg);
                    $update_reg->bindvalue("pcn_number", $pcn);
                    $update_reg->execute();
                    /* update payment_status */
                    $update_payment = $connectdb->prepare("UPDATE users SET payment_status = 2 WHERE pcn_number = :pcn_number");
                    $update_payment->bindvalue("pcn_number", $pcn);
                    $update_payment->execute();
                    $_SESSION['reg_success'] = "Your Login is successful, Your username is your surname! \r\n While Your password is your PCN number! \r\n ";
                    // $_SESSION['upload'] = "Kindly confirm your details below and upload your passport";
                    /* header("Location: ../views/user.php"); */
                    header("Location: ../views/welcome_page.php");
                }else{
                    $_SESSION['error'] = "Insert failed!";
                    header("Location: ../views/registration.php");
                }
            }else{
                /* check pharmagateway */
                // Initiate curl session in a variable (resource)
                $new_pcn = "$pcn";
                $curl_handle = curl_init();
                // endpoint to the api that has the data you want to retrieve
                
                $url = "https://pharmagateway.com.ng/settlements/api_get_nationaldue_status/Nat_psn_capitation/1/".$new_pcn."/2023";
                
                // Set the curl URL option
                curl_setopt($curl_handle, CURLOPT_URL, $url);
                
                // This option will return data as a string instead of direct output
                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                
                // Execute curl & store data in a variable. you data is in this variable $curl_data
                $curl_data = curl_exec($curl_handle);
                // print_r($curl_data);
                
                curl_close($curl_handle);
                // Decode JSON into PHP array
                $response_data = json_decode($curl_data, true);
                //check of object returned pharmacist data
                if($response_data['success'] != 1){
                    // print_r ($response_data);
                    $_SESSION['error'] = "Your capitation for the year ".date("Y")." has not been captured.<br> Kindly contact the numbers below for more details.<br>+2348133635650";
                    header("Location: ../views/registration.php");
                }else{
                
                
                    //UNCOMMENT HERE TO SEE DATA
                    // Print all data if needed
                    // print_r($response_data);
                    // die();
                
                    // All user data exists in 'data' object
                    // $user_data = $response_data->data;
                
                    $email = $response_data['data']['memberemail'];
                    //get other details from the object
                    $details = json_decode($response_data['data']['memberdetails']);
                    $reg_number =  $details->regno;
                    $full_details = $details->fullname;
                    // echo $full_name;
                    //convert full details string to array
                    $details_array = explode(" ", $full_details);
                    $last_name = $details_array[0];
                    $last_name = trim($last_name, ",");
                    $first_name = $details_array[1];
                    //insert into paid members
                    $data = $connectdb->prepare("INSERT INTO paid_members(pcn_number, user_email, last_name, first_name) VALUES (:pcn_number, :user_email, :last_name, :first_name)");
                    $data->bindvalue("pcn_number", $pcn);
                    $data->bindvalue("user_email", $email);
                    $data->bindvalue("last_name", $last_name);
                    $data->bindvalue("first_name", $first_name);
                    $data->execute();
                    //YOU CAN CHECK IF INSERT IS SUCCESSFUL;
                    if($data){
                        /* copy details into users table */
                        $insert_new_user = $connectdb->prepare("INSERT INTO users (last_name, first_name, pcn_number, whatsapp, res_state, user_email, gender, fellow) SELECT last_name, first_name, pcn_number, whatsapp, res_state, user_email, gender, fellow FROM paid_members WHERE pcn_number = :pcn_number");
                        $insert_new_user->bindvalue("pcn_number", $pcn);
                        $insert_new_user->execute();
                        if($insert_new_user){
                            $_SESSION['user'] = $pcn;
                            /* update new user reg_number */
                            /* get new user id */
                            $new_id = $connectdb->lastInsertId();
                            /* get new user detail */
                            $get_new_state = $connectdb->prepare("SELECT res_state FROM users WHERE user_id = :user_id");
                            $get_new_state->bindvalue("user_id", $new_id);
                            $get_new_state->execute();
                            $new_view = $get_new_state->fetch();
                            $new_state = $new_view->res_state;
                            /* get state_id */
                            
                            /* set reg number */
                            $scode = strtoupper(substr($new_state, 0, 3));
                            $scur_time = Date("Y");
                            $sreg_number = $scode."/".$scur_time ."/00";
                            $snew_reg = $sreg_number.$new_id;
                            $supdate_reg = $connectdb->prepare("UPDATE users SET reg_number = :reg_number WHERE pcn_number = :pcn_number");
                            $supdate_reg->bindvalue("reg_number", $snew_reg);
                            $supdate_reg->bindvalue("pcn_number", $pcn);
                            $supdate_reg->execute();
                            /* update payment_status */
                            $supdate_payment = $connectdb->prepare("UPDATE users SET payment_status = 2 WHERE pcn_number = :pcn_number");
                            $supdate_payment->bindvalue("pcn_number", $pcn);
                            $supdate_payment->execute();
                            $_SESSION['reg_success'] = "Your Login is successful, Your username is your surname! \r\n While Your password is your PCN number! \r\n ";
                            // $_SESSION['upload'] = "Kindly confirm your details below and upload your passport";
                            /* header("Location: ../views/user.php"); */
                            header("Location: ../views/welcome_page.php");
                        }
                    }else{
                        $_SESSION['error'] = "Failed to insert from pharmagateway";
                        header("Location: ../views/welcome_page.php");
                    }
                }
                
            }
        }

    }
    }




?>