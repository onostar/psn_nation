<?php 
    session_start();
    include "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
    
        $user_details = $connectdb->prepare("SELECT * FROM exhibitors WHERE company_email = :company_email");
        $user_details->bindvalue("company_email", $username);
        $user_details->execute();

        $users = $user_details->fetchAll();
        foreach($users as $user):    
?>

<!-- upload payment for booth -->
<div id="addCategories" class="displays">
    <?php
        $get_booth_status = $connectdb->prepare("SELECT * FROM exhibitors WHERE exhibitor_id = :exhibitor_id");
        $get_booth_status->bindvalue("exhibitor_id", $user->exhibitor_id);
        $get_booth_status->execute();
        $statuss = $get_booth_status->fetchAll();
        foreach($statuss as $status){
            if($status->payment_status == 2){
            
        
    ?>
    <div class="add_user_form" id="booth_det">
        <?php
            $get_boothId = $connectdb->prepare("SELECT * FROM booths WHERE booth_id = :booth_id");
            $get_boothId->bindvalue("booth_id", $status->booth);
            $get_boothId->execute();
            $booths = $get_boothId->fetchAll();
            foreach($booths as $booth):
        ?>
        <h3>Your Booth details</h3>
        <div class="inputs">
                
            <div class="data">
                <h2><?php echo $booth->hall?></h2>
            </div>
            <div class="data">
                <p>(<?php echo $booth->booth?>)</p>
            </div>
        </div>
        <?php endforeach?>
    </div>
    <?php 
        }elseif($status->payment_status == 1){
            echo "<p class='alert'>Your booth request is still under propagation. Kindly await approval!</p>";
        }else{
    ?>
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Select booth with payment</h3>
        <form method="POST"  id="addCatForm" action="../controller/upload_exh_payment.php" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $user->exhibitor_id?>" name="exhibitor_id">
            <div class="inputs">
                
                <div class="data booth_type">
                    <label for="booth_halls">Select Hall/category</label>
                    <select name="booth_halls" id="booth_halls" required onchange="getBooth(this.value)">
                        <option value=""selected>Select hall category</option>
                        <?php
                            $get_hall = $connectdb->prepare("SELECT * FROM booth_categories ORDER BY hall");
                            $get_hall->execute();
                            $halls = $get_hall->fetchAll();
                            foreach($halls as $hall):
                        ?>
                        <option value="<?php echo $hall->hall;?>"><?php echo $hall->hall;?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="data">
                    <label for="booth">Choose Booths</label>
                    <select name="booth_id" id="booth_id" required onchange="getBoothPrice(this.value)">
                        <option value=""selected>select hall first</option>
                    </select>
                </div>
                
            </div>
            <div class="inputs" id="price">
                
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="payment">Upload Payment Slip</label>
                    <input type="file" name="payment" id="payment" required>
                </div>
                <div class="data">
                    <button type="submit" id="add_booth_pay" name="add_booth_pay">Upload payment <i class="fas fa-upload"></i></button>
                </div>
            </div>
            
        </form>
    </div>
    <?php
            }
        }
    ?>
</div>

<?php endforeach; }?>