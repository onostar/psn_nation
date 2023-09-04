<?php include "tag_style.php"?>
<?php

    require "../controller/connections.php";
    if(isset($_GET['guest'])){
        $guest = $_GET['guest'];
    
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
    $user_details->bindvalue("user_id", $guest);
    $user_details->execute();

    $users = $user_details->fetchAll();
    foreach($users as $user):
    
?>


<section class="clearanceSlip">
    <?php
        // change background color base on guest type
        //get guest type
        $find_type = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
        $find_type->bindvalue("guest_type_id", $user->guest_type);
        $find_type->execute();
        $type = $find_type->fetch();
        if($type->guest_type == "Student" || $type->guest_type == "Intern" || $type->guest_type == "NYSC"){
    ?>
    <div class="logos" style="background:yellow;color:#000">
    <?php }elseif($type->guest_type == "Diaspora"){?>
    <div class="logos" style="background:gold">
    <?php }else{?>
    <div class="logos" style="background:purple">
        <?php }?>
        <img src="../images/conference_logo.png" alt="PSN logo">
        <P>Jewel city 2023</P>
    </div>
    <div class="slip">
        <div class="slip_back">
            <img src="../images/psn_logo2.png" alt="psn">
        </div>
        <div class="details">
            <div class="logos_passport">
                <div class="passports">
                    <img src="<?php echo '../passports/'.$user->passport;?>" alt="member passport">
                </div>
            </div>
            <p class="full_name"><?php echo $user->last_name . " " .$user->first_name?></p>
            <?php
                
                if($type->guest_type != "Diaspora"){
                    if($type->guest_type == "student" || $type->guest_type == "intern" || $type->guest_type == "NYSC"){
                
            ?>
            <p id="fellow" style="background:yellow;color:#000"><?php echo $type->guest_type?></p>
            <?php }else{?>
            <p id="fellow" style="background:purple"><?php echo $type->guest_type?></p>
            <?php }}?>
            <p><span>Registration ID:</span><br><?php echo $user->reg_number?></p>
            <div class="qr_code">
            <?php
                echo "<img src='../controller/barcode.php?codetype=code128&size=200&text=".$user->barcode."'/>";
            ?>
            <!-- <h4 class="barcode"><?php echo $user->barcode?></h4> -->
            </div>
            <!-- guest type -->
            <div class="tag_sponsor">
                <img src="../images/mega_logo.jpg" alt="mega" class="mega">

            </div>
            
        </div>
    </div>
    
    
</section>
<?php endforeach; }?>
<script>
    window.print();
    // window.close();
</script>