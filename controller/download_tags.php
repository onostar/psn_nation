<?php include "tag_style.php"?>
<?php include "../controller/connections.php"?>


<!-- all approved slip -->
<div class="download_slip" style="display:flex;flex-wrap:wrap;margin:0;padding:0;gap:0; width:100vw; height:100vh">
            
    <?php
        $get_slips = $connectdb->prepare("SELECT * FROM users WHERE payment_status = 2 AND user_type = 'Delegate' ORDER BY reg_date");
        $get_slips->execute();
        $slips = $get_slips->fetchall();
        foreach($slips as $slip):
    ?>
    <section class="clearanceSlip">

        <?php if ($slip->fellow == 1){?>
        <div class="logos" style="background:blue">
        <?php }else{?>
        <div class="logos" style="background:rgb(10, 63, 10)">
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
                <p class="full_name"><?php echo $slip->first_name . " " .$slip->last_name?></p>
                <!-- fellow -->
                <?php
                    if($slip->fellow == 1){
                ?>
                <p id="fellow" style="background:blue; color:#fff;border-radius:5px;">FPSN</p>
                <?php }else{ ?>
                <p style="background:rgb(10, 63, 10); color:#fff; border-radius:5px;"><?php echo $slip->user_type?></p>
                <?php }?>
                <?php
                    if($slip->cpc == 1){
                        echo "<h2 style='color:rgba(241, 56, 23, 0.9)'>CPC</h2>";
                    }else{
                ?>
                <p><span>Registration ID: <?php }?></span><br><?php echo $slip->reg_number?></p>
                <div class="qr_code">
                    <?php
                        // echo "<img src='../controller/barcode.php?codetype=code128&size=200&text=".$slip->barcode."'/>";
                        require '../vendor/autoload.php';

                        // This will output the barcode as HTML output to display in the browser
                        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                        echo $generator->getBarcode($slip->barcode, $generator::TYPE_CODE_128);
                    ?>
                <!-- <h4 class="barcode"><?php echo $slip->barcode?></h4> -->
                </div>
                

                
            </div>
        </div>

        <div class="tag_sponsor">
                <img src="../images/mega_logo.jpg" alt="mega" class="mega">
        </div>
    </section>
    <?php endforeach?>
</div>
<script>
    window.print();
    // window.close();
</script>