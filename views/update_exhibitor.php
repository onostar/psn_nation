<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
    
        $user_details = $connectdb->prepare("SELECT * FROM exhibitors WHERE company_email = :company_email");
        $user_details->bindvalue("company_email", $username);
        $user_details->execute();

        $users = $user_details->fetchAll();
        foreach($users as $user):
?>
<!-- update profile -->
<div class="displays" id="profile">
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Update profile</h3>
        <form method="POST"  id="addCatForm" action="../controller/update_exh_profile.php">
            <input type="hidden" value="<?php echo $user->exhibitor_id?>" name="user_id">
            <div class="inputs">
                <div class="data">
                    <div class="user_passport">
                        <img src="<?php echo "../logos/".$user->company_logo;?>" alt="Logo">
                    </div>
                    <!-- <input type="file" name="company_logo" id="company_logo"> -->
                </div>
                <div class="data">
                    <label for="contact_person">Conference Reg Number:</label>
                    <p style="font-weight:bold"><?php echo $user->reg_number?></p>
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="company_name">Company Name</label>
                    <input type="text" name="company_name" value="<?php echo $user->company_name;?>" id="company_name">
                </div>
                <div class="data">
                    <label for="address">Address</label>
                    <input type="text" name="company_address" value="<?php echo $user->company_address;?>" id="company_address">
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="company_phone">Company Phone</label>
                    <input type="tel" name="company_phone" value="<?php echo $user->company_phone;?>" id="company_phone">
                </div>
                <div class="data">
                    <label for="company_email">company_email</label>
                    <input type="email" name="company_email" value="<?php echo $user->company_email;?>" id="other_number">
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="contact_person">contact person</label>
                    <input type="text" name="contact_person" value="<?php echo $user->contact_person;?>" id="contact_person">
                </div>
                <div class="data">
                    <label for="contact_phone">contact phone</label>
                    <input type="text" name="contact_phone" value="<?php echo $user->contact_phone;?>" id="contact_phone">
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="Designation">Designation</label>
                    <select name="designation" id="designation">
                        <option value=""selected><?php echo $user->designation?></option>
                        <option value="Director">Director</option>
                        <option value="General manager">General Manager</option>
                        <option value="Sales manager">Sales manager</option>
                    </select>
                </div>
                <div class="data">
                    <label for="portal_manager">E-store manager</label>
                    <input type="text" name="portal_manager" value="<?php echo $user->portal_manager?>">
                </div> 
            </div>
            <div class="inputs">    
                <div class="data">
                    <label for="manager_contact">Manager contact</label>
                    <input type="tel" name="manager_contact" value="<?php echo $user->manager_contact?>">
                </div>
                <div class="data">
                    <button type="submit" id="update" name="update">Update Profile <i class="fas fa-user"></i></button>
                </div>
            </div>
            
                
        </form>
    </div>  

</div>
<?php endforeach; }?>