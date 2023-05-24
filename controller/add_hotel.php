<?php
    include "connections.php";
    session_start();


    $hotel = ucwords(htmlspecialchars(stripslashes($_POST['hotel'])));
    $website = htmlspecialchars(stripslashes($_POST['website']));
    $address = ucwords(htmlspecialchars(stripslashes($_POST['hotel_address'])));
    $phone = htmlspecialchars(stripslashes($_POST['contact_phone']));
    /* check if hotel exsits */
    $check_hotel = $connectdb->prepare("SELECT * FROM hotels WHERE hotel = :hotel");
    $check_hotel->bindvalue("hotel", $hotel);
    $check_hotel->execute();
    if($check_hotel->rowCount() > 0){
        echo "<p class='exist'><span>".$hotel."</span> already exists!</p>";
    }else{
        $add_hotel = $connectdb->prepare("INSERT INTO hotels (hotel, website, hotel_address, contact_phone) VALUES (:hotel, :website, :hotel_address, :contact_phone)");
        $add_hotel->bindvalue("hotel", $hotel);
        $add_hotel->bindvalue("website", $website);
        $add_hotel->bindvalue("hotel_address", $address);
        $add_hotel->bindvalue("contact_phone", $phone);
        $add_hotel->execute();
        if($add_hotel){
            echo "<p><span>".$hotel."</span> added Successfully!</p>";
        }else{
            echo "failed to add hotel";
        }
    }
?>