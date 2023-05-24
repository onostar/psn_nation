<?php include "../controller/connections.php"?>
<!-- add rooms and prices -->
<div id="add_rooms" class="displays">
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Add rooms to hotel</h3>
        <section id="addCatForm">
            
            <div class="inputs">
                <div class="data">
                    <label for="roomHotel">Select hotel</label>
                    <select name="roomHotel" id="roomHotel" required>
                        <option value="" selected>Select hotel</option>
                        <?php
                            $get_hotel = $connectdb->prepare("SELECT * FROM hotels ORDER BY hotel");
                            $get_hotel->execute();
                            $hotels = $get_hotel->fetchAll();
                            foreach($hotels as $hotel):
                        ?>
                        <option value="<?php echo $hotel->hotel;?>"><?php echo $hotel->hotel;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="data">
                    <label for="hotel">Enter room type</label>
                    <input type="text" name="room" id="room" required>
                </div>
                
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="quantity">Enter room quantity</label>
                    <input type="number" name="quantity" id="quantity" placeholder="Number of available rooms" required>
                </div>
                <div class="data">
                    <label for="prices">Enter room tariff (NGN)</label>
                    <input type="number" name="price" id="price" required placeholder="price per night">
                </div>
                
            </div>
            <button type="submit" id="addRoom" name="addRoom" onclick="addRoom()">Add room <i class="fas fa-hotel"></i></button>
        </section>
    </div>
</div>