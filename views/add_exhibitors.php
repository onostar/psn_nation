<?php 
    include "../controller/connections.php";
?>
<div id="add_exhibitor" class="displays" style="width:70%">
    <div class="info"></div>
    <div class="add_user_form" style="border-radius:20px;">
        <h3 style="text-align:center; border-radius:20px 20px 0 0">Add exhibtors to conference</h3>
        <section id="addCatForm">
            <div class="inputs">
                <div class="data">
                    <input type="text" name="company_name" id="company_name" placeholder="Company Name" required>

                </div>
                <div class="data">
                    <input type="text" name="company_address" id="company_address" placeholder="Company Address" required>

                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <input type="tel" name="company_phone" id="company_phone" placeholder="Company's Phone number" required onchange="checkNumber(this.value)">
                </div>
                <div class="data">
                    <input type="text" name="contact_person" id="contact_person" placeholder="Contact person Full Name" required>
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <select name="designation" id="designation" required>
                        <option value="" selected>Designation</option>
                        <option value="Director">Director</option>
                        <option value="General manager">General Manager</option>
                        <option value="Sales manager">Sales manager</option>
                        <option value="Sales Rep">Sales Rep</option>
                        
                    </select>
                </div>
                <div class="data">
                    <input type="tel" name="contact_phone" id="contact_phone" placeholder="Contact Mobile Number" required>
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <input type="email" name="company_email" id="company_email" placeholder="Company's Email address" required>
                </div>
                <div class="data">
                    <!-- <label for="staff_number">Number of staffs</label> -->
                    <input type="number" name="staff_number" id="staff_number" required placeholder="How many staffs wll be present?">
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <select name="booth_halls" id="booth_halls" onchange="getBooth(this.value)"required>
                        <option value="" selected>Select hall</option>
                        <?php
                            $get_hall = $connectdb->prepare("SELECT * FROM booth_categories ORDER BY hall DESC");
                            $get_hall->execute();
                            $halls = $get_hall->fetchAll();
                            foreach($halls as $hall):
                        ?>
                        <option value="<?php echo $hall->hall_id;?>"><?php echo $hall->hall;?></option>
                        <?php endforeach?>
                        
                    </select>
                </div>
                <div class="data">
                    <select name="booth_id" id="booth_id">
                        <option value="" selected>Select booth</option>

                    </select>
                </div>
            </div>
            <div class="inputs">
                <div class="data" id="reg_btn">
                    <button type="submit" name="register_exhibitor" id="register_exhibitor" onclick="addExhibitor()">Register <i class="fas fa-paper-plane"></i></button>
                    
                </div>
                
            </div>
            
        </section>
    </div>
</div>