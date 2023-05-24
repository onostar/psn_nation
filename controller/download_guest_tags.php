<?php include "tag_style.php"?>
<?php include "../controller/connections.php"?>

<!-- all approved slip -->
<div class="download_slip" style="display:flex;flex-wrap:wrap;margin:0;padding:0;">
            
    <?php
        $get_slips = $connectdb->prepare("SELECT * FROM users WHERE payment_status = 2 AND user_type = 'guest' ORDER BY reg_date");
        $get_slips->execute();
        $slips = $get_slips->fetchall();
        foreach($slips as $slip):
    ?>
    <section class="clearanceSlip">
        <?php
            // change background color base on guest type
            //get guest type
            $find_type = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
            $find_type->bindvalue("guest_type_id", $slip->guest_type);
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
                        <img src="<?php echo '../passports/'.$slip->passport;?>" alt="member passport">
                    </div>
                </div>
                <p class="full_name"><?php echo $slip->last_name . " " .$slip->first_name?></p>
                <?php
                    
                    if($type->guest_type != "Diaspora"){
                        if($type->guest_type == "student" || $type->guest_type == "intern" || $type->guest_type == "NYSC"){
                    
                ?>
                <p id="fellow" style="background:yellow;color:#000;border-radius:5px;"><?php echo $type->guest_type?></p>
                <?php }else{?>
                <p id="fellow" style="background:purple;border-radius:5px;color:#fff"><?php echo $type->guest_type?></p>
                <?php }}?>
                <p><span>Registration ID:</span><br><?php echo $slip->reg_number?></p>
                <div class="qr_code">
                <?php
                    echo "<img src='../controller/barcode.php?codetype=code128&size=200&text=".$slip->barcode."'/>";
                ?>
                <h4 class="barcode"><?php echo $slip->barcode?></h4>
                </div>
                <!-- guest type -->
                
                
            </div>
        </div>
        
        
    </section>
    <?php endforeach?>
</div>
<script>
    window.print();
    window.close();
</script>