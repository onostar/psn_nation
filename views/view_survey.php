<div id="survey_response">
<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_GET['survey'])){
        $survey = $_GET['survey'];
    }
    $user_details = $connectdb->prepare("SELECT * FROM surveys WHERE survey_id = :survey_id");
    // $user_details->bindvalue("user_email", $user);
    $user_details->bindvalue("survey_id", $survey);
    $user_details->execute();
    $users  = $user_details->fetchAll();

    foreach($users as $user):
        //get details
        $get_name = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $get_name->bindvalue("user_id", $user->delegate);
        $get_name->execute();
        $details = $get_name->fetchAll();
        foreach($details as $detail){

?>

<div class="user_details">
<div id="goback">
    <a href="javascript:void(0)" title="go back" onclick="showPage('surveys.php')">Go back <i class="fas fa-angle-double-left"></i></a>
</div>
    <div class="clear"></div>
    <div class="add_user_form">
        <h3>Survey Details</h3>
        <div class="main_details">
            <div class="inputs" style="align-items:flex-start">
                <div class="data">
                    <div class="profile_img">
                        <img src="<?php echo "../passports/".$detail->passport?>" alt="Passport">
                    </div>
                </div>
                <div class="data">
                    
                    <div class="reg_pcn">
                        <div class="data" style="width:100%">
                            <h3 style="background:green"><?php 
                            echo $detail->user_type;
                            if($detail->user_type == "Guest"){
                                //get guests type
                                $guest_types = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
                                $guest_types->bindvalue("guest_type_id", $detail->guest_type);
                                $guest_types->execute();
                                $type = $guest_types->fetch();
                                echo " (".$type->guest_type.")";
                            }
                            ?></h3>
                        </div>
                        <!-- <div class="data">
                            <h3>Reg_number: <?php echo $detail->reg_number;?></h3>
                        </div> -->
                    </div>
                    <div class="tech_groups">
                        <h2>Reg No.: <?php echo $detail->reg_number;?></h2>
                        
                        
                    </div>
                    <?php
                    if($detail->user_type == "Delegate"){
                    ?>
                    <div class="pcn">
                        <p>
                            <?php
                                echo "<span>PCN:</span> $detail->pcn_number";
                            ?>
                        </p>
                        <p class="fel"><?php 
                            if($detail->fellow == 1){
                                echo "Fellow";
                            }
                        ?></p>
                    </div>
                    <?php }?>

                </div>
                
            </div>
            <div class="response">
                <h3 style="background:var(--primaryColor)">Response</h3>
                <div class="inputs">
                    <div class="data">
                        <h2>What is your level of satisfaction with this event?</h2>
                    </div>
                    <div class="data">
                        <p><?php echo $user->satisfaction?></p>
                    </div>
                </div>
                <div class="inputs">
                    <div class="data">
                        <h2>What elements of the event did you like the most?</h2>
                    </div>
                    <div class="data">
                        <p><?php echo $user->elements?></p>
                    </div>
                </div>
                <div class="inputs">
                    <div class="data">
                        <h2>Did you have any issues registering for or attending this conference?</h2>
                    </div>
                    <div class="data">
                        <p><?php echo $user->registration?></p>
                    </div>
                </div>
                <div class="inputs">
                    <div class="data">
                        <h2>What topics would you like to see more of at our next conference?</h2>
                    </div>
                    <div class="data">
                        <p><?php echo $user->topics?></p>
                    </div>
                </div>
                <div class="inputs">
                    <div class="data">
                        <h2>How satisfied where you with the speakers and sessions at the events?</h2>
                    </div>
                    <div class="data">
                        <p><?php echo $user->speakers?></p>
                    </div>
                </div>
            </div>
            
        </div>  
    </div> 
</div>     
<?php }; endforeach;?>
</div>