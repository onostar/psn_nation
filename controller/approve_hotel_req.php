<?php
    include "connections.php";
    session_start();

    if(isset($_GET['request'])){

        $user_id = $_GET['request'];
        $update_payment = $connectdb->prepare("UPDATE request_hotel SET request_status = 1 WHERE request_id = :request_id");

        $update_payment->bindvalue("request_id", $user_id);
        $update_payment->execute();

        if($update_payment){
            /* reduce room */
            $get_room = $connectdb->prepare("SELECT room, hotel FROM request_hotel WHERE request_id = :request_id");
            $get_room->bindvalue("request_id", $user_id);
            $get_room->execute();
            $roomss = $get_room->fetchAll();
            foreach($roomss as $rooms){
                $room = $rooms->room;
                $hotel = $rooms->hotel;
            }
            /* update room quantity */
            $update_room = $connectdb->prepare("UPDATE rooms SET room_quantity = room_quantity - 1 WHERE hotel = :hotel AND room = :room");
            $update_room->bindvalue("hotel", $hotel);
            $update_room->bindvalue("room", $room);
            
            $update_room->execute();
            echo "<div class='success'><p>Accomodation request confirmed for a $room at $hotel!</p></div>";
            // header("Location: ../views/admin.php");
        }else{
            echo "<div class='error_message'><p>Failed to confirm payment!</p></div>";
            // header("Location: ../views/admin.php");
        }
        
        
    }
?>