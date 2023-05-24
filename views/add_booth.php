<?php include "../controller/connections.php"?>
<!-- add booth for exhibition -->
<div id="add_booths" class="displays">
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Add booths for exhibition</h3>
        <section id="addCatForm">
            
            <div class="inputs">
                <div class="data">
                    <label for="booth_hall">Select booth category</label>
                    <select name="booth_hall" id="booth_hall">
                        <option value=""selected>Select Hall</option>
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
                    <label for="booth">Enter booth name</label>
                    <input type="text" name="booth" id="booth" required>
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="booth_price">Enter booth price</label>
                    <input type="number" name="booth_price" id="booth_price" required>
                </div>
                
                <div class="data">
                    <button type="submit" id="addBooth" name="addBooth" onclick="addBooth()">Add booth <i class="fas fa-hotel"></i></button>
                </div>
            </div>
            
        </section>
    </div>
</div>