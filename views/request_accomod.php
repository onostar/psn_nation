<!-- request accomodation -->
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
<div id="reqHotel" class="displays">
    <?php
        
        $get_request = $connectdb->prepare("SELECT * FROM request_hotel WHERE requester = :requester");
        $get_request->bindvalue("requester", $user->user_id);
        $get_request->execute();

        if(!$get_request->rowCount() > 0){

        
    ?>
    
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Request Accomodation</h3>
        <section method="POST"  id="addCatForm">
            <input type="hidden" value="<?php echo $user->user_id?>" name="requester" id="requester">
            <input type="hidden" value="<?php echo $user->user_id?>" name="request_by" id="request_by">
            <div class="inputs">
                <div class="data">
                    <label for="user_hotel">Select hotel</label>
                    <select name="user_hotel" id="user_hotel" required onchange="getHotelRoom(this.value)">
                        <option value="" selected>Select Hotel</option>
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
                    <label for="room">Select room type</label>
                    <select name="user_room" id="user_room" required onchange="getRoomPrice(this.value)">
                    <option value="" selected>Select Hotel</option>
                    
                    </select>
                </div>
                
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="check_in_date">Check_in date</label>
                    <input type="date" name="check_in_date" id="check_in_date" required>
                </div>
            </div>
            <div class="inputs" id="price">
                
            </div>
                <button type="submit" id="request" name="request" onclick="requestHotel()">Make Request <i class="fas fa-paper-plane"></i></button>
            
        </section>
    </div>
    <?php
        }else{
            $get_acc_status = $connectdb->prepare("SELECT request_status FROM request_hotel WHERE requester = :requester");
            $get_acc_status->bindvalue("requester", $user->user_id);
            $get_acc_status->execute();
            $status = $get_acc_status->fetch();
            if($status->request_status == 1){
        
    ?>
    <div class="add_user_form">
        <h3>Your Accomodation details</h3>
        <?php
            $get_hotel = $connectdb->prepare("SELECT * FROM request_hotel WHERE requester = :requester");
            $get_hotel->bindvalue("requester", $user->user_id);
            $get_hotel->execute();
            $infos = $get_hotel->fetchAll();
            foreach($infos as $info):
        ?>
        <form action="">
            <div class="inputs">
                <div class="data">
                    <h3 style='background:skyblue'><?php echo $info->hotel?></h3>
                </div>
                <div class="data">
                    <p>Room type: <?php echo $info->room?></p>
                </div>
                
            </div>
            <div class="inputs">
                <div class="data">
                    <p style="font-weight:bold">Amount: <?php 
                        $get_price = $connectdb->prepare("SELECT price FROM rooms WHERE hotel = :hotel AND room = :room");
                        $get_price->bindvalue("hotel", $info->hotel);
                        $get_price->bindvalue("room", $info->room);
                        $get_price->execute();
                        $price = $get_price->fetch();
                        echo "₦ " . number_format($price->price, 2, ".")." <i class='fas fa-check' style='color:green'></i>";
                    ?></p>
                </div>
                <div class="data">
                    <p style="font-weight:bold; text-transform:uppercase">Check in Date: <?php echo date("jS F, Y", strtotime($info->check_in_date))?></p>
                </div>
            </div>
        </form>
        
        <?php endforeach?>
    </div>
    
    <?php
        }else{
            echo "<p class='reg_success'>You have already made a request. kindly await approval</p>";
        }
    ?>
    
    <?php }?>
</div>
<?php
    endforeach;
}
?>