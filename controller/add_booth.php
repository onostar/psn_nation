<?php
    include "connections.php";
    session_start();


    $booth = htmlspecialchars(stripslashes($_POST['booth']));
    $booth_price = htmlspecialchars(stripslashes($_POST['booth_price']));
    $hall = htmlspecialchars(stripslashes($_POST['booth_hall']));
    /* check if hotel exsits */
    $check_booth = $connectdb->prepare("SELECT * FROM booths WHERE booth = :booth AND hall = :hall");
    $check_booth->bindvalue("booth", $booth);
    $check_booth->bindvalue("hall", $hall);
    $check_booth->execute();
    if($check_booth->rowCount() > 0){
        echo "<p class='exist'><span>".$booth."</span> already exists for ".$hall."!</p>";
    }else{
        $add_booth = $connectdb->prepare("INSERT INTO booths (booth, hall, booth_price) VALUES (:booth, :hall, :booth_price)");
        $add_booth->bindvalue("booth", $booth);
        $add_booth->bindvalue("booth_price", $booth_price);
        $add_booth->bindvalue("hall", $hall);
        $add_booth->execute();
        if($add_booth){
            echo "<p><span>".$booth."</span> added Successfully!</p>";
        }else{
            echo "failed to add booth";
        }
    }
?>