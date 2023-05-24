<?php
    include "connections.php";
    session_start();


    $hotel = ucwords(htmlspecialchars(stripslashes($_POST['roomHotel'])));
    $room = ucwords(htmlspecialchars(stripslashes($_POST['room'])));
    $quantity = htmlspecialchars(stripslashes($_POST['quantity']));
    $price = htmlspecialchars(stripslashes($_POST['price']));
    /* check if hotel exsits */
    $check_hotel = $connectdb->prepare("SELECT * FROM rooms WHERE hotel = :hotel AND room = :room");
    $check_hotel->bindvalue("hotel", $hotel);
    $check_hotel->bindvalue("room", $room);
    $check_hotel->execute();
    if($check_hotel->rowCount() > 0){
        echo "<p class='exist'><span>".$room."</span> already exists! for" .$hotel." </p>";
    }else{
        $add_hotel = $connectdb->prepare("INSERT INTO rooms (hotel, room, price, room_quantity) VALUES (:hotel, :room, :price, :room_quantity)");
        $add_hotel->bindvalue("hotel", $hotel);
        $add_hotel->bindvalue("room", $room);
        $add_hotel->bindvalue("price", $price);
        $add_hotel->bindvalue("room_quantity", $quantity);
        $add_hotel->execute();
        if($add_hotel){
            echo "<p><span>".$room."</span> added Successfully to ".$hotel."</p>";
        }else{
            echo "failed to add hotel";
        }
    }
?>