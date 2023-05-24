<?php
    include "connections.php";
    session_start();

    // if(isset($_POST['request'])){
        $request_by = htmlspecialchars(stripslashes($_POST['request_by']));
        $hotel = htmlspecialchars(stripslashes($_POST['user_hotel']));
        $room = htmlspecialchars(stripslashes($_POST['user_room']));
        $date = htmlspecialchars(stripslashes($_POST['check_in_date']));
        $requester = htmlspecialchars(stripslashes($_POST['requester']));
        $amount = htmlspecialchars(stripslashes($_POST['amount']));
        $start_date = date("2023-07-24");
        $end_date = date("2023-07-25");
        if($date == $start_date || $date == $end_date){
            $check_status = $connectdb->prepare("SELECT * FROM request_hotel WHERE requester = :requester AND request_status = 0");
            $check_status->bindvalue("requester", $requester);
            $check_status->execute();
            
            if($check_status->rowCount() > 0){
                echo "<div class='error_message'><p>You already have submitted a request! \r\n Kindly await approval</p</div>";
                // header("Location: ../views/user.php");
            }else{
                /* check again */
                $check_confirmed = $connectdb->prepare("SELECT * FROM request_hotel WHERE requester = :requester AND request_status = 1");
                $check_confirmed->bindvalue("requester", $requester);
                $check_confirmed->execute();
                if($check_confirmed->rowCount() > 0){
                    echo "<div class='error_message'><p>You already have accomodation!</p></div>";

                }else{
                    $update_status = $connectdb->prepare("INSERT INTO request_hotel (requester, hotel, room, request_by, check_in_date, amount) VALUES (:requester, :hotel, :room, :request_by, :check_in_date, :amount)");
                    $update_status->bindvalue("hotel", $hotel);
                    $update_status->bindvalue("room", $room);
                    $update_status->bindvalue("requester", $requester);
                    $update_status->bindvalue("request_by", $request_by);
                    $update_status->bindvalue("check_in_date", $date);
                    $update_status->bindvalue("amount", $amount);
                    $update_status->execute();
                    if($update_status){
                        echo "<div class='success'><p>Request submitted successfully. <br> Kindly await approval!</p></div>";

                    }else{
                        echo "Request failed";

                    }
                }
            }
            
        }else{
            echo "<div class='error_message'><p>Error! Check in date cannot be farther than ".date("jS, M, Y", strtotime($end_date)). " nor before ".date("jS, M, Y", strtotime($start_date))."</p></div>";
            // header("Location: ../views/user.php");
        }

    // }

?>