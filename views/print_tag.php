<!--PRINT RECEIPT -->
<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
    
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE pcn_number = :pcn_number");
    $user_details->bindvalue("pcn_number", $username);
    $user_details->execute();

    $users = $user_details->fetchAll();
    foreach($users as $user):
?>
<div id="printTag" class="displays management">
    <div class="info"></div>
    <h2>Registration Slip</h2>
    <?php 
        $payment_status = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id AND payment_status = 2");
        $payment_status->bindvalue("user_id", $user->user_id);
        $payment_status->execute();
        if(!$payment_status->rowCount() > 0){
            echo "<p class='enrolled'>Registration status is currently pending!</p>";
        }else{
            $get_passport = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id AND payment_status = 2 AND passport = ''");
            $get_passport->bindvalue("user_id", $user->user_id);
            $get_passport->execute();
            if($get_passport->rowCount() > 0){
                echo "<p class='enrolled'>Kindly Upload Your passport</p>";
            }else{
    ?>
    <p class="reg_success">
        You have successfully registered for the 2023 PSN conference.<br> Kindly present the slip below at the point of physical registration
    </p>
    <section class="clearanceSlip">

        <?php if ($user->fellow == 1){?>
        <div class="logos" style="background:blue">
        <?php }else{?>
        <div class="logos">
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
                <p class="full_name"><?php echo $user->first_name . " " .$user->last_name?></p>
                <!-- fellow -->
                <?php
                    if($user->fellow == 1){
                ?>
                <p id="fellow" style="background:blue; border-radius:5px; color:#fff;">FPSN</p>
                <?php }else{?>
                <p style="background:rgb(10, 63, 10); color:#fff;border-radius:5px;"><?php echo $user->user_type?></p>
                <?php }?>
                <p><span>Registration ID:</span><br><?php echo $user->reg_number?></p>
                <div class="qr_code">
                <?php
                    echo "<img src='../controller/barcode.php?codetype=code128&size=200&text=".$user->barcode."'/>";
                ?>
                <!-- <h4 class="barcode"><?php echo $user->barcode?></h4> -->
                </div>
                <div class="tag_sponsor">
                    <img src="../images/mega_logo.jpg" alt="mega" class="mega">

                </div>
            </div>
        </div>
        
        
    </section>
    <div class="download">
        <button id="print" onclick="printTag('<?php echo $user->pcn_number?>')">Print slip <i class="fas fa-print"></i></button>
    </div>
    <?php } }?>
</div>
<?php endforeach; }?>