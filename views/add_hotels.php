<!-- add hotels -->
<div id="add_hotel" class="displays">
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Add hotel for accomodation</h3>
        <section id="addCatForm">
            
            <div class="inputs">
                <div class="data">
                    <label for="hotel">Enter hotel name</label>
                    <input type="text" name="hotel" id="hotel" required>
                </div>
                <div class="data">
                    <label for="hotel_address">Enter hotel address</label>
                    <input type="text" name="hotel_address" id="hotel_address" required>
                </div>
                
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="website">Enter hotel Website</label>
                    <input type="text" name="website" id="website">
                </div>
                <div class="data">
                    <label for="contact_phone"> Contact numbers</label>
                    <input type="text" name="contact_phone" id="contact_phone">
                </div>

            </div>
            <div class="inputs">
                <button type="submit" id="addHotel" name="addHotel" onclick="addHotel()">Add hotel <i class="fas fa-hotel"></i></button>
            </div>
        </section>
    </div>
</div>