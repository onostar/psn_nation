<?php
    include "connections.php";

    if(isset($_POST['user_hotel']) && !empty($_POST['user_hotel'])){
        $hotel = $_POST['user_hotel'];
        $get_room = $connectdb->prepare("SELECT * FROM rooms WHERE hotel = :hotel AND room_quantity != 0 ORDER BY room");
        $get_room->bindvalue("hotel", $hotel);
        $get_room->execute();
?>
    <option value="">select a room</option>
<?php
        $rooms = $get_room->fetchAll();
        foreach($rooms as $room):
    
?>      
        <option value="<?php echo $room->room;?>"><?php echo $room->room;?></option>
         <?php endforeach;?>

<?php }else{
    echo "<option>Select room</option>";
}