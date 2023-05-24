<div id="dashboard">
                    
    <div class="cards" id="card0">
        <a href="javascript:void(0)">
            <div class="infos">
                <p>Registration status</p>
                <?php
                    $get_status = $connectdb->prepare("SELECT payment_status FROM users WHERE pcn_number = :pcn_number");
                    $get_status->bindvalue("pcn_number", $username);
                    $get_status->execute();
                    $stat = $get_status->fetch();
                    if($stat->payment_status == 1){
                        echo "<p>Processing</p> <i class='fas fa-spinner'></i>";
                    }elseif($stat->payment_status == 2){
                        echo "<p>Approved</p> <i class='fas fa-check'></i>";
                    }else{
                        echo "<p>Pending</p> <i class='fas fa-ban'></i>";
                    }
                ?>
            </div>
        </a>
    </div> 
    <div class="cards" id="card5">
        <a href="javascript:void(0)">
            <div class="infos">
                <i class="fas fa-hotel"></i>
            <p> Events attended </p>

                <p>
                    <?php
                        $get_event = $connectdb->prepare("SELECT * FROM attendance WHERE pharmacist = :pharmacist");
                        $get_event->bindValue("pharmacist", $user->user_id);
                        $get_event->execute();
                        
                        echo $get_event->rowCount();
                        
                    ?>
                </p>
            </div>
        </a>
    </div> 
    <div class="cards" id="card4">
        <a href="javascript:void(0)">
            <div class="infos">
                <i class="fas fa-hotel"></i>
                <p>Accomodation:</p>
                <p>
                    <?php
                        $get_hotel = $connectdb->prepare("SELECT request_status FROM request_hotel WHERE requester = :requester");
                        $get_hotel->bindvalue("requester", $username);
                        $get_hotel->execute();
                        if(!$get_hotel->rowCount() > 0){
                            echo "No request";
                        }else{
                            $hotels = $get_hotel->fetch();
                            if($hotels->request_status == 0){
                                echo "Requested";
                            }elseif($hotels->request_status == 1){
                                echo "Accepted";
                            }else{
                                echo "Denied";
                            }
                        }
                        

                        
                    ?>
                </p>
            </div>
        </a>
    </div> 
    
</div>