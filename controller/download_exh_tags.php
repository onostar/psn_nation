<?php include "tag_style.php"?>
<?php include "../controller/connections.php"?>

<!-- download exhibitors tag -->
<div class="download_slip" style="display:flex;flex-wrap:wrap;margin:0;padding:0;">
    <?php
        $get_exhi = $connectdb->prepare("SELECT * FROM exhibitors WHERE payment_status = 2 ORDER BY reg_date");
        $get_exhi->execute();
        $tags = $get_exhi->fetchAll();
        foreach($tags as $tag):
    ?>
    <section class="clearanceSlip">         
        <div class="logos" style="background:red">
            <img src="../images/psn_logo2.png" alt="Logo logo">
            <P>Jewel city 2023</P>
        </div>
        <div class="slip">
            <div class="slip_back">
                <img src="../images/psn_logo2.png" alt="psn">
            </div>
            <div class="details">
                <div class="logos_passport">
                    <div class="passports">
                        <img src="../images/conference_logo.png" alt="Company logo">
                    </div>
                </div>
                <h3 class="full_name" style="background:red; padding:10px; color:#fff; border-radius:5px;">EXHIBITOR</h3>
                <p><?php echo $tag->company_name?></p>
                <p><?php
                $get_booth = $connectdb->prepare("SELECT booth FROM booths WHERE booth_id = :booth_id");
                $get_booth->bindvalue("booth_id", $tag->booth);
                $get_booth->execute();
                $booth_name = $get_booth->fetch();
                echo $booth_name->booth;
                ?> </p>
                <p><span>ID: </span><?php echo $tag->reg_number?></p>
                <!-- <div class="qr_code">
                <img src="../images/qr_code.png" alt="qr_code">
                </div> -->
                <div class="tag_sponsor">
                    <img src="../images/mega_logo.jpg" alt="mega" class="mega">
                </div>
            </div>
        </div>


        </section>
<?php endforeach?>
</div>
<script>
    window.print();
    window.close();
</script>