<?php
    include "connections.php";

    if(isset($_POST['booth_halls']) && !empty($_POST['booth_halls'])){
        $hall = $_POST['booth_halls'];
        $get_booth = $connectdb->prepare("SELECT * FROM booths WHERE hall = :hall AND booth_status = 0 ORDER BY hall");
        $get_booth->bindvalue("hall", $hall);
        $get_booth->execute();
?>
        <option value=""selected>Select Booth</option>
<?php
        $booths = $get_booth->fetchAll();
        foreach($booths as $booth):
    
?>      
        <option value="<?php echo $booth->booth_id;?>"><?php echo $booth->booth;?></option>
         <?php endforeach;?>

<?php }else{
    echo "<option>Select booth</option>";
}