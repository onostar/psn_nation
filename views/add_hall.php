<?php include "../controller/connections.php"?>
<!-- add hall /both categories for exhibition -->
<div id="booth_categories" class="displays">
    <div class="info"></div>
    <section class="add_user_form">
        <h3>Add halls/booth categories for exhibition</h3>
        <section method="POST"  id="addCatForm">
            
            <div class="inputs">
                <div class="data">
                    <label for="hall">Enter hall name</label>
                    <input type="text" name="hall" id="hall" required>
                </div>
                
            </div>
            <button type="submit" id="addHall" name="addHall" onclick="addHall()">Add hall <i class="fas fa-hotel"></i></button>
</section>
    </div>
</div>