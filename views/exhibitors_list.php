<?php include "../controller/connections.php"?>
<!-- view exhibitors -->
<div class="allResults displays" id="exhibitors">
    <h2>Registered Exhibitors</h2>
    <hr>
    <div class="options">
        <div class="search">
            <input type="search" id="searchExh" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        </div>
        <button class="downloadTags" onclick="printExhTags()">Download tags <i class="fas fa-download"></i></button>
        <button id="download_companies" class="downloadBtn" onclick="convertToExcel('exh_table', 'Exhibitors list')">Export to Excel <i class="fas fa-file-excel"></i></button>
    </div>
    
    <table id="exh_table" class="searchTable">
        <thead>
            <tr>
                <td>S/N</td>
                <td>Company</td>
                <td>Address</td>
                <td>Phone Number</td>
                <td>Contact Person</td>
                <td>Contact Number</td>
                <td>Booth</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $get_all = $connectdb->prepare("SELECT * FROM exhibitors ORDER BY reg_date");
                $get_all->execute();
                $n = 1;
                
                $alls = $get_all->fetchAll();

                foreach($alls as $all):
            ?>
            <tr>
                    <td><button><a href="javascript:void(0)" onclick="showPage('company_details.php?company=<?php echo $all->exhibitor_id;?>')" title="View Exhibitor"><?php echo $n?></a></button></td>
                    <td><?php echo $all->company_name?></td>
                    <td><?php echo $all->company_address;?></td>
                    <td><?php echo $all->company_phone;?></td>
                    <td><?php echo $all->contact_person;?></td>
                    <td><?php echo $all->contact_phone;?></td>
                    <td>
                        <?php 
                            if($all->payment_status == 2){
                                //get booth
                                $get_booth = $connectdb->prepare("SELECT booth FROM booths WHERE booth_id = :booth_id");
                                $get_booth->bindvalue("booth_id", $all->booth);
                                $get_booth->execute();
                                $booths = $get_booth->fetch();
                                $com_booth = $booths->booth;
                                //get hall
                                $get_hall = $connectdb->prepare("SELECT hall FROM booth_categories WHERE hall_id = :hall_id");
                                $get_hall->bindvalue("hall_id", $all->hall);
                                $get_hall->execute();
                                $halls = $get_hall->fetch();
                                $com_hall = $halls->hall;
                                    echo $com_hall."(".$com_booth. ") <i style='color:green' class='fas fa-check'></i>";
                                
                                
                            
                            }elseif($all->payment_status == 1){
                                $get_booth = $connectdb->prepare("SELECT booth, hall FROM booths WHERE booth_id = :booth_id");
                                $get_booth->bindvalue("booth_id", $all->booth);
                                $get_booth->execute();
                                $booths = $get_booth->fetchAll();
                                foreach($booths as $booth){
                                    echo $booth->hall."(".$booth->booth. ") <i style='color:red' class='fas fa-spinner'></i>";
                                }
                                
                            }elseif($all->payment_status == -1){
                                echo "Declined";
                            }else{
                                echo "No request";
                            }
                        ?>
                    </td>
                    
                
            </tr>
            <?php $n++; endforeach;?>
            
        </tbody>
    </table>
    <?php
        if(!$get_all->rowCount() > 0){
            echo "<p class='no_result'>'No result found!'</p>";
        }
    ?>
</div>