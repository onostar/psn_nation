<?php include "../controller/connections.php"?>
<!-- confirm booth payment -->
<div id="approve_exhibitors" class="allResults displays">
    <h2>Confirm payments for booths</h2>
        <hr>
        <div class="search">
            <input type="search" id="searchBooths" placeholder="Enter keyword">
        </div>
        <table id="booth_table">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Company</td>
                    <td>Phone Number</td>
                    <td>Booth</td>
                    <td>Booth price</td>
                    <td>Payment Evidence</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $get_pay = $connectdb->prepare("SELECT * FROM exhibitors WHERE payment_status = 1 ORDER BY reg_date");
                    $get_pay->execute();
                    $n = 1;
                    
                    $alls = $get_pay->fetchAll();

                    foreach($alls as $all):
                ?>
                <tr>
                        <td style="color:red; text-align:center"><?php echo $n?></td>
                        <td><?php echo $all->company_name;?></td>
                        <td style="color:var(--otherColor)"><?php echo $all->company_phone;?></td>
                        <td style="color:green"><?php 
                            $get_booth = $connectdb->prepare("SELECT * FROM booths WHERE booth_id = :booth_id");
                            $get_booth->bindvalue("booth_id", $all->booth);
                            $get_booth->execute();
                            $boothss = $get_booth->fetchAll();
                            foreach($boothss as $booths){
                                echo $booths->hall." (".$booths->booth.")";

                            }
                        ?></td>
                        <td style="color:red"><?php 
                            $get_booth = $connectdb->prepare("SELECT booth_price FROM booths WHERE booth_id = :booth_id");
                            $get_booth->bindvalue("booth_id", $all->booth);
                            $get_booth->execute();
                            $price = $get_booth->fetch();
                            echo "₦ ".number_format($price->booth_price, 2, ".");
                        ?></td>
                        <td id="rpt_img"><a href="<?php echo "../exh_receipts/".$all->payment_slip;?>" target="_blank" title="Payment evidence">View slip</a></td>
                        <td>
                            <button style="background:green" title="Approve Approve booth payment" onclick="approveExhibitor('<?php echo $all->exhibitor_id;?>')"class="action accept"><i class="fas fa-check"></i></button>
                            <button style="background:red" title="Decline request"onclick="declineExhibitor('<?php echo $all->exhibitor_id?>')"class="action decline"><i class="fas fa-ban"></i></button>
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