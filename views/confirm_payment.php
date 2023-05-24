<?php
    include "../controller/connections.php";
?>
<!-- Confirm payments -->
<div id="confirmPayment" class="allResults displays">
    <h2>Confirm payments for 2023</h2>
        <hr>
        <div class="search">
            <input type="search" id="searchPayments" placeholder="Enter keyword">
        </div>
        <table id="payment_table">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Full Name</td>
                    <td>PCN Number</td>
                    <td>Payment Evidence</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $get_pay = $connectdb->prepare("SELECT * FROM users WHERE pcn_number != 'admin' AND payment_status = 1 ORDER BY reg_date");
                    $get_pay->execute();
                    $n = 1;
                    
                    $alls = $get_pay->fetchAll();

                    foreach($alls as $all):
                ?>
                <tr>
                        <td style="color:red; text-align:center"><?php echo $n?></td>
                        <td><?php echo $all->first_name . " " . $all->last_name;?></td>
                        <td><?php echo $all->pcn_number;?></td>
                        <td id="rpt_img"><a href="<?php echo "../receipts/".$all->payment_receipt;?>" target="_blank" title="Payment evidence">View slip</a></td>
                        <td>
                            <button title="Approve user" onclick="approvePayment('<?php echo $all->user_id?>')"class="action accept" style="background:green;color:#fff;padding:5px;">Confirm <i class="fas fa-check"></i></button>
                            <button title="Decline request"onclick="declinePayment('<?php echo $all->user_id?>')"class="action decline" style="background:red;color:#fff;padding:5px;">Decline <i class="fas fa-ban"></i></button>
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