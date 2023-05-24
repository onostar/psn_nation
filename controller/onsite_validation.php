<?php
    include "connections.php";
    session_start();


    $user = $_GET['user'];
    //check user payment
    $get_user = $connectdb->prepare("SELECT * FROM users WHERE payment_status = 2 AND barcode = :barcode OR pcn_number = :pcn_number");
    $get_user->bindValue('barcode', $user);
    $get_user->bindValue('pcn_number', $user);
    $get_user->execute();
    
    if(!$get_user->rowCount() > 0){
        echo "<p class='exist' style='font-size:1.1rem'>User not found <i class='fas fa-ban'></i></p>";
    }else{
        $rows = $get_user->fetchAll();
        foreach($rows as $row){
    /* check if event has been attended */
    
    if($row->attendance == 1){
        // get user details
?>
<div class="profile_details">
        <div class="nomenclature">
            <div class="user_img">
                <img src="<?php echo '../passports/'.$row->passport?>" alt="<?php echo $row->first_name. " ".$row->last_name?>">
            </div>
            <div class="user_names">
                <h3><?php echo $row->first_name . " ". $row->last_name?></h3>
                <h4><?php echo $row->user_type?></h4>
                <div class="other_info">
                    <?php
                        //user type
                        if($row->user_type == "Guest"){
                            //get guest type
                            $get_guest = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
                            $get_guest->bindValue("guest_type_id", $row->guest_type);
                            $get_guest->execute();
                            $get_guest_type = $get_guest->fetch();
                            $guest_type = $get_guest_type->guest_type;
                            echo "<p>$guest_type</p>";
                        }
                    ?>
                </div>
            </div>
            <div class="success_msg">
                <p>User already validated <i class="fas fa-check"></i></p>
                
                
            </div>
        </div>
        
    </div>
<?php
    }else{
        $validate = $connectdb->prepare("UPDATE users SET attendance = 1 WHERE user_id = :user_id");
        $validate->bindvalue("user_id", $row->user_id);
        $validate->execute();
        if($validate){
            // get user details
            
            /* $rows = $get_user->fetchAll();
            foreach($rows as $row){ */
?>

    <div class="profile_details">
        <div class="nomenclature">
            <div class="user_img">
                <img src="<?php echo '../passports/'.$row->passport?>" alt="<?php echo $row->first_name. " ".$row->last_name?>">
            </div>
            <div class="user_names">
                <h3><?php echo $row->first_name . " ". $row->last_name?></h3>
                <h4><?php echo $row->user_type?></h4>
                <div class="other_info">
                    <?php
                        //user type
                        if($row->user_type == "Guest"){
                            //get guest type
                            $get_guest = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
                            $get_guest->bindValue("guest_type_id", $row->guest_type);
                            $get_guest->execute();
                            $get_guest_type = $get_guest->fetch();
                            $guest_type = $get_guest_type->guest_type;
                            echo "<p>$guest_type</p>";
                        }
                    ?>
                </div>
            </div>
            <div class="success_msg">
                <p>User validated <i class="fas fa-check"></i></p>
                
                
            </div>
        </div>
        
    </div>
<?php            
            // };

        }else{
            echo "failed to attend event";
        }
    }
}
    }
?>