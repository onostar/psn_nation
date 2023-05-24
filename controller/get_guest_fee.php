<?php
    include "connections.php";
    
        $guest = $_POST['guest_type'];
        $get_price = $connectdb->prepare("SELECT guest_fee FROM guest_types WHERE guest_type_id = :guest_type_id");
        $get_price->bindvalue("guest_type_id", $guest);
        $get_price->execute();
        
        $prices = $get_price->fetch();
    
?>
        <p id="prices">Guest fee: <span style="color:red; font-weight:bold">₦ <?php echo number_format($prices->guest_fee)?></span></p>
        <input type="hidden" name="guest_fee" id="guest_fee" value="<?php echo $prices->guest_fee?>">
