<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_GET['user'])){
        $user = $_GET['user'];
    }
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
    // $user_details->bindvalue("user_email", $user);
    $user_details->bindvalue("user_id", $user);
    $user_details->execute();
    $users  = $user_details->fetchAll();

    foreach($users as $user):
?>

<div class="user_details">
<div id="goback">
    <a href="admin.php" href="javascript:void(0)" title="go back">Go back <i class="fas fa-angle-double-left"></i></a>
</div>
    <div class="clear"></div>
    <div class="add_user_form">
        <h3>User Details</h3>
        <div class="main_details">
            <div class="inputs" style="align-items:flex-start">
                <div class="data">
                    <div class="profile_img">
                        <img src="<?php echo "../passports/".$user->passport?>" alt="Passport">
                    </div>
                </div>
                <div class="data">
                    
                    <div class="reg_pcn">
                        <div class="data" style="width:100%">
                            <h3 style="background:green"><?php 
                            echo $user->user_type;
                            if($user->user_type == "Guest"){
                                //get guests type
                                $guest_types = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
                                $guest_types->bindvalue("guest_type_id", $user->guest_type);
                                $guest_types->execute();
                                $type = $guest_types->fetch();
                                echo " (".$type->guest_type.")";
                            }
                            ?></h3>
                        </div>
                        <!-- <div class="data">
                            <h3>Reg_number: <?php echo $user->reg_number;?></h3>
                        </div> -->
                    </div>
                    <div class="tech_groups">
                        <h2>Reg No.: <?php echo $user->reg_number;?></h2>
                        
                        
                    </div>
                    <?php
                    if($user->user_type == "Delegate"){
                    ?>
                    <div class="pcn">
                        <p>
                            <?php
                                echo "<span>PCN:</span> $user->pcn_number";
                            ?>
                        </p>
                        <p class="fel"><?php 
                            if($user->fellow == 1){
                                echo "Fellow";
                            }
                        ?></p>
                    </div>
                    <?php }?>

                </div>
                
            </div>
            
            <div class="inputs">
                <div class="data">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" value="<?php echo $user->first_name;?>" id="first_name">
                </div>
                <div class="data">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" value="<?php echo $user->last_name;?>" id="last_name">
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="whatsapp">Email ddress</label>
                    <input type="email" name="user_email" value="<?php echo $user->user_email;?>" id="user_email">
                </div>
                <div class="data">
                    <label for="phone_number">Phone Number</label>
                    <input type="tel" name="phone_number" value="<?php echo $user->whatsapp;?>" id="phone_number">
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="dob">Date of Birth</label>
                    <input type="text" name="dob" value="<?php echo date("jS M, Y", strtotime($user->dob));?>" id="dob">
                </div>
                <div class="data">
                    <label for="phone_number">Gender</label>
                    
                        <input type="text" value="<?php echo $user->gender?>">
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="tech_group">Technical group</label>
                        <input type="text" value="<?php echo $user->tech_group?>">
                </div>
                <div class="data">
                    <label for="phone_number">Country</label>
                    <?php
                        if($user->user_type == "Delegate"){
                    ?>
                    <input type="text" value="Nigeria">
                    <?php }else{?>
                    <input type="text" name="pharmacy" value="<?php echo $user->country;?>">
                    <?php }?>
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="phone_number">State</label>
                    <input type="text" name="pharmacy_address" value="<?php echo $user->res_state;?>" id="pharmacy_address">
                </div>
                <!-- <div class="data">
                    <label for="Pharmacy-location">Pharmacy Location</label>
                    <input type="text" value="<?php echo $user->pharmacy_location?>">
                </div> -->
                
                
            </div>
            
        </div>  
    </div> 
</div>     
<?php endforeach;?>