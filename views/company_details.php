<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_GET['company'])){
        $user = $_GET['company'];
    }
    $user_details = $connectdb->prepare("SELECT * FROM exhibitors WHERE exhibitor_id = :exhibitor_id");
    // $user_details->bindvalue("user_email", $user);
    $user_details->bindvalue("exhibitor_id", $user);
    $user_details->execute();
    $users  = $user_details->fetchAll();

    foreach($users as $user):
?>
<div id="company">
        <button onclick="showPage('exhibitors_list.php')" id="goback">Go back <i class ="fas fa-angle-double-left"></i></button>
        <h2 id="reg_slip">Company Details</h2>
        <hr>
        <div id="company_details">
            <div class="information">
                <div class="core">
                    <h3><?php echo $user->company_name?></h3>
                    <p><i class="fas fa-map"></i> <?php echo $user->company_address;?></p>
                    <p><i class="fas fa-envelope"></i> <?php echo $user->company_email?></p>
                    <p><i class="fas fa-phone"></i> <?php echo $user->company_phone?></p>
                </div>
                <div class="info_logo">
                    <img src="../images/conference_logo.png" alt="Company logo">
                </div>
            </div>
            <div class="other_details">
                <div class="con_det">
                    <p>Contact person: <span><?php echo $user->contact_person?></span></p>
                </div>
                <div class="con_det">
                    <p>Booth: <span><?php 
                        if($user->payment_status == 2){
                            //get booth
                            $get_booth = $connectdb->prepare("SELECT booth FROM booths WHERE booth_id = :booth_id");
                            $get_booth->bindvalue("booth_id", $user->booth);
                            $get_booth->execute();
                            $booths = $get_booth->fetch();
                            $com_booth = $booths->booth;
                            //get hall
                            $get_hall = $connectdb->prepare("SELECT hall FROM booth_categories WHERE hall_id = :hall_id");
                            $get_hall->bindvalue("hall_id", $user->hall);
                            $get_hall->execute();
                            $halls = $get_hall->fetch();
                            $com_hall = $halls->hall;
                                echo $com_hall."(".$com_booth. ") <i style='color:green' class='fas fa-check'></i>";
                        }else{
                            echo "Not paid for booth";
                        }
                    ?></span></p>
                </div>
                <div class="con_det">
                    <p>Designation: <span><?php echo $user->designation?></span></p>
                </div>
                <div class="con_det">
                    <p>Contact Phone: <span><?php echo $user->contact_phone?></span></p>
                </div>
                <div class="con_det">
                    <p>Staffs in booth: <span><?php echo $user->staff_number?></span></p>
                </div>
                <div class="con_det">
                    <p>Conference Reg_number: <span><?php echo $user->reg_number?></span></p>
                </div>
            </div>
            <button onclick="printExhTag('<?php echo $user->exhibitor_id?>')">Print tag <i class="fas fa-print"></i></button>
        </div>
        
</div>

<?php endforeach;?>