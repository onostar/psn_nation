<?php
    session_start();
    include "../controller/connections.php";
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE pcn_number = :pcn_number");
    $user_details->bindvalue("pcn_number", $_SESSION['user']);
    $user_details->execute();

    $users = $user_details->fetchAll();
    foreach($users as $user):
?>
<!-- upload accomodation pay slip -->
<div id="confirm_hotel" class="displays">
    <?php
        $get_evid = $connectdb->prepare("SELECT * FROM request_hotel WHERE pcn_number = :pcn_number AND payment_evidence = ''");
        $get_evid->bindvalue("pcn_number", $user->pcn_number);
        $get_evid->execute();
        if(!$get_evid->rowCount() > 0){
            echo "<p class='alert'>Your accomodation payment has been uploaded already!</p>";
        }else{
    ?>
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Upload accomodation payment</h3>
        <form method="POST"  id="addCatForm" action="../controller/upload_hotel_payment.php" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $user->pcn_number?>" name="user_id">
            <div class="inputs">
                
                <div class="data">
                    <label for="payment">Upload Payment Slip</label>
                    <input type="file" name="payment" id="payment" required>
                </div>
                <button type="submit" id="add_payment" name="add_payment">Upload payment <i class="fas fa-upload"></i></button>
            </div>
        </form>
    </div>
    <?php }?>
</div>
<?php endforeach;?>