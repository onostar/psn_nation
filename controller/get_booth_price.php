<?php
    include "connections.php";
    
    if(isset($_POST['booth_id']) && !empty($_POST['booth_id'])){
        $booth = $_POST['booth_id'];
        $hall = $_POST['booth_halls'];
        $get_price = $connectdb->prepare("SELECT * FROM booths WHERE booth_id = :booth_id AND hall = :hall");
        $get_price->bindvalue("booth_id", $booth);
        $get_price->bindvalue("hall", $hall);
        $get_price->execute();
        
        $prices = $get_price->fetchAll();
        foreach($prices as $price):
    
?>
        <p id="prices">₦ <?php echo number_format($price->booth_price)?></p>
        
         <?php endforeach;?>

<?php }else{
    echo  "<p id='prices'>Select booth</p>";
}