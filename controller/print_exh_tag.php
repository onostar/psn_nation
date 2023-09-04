<?php include "tag_style.php"?>
<?php 
    include "../controller/connections.php";
    if(isset($_GET['exhibitor'])){
        $exhibitor = $_GET['exhibitor'];
    
        $payment_status = $connectdb->prepare("SELECT * FROM exhibitors WHERE exhibitor_id = :exhibitor_id AND payment_status = 2");
        $payment_status->bindvalue("exhibitor_id", $exhibitor);
        $payment_status->execute();
        $users = $payment_status->fetchAll();
        foreach($users as $user):
?>    


<!-- download exhibitors tag -->
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
            <p><?php echo $user->company_name?></p>
            <p><?php 
                //get booth
                $get_booth = $connectdb->prepare("SELECT booth FROM booths WHERE booth_id = :booth_id");
                $get_booth->bindvalue("booth_id", $user->booth);
                $get_booth->execute();
                $booth_name = $get_booth->fetch();
                echo $booth_name->booth;
            
            ?></p>
            <p><span>ID: </span><?php echo $user->reg_number?></p>
            <!-- <div class="qr_code">
            <img src="../images/qr_code.png" alt="qr_code">
            </div> -->
            <div class="tag_sponsor">
                <img src="../images/mega_logo.jpg" alt="mega" class="mega">
            </div>
        </div>
    </div>
    
    
</section>
<?php endforeach; }?>
<script>
    window.print();
    window.close();
</script>