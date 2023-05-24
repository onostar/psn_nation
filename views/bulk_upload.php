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
    <!-- upload bulk accomodation pay slip -->
    <div id="confirm_bulk" class="displays">
        <div class="info"></div>
        <div class="add_user_form">
            <h3>Upload bulk payment for accomodation</h3>
            <form method="POST"  id="addCatForm" action="../controller/upload_bulk_payment.php" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $user->pcn_number?>" name="user_id">
                <div class="inputs">
                    <div class="data">
                        <h3>Amount due:<?php
                            $get_due = $connectdb->prepare("SELECT SUM(amount) AS amount_due FROM request_hotel WHERE request_by = :request_by AND request_by != pcn_number AND request_status = 0");
                            $get_due->bindvalue("request_by", $user->pcn_number);
                            $get_due->execute();
                            $amount_due = $get_due->fetch();
                            echo "₦ ".number_format($amount_due->amount_due);
                        ?></h3>
                    </div>
                    <div class="data">
                        <label for="payment">Upload Payment Slip</label>
                        <input type="file" name="payment" id="payment" required>
                    </div>
                    
                </div>
                    <button type="submit" id="add_bulk_payment" name="add_bulk_payment">Upload payment <i class="fas fa-upload"></i></button>
            </form>
        </div>
    </div>
<?php
        endforeach;
    }
?>