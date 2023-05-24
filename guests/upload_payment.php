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
    if($user->payment_status == 1){

?>
<div class="management">
    <h2 style='margin-top:0;'>Payment status</h2>
    <p class='enrolled'>You have uploaded payment slip. Kindly await approval!</p>
</div>
<?php }else{ ?>
<!-- Upload payment -->
<div id="uploadPayment" class="displays" style="width:60%!important;">
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Upload payment</h3>
        <form method="POST"  id="addCatForm" action="../controller/upload_guest_payment.php" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $user->user_id?>" name="user_id">
            <div class="inputs">
                <div class="data">
                    <label for="payment">Upload Payment Slip</label>
                    <input type="file" name="payment" id="payment" required>
                </div>
                <button type="submit" id="add_payment" name="add_payment">Upload payment <i class="fas fa-upload"></i></button>
            </div>
        </form>
    </div>
</div>
<?php } endforeach; }?>