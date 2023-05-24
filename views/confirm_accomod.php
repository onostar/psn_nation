<?php include "../controller/connections.php"?>
<!-- confirm accomodation -->
<div id="hotel_request" class="displays allResults">
    <h2>Accomodation requests</h2>
        <hr>
        <div class="options">
            <div class="search">
                <input type="search" id="searchHotel" placeholder="Enter keyword">
            </div>
            <button id="download_accomodation_req" class="downloadBtn">Export to Excel <i class="fas fa-file-excel"></i></button>
        </div>
        <table id="hotel_table">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Full Name</td>
                    <td>User type</td>
                    <td>Phone</td>
                    <td>Hotel</td>
                    <td>Room</td>
                    <td>Price</td>
                    <td>Check in</td>
                    <td>Evidence</td>
                    <td>Requested by</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $get_pay = $connectdb->prepare("SELECT * FROM request_hotel ORDER BY request_date");
                    $get_pay->execute();
                    $n = 1;
                    
                    $alls = $get_pay->fetchAll();

                    foreach($alls as $all):
                ?>
                <tr>
                    <td style="color:red; text-align:center"><?php echo $n?></td>
                    <td><?php 
                        //get full name
                        $get_name = $connectdb->prepare("SELECT last_name, first_name FROM users WHERE user_id = :user_id");
                        $get_name->bindValue("user_id", $all->requester);
                        // $get_name->bindValue("reg_number", $all->requester);
                        $get_name->execute();
                        $rows = $get_name->fetchAll();
                        foreach($rows as $row){
                        echo $row->first_name . " " . $row->last_name;
                        }
                    ?></td>
                    <td style="color:darkblue"><?php 
                    //get user type
                        $get_type = $connectdb->prepare("SELECT user_type FROM users WHERE user_id = :user_id");
                        $get_type->bindvalue("user_id", $all->requester);
                        $get_type->execute();
                        $type = $get_type->fetch();
                        echo $type->user_type;
                    ?></td>
                    <td><?php 
                        $get_phone = $connectdb->prepare("SELECT whatsapp FROM users WHERE user_id = :user_id");
                        $get_phone->bindvalue("user_id", $all->requester);
                        $get_phone->execute();
                        $phone = $get_phone->fetch();
                        echo $phone->whatsapp;
                    ?></td>
                    <td style="color:green"><?php echo $all->hotel;?></td>
                    <td><?php echo $all->room;?></td>
                    <td style="color:red"><?php
                        $get_price = $connectdb->prepare("SELECT price FROM rooms WHERE hotel = :hotel AND room = :room");
                        $get_price->bindvalue("hotel", $all->hotel);
                        $get_price->bindvalue("room", $all->room);
                        $get_price->execute();
                        $price = $get_price->fetch();
                        echo "₦ ".number_format($price->price)
                    ?></td>
                    <td><?php echo date("jS M, Y", strtotime($all->check_in_date));?></td>
                    <td id="rpt_img">
                        <?php
                            if($all->payment_evidence == '' && $all->request_status == 0){
                                echo "No upload yet";
                            }elseif($all->payment_evidence == '' && $all->request_status == 1){
                                echo "Bulk Request";
                            }else{
                        ?>
                        <a href="<?php echo "../receipts/".$all->payment_evidence;?>" target="_blank" title="Payment evidence">View slip</a>
                        <?php }?>
                    </td>
                    <td><?php
                        if($all->request_by == $all->requester){
                            echo "Self";
                        }else{
                            $get_requester = $connectdb->prepare("SELECT * FROM users WHERE user_id =:user_id");
                            $get_requester->bindvalue("user_id", $all->request_by);
                            $get_requester->execute();
                            $names = $get_requester->fetchAll();
                            foreach($names as $name){
                                echo $name->first_name." ".$name->last_name;
                            }
                        }
                        
                        
                    ;?></td>
                    <td>
                        <?php
                            if($all->request_status == 0){
                        ?>
                        <button title="Approve accomodation" style="background:green" onclick="approveHotel('<?php echo $all->request_id?>')"class="action accept"><i class="fas fa-check"></i></button>
                        <button title="Decline request" style="background:red" onclick="declineHotel('<?php echo $all->request_id?>')"class="action decline"><i class="fas fa-ban"></i></button>
                        <?php
                            }else{
                                echo "<p style='color:green'>Approved</p>";   
                            }
                        ?>
                    </td>
                        
                    
                </tr>
                <?php $n++; endforeach;?>
            </tbody>
        </table>
        <?php
            if(!$get_pay->rowCount() > 0){
                echo "<p class='no_result'>'No result found!'</p>";
            }
        ?>
    </div>