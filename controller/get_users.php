<?php
    include "connections.php";
    session_start();


    $event = $_GET['event'];
    $user = $_GET['user'];
    // $_SESSION['event'] = $event;
    
    //get user
    $get_user = $connectdb->prepare("SELECT * FROM users WHERE payment_status = 2 AND barcode LIKE '%$user%' OR last_name LIKE '%$user%' OR first_name LIKE '%$user%'");
    // $get_user->bindValue("barcode", $user);
    // $get_user->bindValue("last_name", $user);
    // $get_user->bindValue("first_name", $user);
    $get_user->execute();
    
    if(!$get_user->rowCount() > 0){
        echo "<p class='exist'>User has not made payment</p>";
    }else{
        $rows = $get_user->fetchAll();
        foreach($rows as $row){
?>
    <option value="<?php echo $row->user_id?>" onclick="attendEvent('<?php echo $event?>', this.value)"><?php echo $row->first_name. " ". $row->last_name. " (" . $row->user_type.")"?></option>
<?php        
        }
    }
?>