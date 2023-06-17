<?php
    include "connections.php";
    session_start();


    $hotel = ucwords(htmlspecialchars(stripslashes($_POST['roomHotel'])));
    $room = ucwords(htmlspecialchars(stripslashes($_POST['room'])));
    // $quantity = htmlspecialchars(stripslashes($_POST['quantity']));
    $price = htmlspecialchars(stripslashes($_POST['price']));
    /* check if room exisits in hote */
    $check_hotel = $connectdb->prepare("SELECT * FROM rooms WHERE hotel = :hotel AND room = :room");
    $check_hotel->bindvalue("hotel", $hotel);
    $check_hotel->bindvalue("room", $room);
    $check_hotel->execute();

    //get hotel name
    $get_hotel = $connectdb->prepare("SELECT hotel FROM hotels WHERE hotel_id = :hotel_id");
    $get_hotel->bindValue("hotel_id", $hotel);
    $get_hotel->execute();
    $rows = $get_hotel->fetch();
    $hotel_name = $rows->hotel;
    if($check_hotel->rowCount() > 0){
        echo "<p class='exist'><span>".$room."</span> already exists! for" .$hotel_name." </p>";
    }else{
        $add_hotel = $connectdb->prepare("INSERT INTO rooms (hotel, room, price) VALUES (:hotel, :room, :price)");
        $add_hotel->bindvalue("hotel", $hotel);
        $add_hotel->bindvalue("room", $room);
        $add_hotel->bindvalue("price", $price);
        // $add_hotel->bindvalue("room_quantity", $quantity);
        $add_hotel->execute();
        if($add_hotel){
            echo "<p><span>".$room."</span> added Successfully to ".$hotel_name."</p>";
        }else{
            echo "failed to add hotel";
        }
    }
?>