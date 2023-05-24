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
    <!-- accomodation bulk request -->
<div id="bulk_request" class="displays">
                
    <div class="info"></div>
    <div class="add_user_form">
        <h3>Request accomodation for state Members</h3>
        <section id="addCatForm">
            <input type="hidden" value="<?php echo $user->user_id?>" name="bulk_requester" id="bulk_requester">
            <div class="inputs">
                <div class="data">
                    <label for="bulk_delegate">State delegates</label>
                    <select name="bulk_delegate" id="bulk_delegate" required>
                        <option value=""selected>Select delegates</option>
                        <?php
                            $get_delegate = $connectdb->prepare("SELECT * FROM users WHERE res_state = :res_state AND payment_status = 2 AND pcn_number != :pcn_number ORDER BY reg_date");
                            $get_delegate->bindvalue("res_state", $user->res_state);
                            $get_delegate->bindvalue("pcn_number", $user->pcn_number);
                            $get_delegate->execute();
                            $dels = $get_delegate->fetchAll();
                            foreach($dels as $del):
                        ?>
                        <option value="<?php echo $del->user_id?>"><?php echo $del->first_name." ".$del->last_name?></option>
                        <?php endforeach?>
                    </select>
                </div>
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
                
                
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="room">Select room type</label>
                    <select name="user_room" id="user_room" required onchange="getRoomPrice(this.value)">
                    <option value="" selected >Select Hotel first</option>
                    
                    </select>
                    
                </div>
                <div class="data">
                    <label for="check_in_date">Check_in date</label>
                    <input type="date" name="check_in_date" id="check_in_date" required>
                </div>
            </div>
            <div class="inputs" id="price">
                
            </div>
                <button id="request_bulk" name="request_bulk" onclick="requestBulkRooms()">Make Request <i class="fas fa-paper-plane"></i></button>
            
        </section>
    </div>
    <div id="requested" class="allResults">
        <h2>Members requested</h2>
        <hr>
        <div class="search">
            <input type="search" id="searchRequest" placeholder="Enter keyword">
        </div>
        <table id="request_table">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Delegate</td>
                    <td>Hotel</td>
                    <td>Room</td>
                    <td>Price</td>
                    <td>Check in date</td>
                    <td>Status</td>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $get_delegates = $connectdb->prepare("SELECT * FROM request_hotel WHERE request_by = :request_by AND pcn_number != request_by ORDER BY request_date");
                    $get_delegates->bindvalue("request_by", $user->pcn_number);
                    $get_delegates->execute();
                    $n = 1;
                    
                    $delegates = $get_delegates->fetchAll();

                    foreach($delegates as $delegate):
                ?>
                <tr>
                    <td style="text-align:center; color:red"><?php echo $n?></td>
                    <td><?php 
                        $get_user = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
                        $get_user->bindvalue("user_id", $delegate->pcn_number);
                        
                        $get_user->execute();
                        $userss = $get_user->fetchAll();
                        foreach($userss as $users){
                            echo $users->last_name . " ". $users->first_name;
                        }
                        
                    ?></td>
                    <td><?php echo $delegate->hotel;?></td>
                    <td><?php echo $delegate->room?></td>
                    <td><?php 
                        $get_price = $connectdb->prepare("SELECT price FROM rooms WHERE hotel = :hotel AND room = :room");
                        $get_price->bindvalue("hotel", $delegate->hotel);
                        $get_price->bindvalue("room", $delegate->room);
                        $get_price->execute();
                        $price = $get_price->fetch();
                        echo "₦ ".number_format($price->price, 2, ".")?></td>
                        <td><?php echo date("jS M, Y", strtotime($delegate->check_in_date))?></td>   
                    <td><?php
                        if($delegate->request_status ==1){
                            echo "Approved";
                        }else{
                            echo "Pending";
                        }
                    ?></td>
                </tr>
                <?php $n++; endforeach;?>
            </tbody>
        </table>
        <div class="total">
            <P>Amount Due: <?php
                $get_due = $connectdb->prepare("SELECT SUM(amount) AS amount_due FROM request_hotel WHERE request_by = :request_by AND request_by != pcn_number AND request_status = 0");
                $get_due->bindvalue("request_by", $user->pcn_number);
                $get_due->execute();
                $amount_due = $get_due->fetch();
                echo "₦ ".number_format($amount_due->amount_due);
            ?></P>
        </div>
        <?php
            if(!$get_delegates->rowCount() > 0){
                echo "<p class='no_result'>'No result found!'</p>";
            }
        ?>
    </div>
</div>

<?php endforeach; }?>