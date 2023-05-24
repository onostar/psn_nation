<?php
    include "connections.php";
    session_start();


    $hall = ucwords(htmlspecialchars(stripslashes($_POST['hall'])));
    
    /* check if hall exsits */
    $check_booth = $connectdb->prepare("SELECT * FROM booth_categories WHERE hall = :hall");
    $check_booth->bindvalue("hall", $hall);
    $check_booth->execute();
    if($check_booth->rowCount() > 0){
        echo "<p class='exist'><span>".$hall."</span> already exists!</p>";
    }else{
        $add_booth = $connectdb->prepare("INSERT INTO  booth_categories (hall) VALUES (:hall)");
        $add_booth->bindvalue("hall", $hall);
        $add_booth->execute();
        if($add_booth){
            echo "<p><span>".$hall."</span> added Successfully!</p>";
        }else{
            echo "failed to add booth";
        }
    }
?>