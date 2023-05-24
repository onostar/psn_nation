<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_GET['user'])){
        $user = $_GET['user'];
    }
    $user_details = $connectdb->prepare("SELECT * FROM guests WHERE guest_id = :guest_id");
    // $user_details->bindvalue("user_email", $user);
    $user_details->bindvalue("guest_id", $user);
    $user_details->execute();
    $users  = $user_details->fetchAll();

    foreach($users as $user):
?>

        <!-- search results -->
    <?php
        if($user->payment_status != 2){
            echo "<div class='status_message'>
            <p>This user has not made payment for the " . Date("Y") ." Conference Registration</p></div>";
        }else{
    ?>
        <button onclick="showPage('guest_list.php')" id="goback">Go back <i class ="fas fa-angle-double-left"></i></button>
        <h2 id="reg_slip">Registration slip</h2>
        <hr>
        <section class="clearanceSlip">
            
            <div class="logos">
                <img src="../images/psn_logo2.png" alt="PSN logo">
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
                    <p class="full_name"><?php echo $user->last_name . " " .$user->first_name?></p>
                    <p id="fellow"><?php
                        //get guest type
                        $get_guest_type = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
                        $get_guest_type->bindvalue("guest_type_id", $user->guest_type);
                        $get_guest_type->execute();
                        $guest_type = $get_guest_type->fetch();
                        echo $guest_type->guest_type;
                    ?></p>
                    <p><span>Registration ID: </span><?php echo $user->reg_number?></p>
                    <div class="qr_code">
                    <img src="../images/qr_code.png" alt="qr_code">
                    </div>
                    <!-- guest type -->
                    
                    
                </div>
            </div>
            
            
        </section>
        <div class="download">
            <button id="print" onclick="printGuestTag('<?php echo $user->guest_id?>')">Print slip <i class="fas fa-print"></i></button>
        </div>
        <?php }?>
<?php endforeach;?>