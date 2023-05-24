<?php
    include "connections.php";
    session_start();
    require "../PHPMailer/PHPMailerAutoload.php";
    require "../PHPMailer/class.phpmailer.php";
    require "../PHPMailer/class.smtp.php";

    if(isset($_POST['recover'])){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        
        /* check database if emai exist */
        $check_email = $connectdb->prepare("SELECT * FROM users WHERE user_email = :user_email");
        $check_email->bindValue('user_email', $email);
        $check_email->execute();

        if(!$check_email->rowCount() > 0){
            $_SESSION['error'] = "This email doesn't exist in our servers!";
            header("Location: ../guests/forgot_password.php");
            
        }else{
            $rows = $check_email->fetchAll();
            foreach($rows as $row){
                $password = $row->guest_password;
            }
            function smtpmailer($to, $from, $from_name, $subject, $body)
            {
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true; 
        
                $mail->SMTPSecure = 'ssl'; 
                $mail->Host = 'www.psnconference.org';
                $mail->Port = 465; 
                $mail->Username = 'admin@psnconference.org';
                $mail->Password = 'admin@psn1010!';   
        
        
                $mail->IsHTML(true);
                $mail->From="admin@psnconference.org";
                $mail->FromName=$from_name;
                $mail->Sender=$from;
                $mail->AddReplyTo($from, $from_name);
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AddAddress($to);
                // $mail->AddAddress('onostarkels@gmail.com');
                if(!$mail->Send())
                {
                    $error ="Please try Later, Error Occured while Processing...";
                    return $error; 
                }
                else 
                {
                    
                    $_SESSION['success'] = "Your Password has been sent to your email";
                    /* unlink($ssn_folder);
                    unlink($dlf_folder);
                    unlink($dlb_folder); */
                    header("Location: ../guests/forgot_password.php");
                    // return $error;
                }
            }
            
            $to   = $email;
            $from = 'admin@psnconference.org';
            $from_name = "Jewel city 2023";
            $name = 'Jewel city 2023 Password recovery';
            $subj = 'PSN conference 2023 Password recovery';
            $msg = "<p>Your Jewel city 2023 Password is <strong>$password</strong></p><br>
            ";          
            $error=smtpmailer($to, $from, $name ,$subj, $msg);
        }
    }
?>