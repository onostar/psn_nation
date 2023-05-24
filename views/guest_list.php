<?php
    include "../controller/connections.php";
?>
<!--Approved members -->
<div id="guest_list" class="displays allResults">
    <h2>Guest List</h2>
        <hr>
        <div class="options">
            <div class="search">
                <input type="search" id="searchApproved" placeholder="Enter keyword" onkeyup="searchData(this.value)">
            </div>
            <button class="downloadTags" onclick="printGuestTags()">Download tags <i class="fas fa-download"></i></button>
            <button id="download_approved" class="downloadBtn" onclick="convertToExcel('guest_table', 'Guest list')">Export to Excel <i class="fas fa-file-excel"></i></button>
        </div>
        
        <table id="guest_table" class="searchTable">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Full Name</td>
                    <td>Gender</td>
                    <td>Guest type</td>
                    <td>Country</td>
                    <td>Phone Numbers</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $get_pay = $connectdb->prepare("SELECT * FROM users WHERE user_type = 'guest' ORDER BY reg_date");
                    $get_pay->execute();
                    $n = 1;
                    
                    $alls = $get_pay->fetchAll();

                    foreach($alls as $all):
                ?>
                <tr>
                        <td><button><a href="javascript:void(0)" onclick="showPage('clearance.php?user=<?php echo $all->user_id;?>')" title="View details"><?php echo $n?></a></button></td>
                        <td style="color:var(--otherColor)"><?php echo $all->last_name . " " . $all->first_name;?></td>
                        <td><?php echo $all->gender;?></td>
                        <td style="color:red"><?php 
                            //get guest type
                            $get_guest_type = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
                            $get_guest_type->bindvalue("guest_type_id", $all->guest_type);
                            $get_guest_type->execute();
                            $guest_type = $get_guest_type->fetch();
                            echo $guest_type->guest_type;
                        ?></td>
                        <td><?php echo $all->country;?></td>
                        <td><?php echo $all->whatsapp;?></td>
                        <td>
                            <?php 
                                //get status
                                if($all->payment_status == 0){
                                    echo "<p style='color:red'>Pending <i class='fas fa-ban'></i></p>";
                                }elseif($all->payment_status == 1){
                                    echo "<p style='color:var(--moreColor);'>Processing <i class='fas fa-spinner'></i></p>";
                                }else{
                                    echo "<p style='color:green;'>Approved <i class='fas fa-thumbs-up'></i></p>";
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