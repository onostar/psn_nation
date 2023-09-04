<?php include "tag_style.php"?>
<?php
    require "../controller/connections.php";
    if(isset($_GET['pcn'])){
        $pcn = $_GET['pcn'];
    
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE pcn_number = :pcn_number");
    $user_details->bindvalue("pcn_number", $pcn);
    $user_details->execute();

    $users = $user_details->fetchAll();
    foreach($users as $user):
    
?>

<section class="clearanceSlip">
    <?php if ($user->fellow == 1){?>
    <div class="logos" style="background:blue">
        <?php }else{?>
    <div class="logos" style="background:rgb(10, 63, 10)">
        <?php }?>
        <img src="../images/conference_logo.png" alt="PSN logo">
        <P>Jewell city 2023</P>
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
                <?php
                    if($user->cpc == 1){
                        echo "<h2 style='color:rgba(241, 56, 23, 0.9)'>CPC</h2>";
                    }else{
                ?>
                <p><span>Registration ID: <?php }?></span><br><?php echo $user->reg_number?></p>
            <div class="qr_code">
                <?php
                    echo "<img src='barcode.php?codetype=code128&size=200&text=".$user->barcode."&print=true'/>";
                ?>
                <!-- <h4 class="barcode"><?php echo $user->barcode?></h4> -->
            </div>
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