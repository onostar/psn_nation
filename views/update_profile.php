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
<!-- update profile -->
<div class="management displays" id="profile">
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Update profile</h3>
        <form method="POST"  id="addCatForm" action="../controller/profile_update.php" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $user->user_id?>" name="user_id">
            <div class="inputs">
                <div class="data">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" value="<?php echo $user->first_name;?>" id="first_name">
                </div>
                <div class="data">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" value="<?php echo $user->last_name;?>" id="last_name" readonly>
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="whatsapp">whatsapp Number</label>
                    <input type="tel" name="whatsapp" value="<?php echo $user->whatsapp;?>" id="whatsapp">
                </div>
                <div class="data">
                    <label for="other_number">Other Number</label>
                    <input type="tel" name="other_number" value="<?php echo $user->other_number;?>" id="other_number">
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="user_email">Email address</label>
                    <input type="email" name="user_email" value="<?php echo $user->user_email;?>" id="user_email">
                </div>
                <div class="data">
                    <label for="res_state">State of practice</label>
                    <select name="res_state" id="res_state" readonly>
                        <option value="<?php echo $user->res_state?>"selected><?php echo $user->res_state?></option>
                        <!-- <option value="Abia">Abia</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="Akwa-ibom">Akwa-ibom</option>
                        <option value="Anambra">Anambra</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bayelsa">Bayelsa</option>
                        <option value="Benue">Benue</option>
                        <option value="Borno">Borno</option>
                        <option value="Cross rivers">Cross rivers</option>
                        <option value="Delta">Delta</option>
                        <option value="Ebonyi">Ebonyi</option>
                        <option value="Edo">Edo</option>
                        <option value="Ekiti">Ekiti</option>
                        <option value="Enugu">Enugu</option>
                        <option value="Gombe">Gombe</option>
                        
                        <option value="Imo">Imo</option>
                        <option value="Jigawa">Jigawa</option>
                        <option value="Kaduna">Kaduna</option>
                        <option value="Kano">Kano</option>
                        <option value="Katsina">Katsina</option>
                        <option value="Kebbi">Kebbi</option>
                        <option value="Kogi">Kogi</option>
                        <option value="Kwarra">Kwarra</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Nassarawa">Nassarawa</option>
                        <option value="Niger">Niger</option>
                        <option value="Ogun">Ogun</option>
                        <option value="Ondo">Ondo</option>
                        <option value="Osun">Osun</option>
                        <option value="Oyo">Oyo</option>
                        <option value="Plateau">Plateau</option>
                        <option value="Rivers">Rivers</option>
                        <option value="Sokoto">Sokoto</option>
                        <option value="Taraba">Taraba</option>
                        <option value="Yobe">Yobe</option>
                        <option value="Zamfara">Zamfara</option>
                        <option value="FCT">FCT</option> -->
                        
                    </select>
                </div>
                <div class="inputs">
                    <div class="data">
                        <label for="tech_group">Technical Group</label>
                        <select name="tech_group" id="tech_group">
                            <option value="<?php echo $user->tech_group?>"selected><?php echo $user->tech_group?></option>
                            <option value="PSN-YPG">PSN-YPG</option>
                            <option value="ACPN">ACPN</option>
                            <option value="NAPA">NAPA</option>
                            <option value="NAIP">NAIP</option>
                            <option value="ALPS">ALPS</option>
                            <option value="CPAN">CPAN</option>
                            <option value="AHAPN">AHAPN</option>
                        </select>
                    </div>
                    <div class="data">
                        <label for="other_number">Gender</label>
                        <select name="gender" id="gender">
                            <option value="<?php echo $user->gender;?>" selected><?php echo $user->gender;?></option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                        
                    </div>
                    
                </div>
                <div class="inputs">
                    <div class="data">
                        <div class="user_passport">
                            <img src="<?php echo "../passports/".$user->passport;?>" alt="Passport">
                        </div>
                        <input type="file" name="passport" id="passport">
                    </div>
                    <div class="data">
                        <button type="submit" id="update" name="update">Update Profile <i class="fas fa-user"></i></button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>  
</div>

<?php endforeach; }?>