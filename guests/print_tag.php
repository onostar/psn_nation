<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
    
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE user_email = :user_email");
    $user_details->bindvalue("user_email", $username);
    $user_details->execute();

    $users = $user_details->fetchAll();
    foreach($users as $user):
?>
<div id="paid_receipt" class="displays management">
                    <div class="info"></div>
                    
    <?php 
        $payment_status = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id AND payment_status = 2 AND passport != ''");
        $payment_status->bindvalue("user_id", $user->user_id);
        $payment_status->execute();
        if(!$payment_status->rowCount() > 0){
            echo "";
        }else{
    ?>
    <p class="reg_success">
        You have successfully registered for the PSN 2023 National conference.<br> Kindly present the slip below at the point of physical validation
    </p>
    <h2>Registration Slip</h2>
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
                <h4 class="barcode"><?php echo $user->barcode?></h4>
                </div>
                <!-- guest type -->
                
                
            </div>
        </div>
        
        
    </section>
    <div class="download">
        <button id="print" onclick="printGuestTag('<?php echo $user->user_id?>')">Print slip <i class="fas fa-print"></i></button>
    </div>
    <?php }?>
</div>
<?php endforeach; }?>