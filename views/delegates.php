<?php
    include "../controller/connections.php";
?>
<!--Approved members -->
<div id="addRestaurant" class="displays allResults">
    <h2>Delegates</h2>
        <hr>
        <div class="options">
            <div class="search">
                <input type="search" id="searchApproved" placeholder="Enter keyword" onkeyup="searchData(this.value)">
            </div>
            <button class="downloadTags" onclick="printAllTags()">Download tags <i class="fas fa-download"></i></button>
            <button id="download_approved" class="downloadBtn" onclick="convertToExcel('approved_table', 'Registered Delegates')">Export to Excel <i class="fas fa-file-excel"></i></button>
        </div>
        
        <table id="approved_table">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Full Name</td>
                    <td>PCN Number</td>
                    <td>Phone Numbers</td>
                    <td>Registration Id</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $get_pay = $connectdb->prepare("SELECT * FROM users WHERE whatsapp != 'admin' AND payment_status = 2 AND user_type = 'Delegate' ORDER BY reg_date");
                    $get_pay->execute();
                    $n = 1;
                   
                    $alls = $get_pay->fetchAll();

                    foreach($alls as $all):
                ?>
                <tr>
                        <td><button><a href="javascript:void(0)" onclick="showPage('clearance.php?user=<?php echo $all->user_id;?>')" title="View Registration Slip"><?php echo $n?></a></button></td>
                        <td><?php echo $all->first_name . " " . $all->last_name;?></td>
                        <td><?php echo $all->pcn_number;?></td>
                        <td><?php echo $all->whatsapp.", ". $all->other_number;?></td>
                        <td><?php echo $all->reg_number;?></td>
                        
                    
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