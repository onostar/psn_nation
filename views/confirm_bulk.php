<?php include "../controller/connections.php"?>
<!-- confirm bulk request -->
<div class="displays allResults" id="bulk_request">
    <h2>Bulk Accomodation requests</h2>
        <hr>
        <div class="options">
            <div class="search">
                <input type="search" id="searchBulk" placeholder="Enter keyword">
            </div>
            <button id="download_bulk_req" class="downloadBtn">Export to Excel <i class="fas fa-file-excel"></i></button>
        </div>
        <table id="bulk_table">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Requested by</td>
                    <td>Type</td>
                    <td>Phone</td>
                    <td>Hotel</td>
                    <td>Delegates</td>
                    <td>Amount due</td>
                    <td>Evidence</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $get_bulk = $connectdb->prepare("SELECT * FROM request_hotel WHERE requester = request_by AND bulk = 1");
                    
                    $get_bulk->execute();
                    $n = 1;
                    
                    $bulks = $get_bulk->fetchAll();

                    foreach($bulks as $bulk):
                ?>
                <tr>
                    <td style="color:red; text-align:center"><?php echo $n?></td>
                    <td style="color:var(--otherColor)"><?php 
                        $get_name = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
                        $get_name->bindvalue("user_id", $bulk->requester);
                        $get_name->execute();
                        $names = $get_name->fetchAll();
                        foreach($names as $name){
                            echo $name->first_name." ".$name->last_name;
                        }
                    ?></td>
                    <td><?php 
                        $get_type = $connectdb->prepare("SELECT user_type FROM users WHERE user_id = :user_id");
                        $get_type->bindvalue("user_id", $bulk->requester);
                        $get_type->execute();
                        $type = $get_type->fetch();
                        echo $type->user_type;
                    ?></td>
                    <td><?php 
                        $get_phone = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
                        $get_phone->bindvalue("user_id", $bulk->requester);
                        $get_phone->execute();
                        $phones = $get_phone->fetchAll();
                        foreach($phones as $phone){
                            echo $phone->whatsapp.", ".$phone->other_number;
                        }
                    ?></td>
                    <td style="color:green"><?php echo $bulk->hotel;?></td>
                    <td><?php 
                        $get_delegates = $connectdb->prepare("SELECT * FROM request_hotel WHERE request_by = :request_by AND request_status = 0");
                        $get_delegates->bindvalue("request_by", $bulk->requester);
                        $get_delegates->execute();
                        echo $get_delegates->rowCount();
                    ?></td>
                    <td style="color:red"><?php
                        $get_due = $connectdb->prepare("SELECT SUM(amount) AS amount_due FROM request_hotel WHERE request_by = :request_by AND request_status = 0");
                        $get_due->bindvalue("request_by", $bulk->pcn_requester);
                        $get_due->execute();
                        $amount_due = $get_due->fetch();
                        echo "₦ ".number_format($amount_due->amount_due);
                    ?></td>
                    <td id="rpt_img">
                            
                        <a href="<?php echo "../receipts/".$bulk->bulk_evidence;?>" target="_blank" title="Payment evidence">View slip</a>
                        
                    </td>
                    
                    <td>
                        
                        <button title="Approve Bulk request" onclick="approveBulk('<?php echo $bulk->requester?>')"class="action accept" style="background:green"><i class="fas fa-check"></i></button>
                        <button title="Decline request"onclick="declineBulk('<?php echo $bulk->pcn_requester?>')"class="action decline" style="background:red"><i class="fas fa-ban"></i></button>
                        
                    </td>
                        
                    
                </tr>
                <?php $n++; endforeach;?>
            </tbody>
        </table>
        <?php
            if(!$get_bulk->rowCount() > 0){
                echo "<p class='no_result'>'No result found!'</p>";
            }
        ?>
    </div>