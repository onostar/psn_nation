<?php
    include "connections.php";
    session_start();


    $item = ucwords(htmlspecialchars(stripslashes($_POST['item_name'])));
    $category = ucwords(htmlspecialchars(stripslashes($_POST['item_category'])));
    $prize = ucwords(htmlspecialchars(stripslashes($_POST['item_prize'])));
    $company = ucwords(htmlspecialchars(stripslashes($_POST['company'])));
    /* check if item exists exsits */
    $check_item = $connectdb->prepare("SELECT * FROM menu WHERE company = :company AND item_name = :item_name");
    $check_item->bindvalue("company", $company);
    $check_item->bindvalue("item_name", $item);
    $check_item->execute();
    if($check_item->rowCount() > 0){
        echo "<p class='exist'><span>".$item."</span> already exists!</p>";
    }else{
        $add_item = $connectdb->prepare("INSERT INTO menu (item_name, item_category, item_prize, company) VALUES (:item_name, :item_category, :item_prize, :company)");
        $add_item->bindvalue("item_name", $item);
        $add_item->bindvalue("item_category", $category);
        $add_item->bindvalue("item_prize", $prize);
        $add_item->bindvalue("company", $company);
        $add_item->execute();
        if($add_item){
            echo "<p><span>".$item."</span> added Successfully!</p>";
        }else{
            echo "failed to add item";
        }
    }
?>