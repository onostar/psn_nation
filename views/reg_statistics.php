<?php
    include "../controller/connections.php";
?>
<section class="filters" id="filter_reg">
    <div class="user_types">
        <button onclick="filterRegistration('user_type')"><i class="fas fa-user-tie"></i> User type</button>
    </div>
    <div class="user_types">
        <button onclick="filterRegistration('Country')"><i class="fas fa-flag"></i> Countries</button>
    </div>
    <div class="user_types">
        <button onclick="filterRegistration('res_state')"><i class="fas fa-map"></i> States</button>
    </div>
    <div class="user_types">
        <button onclick="filterRegistration('tech_group')"><i class="fas fa-users"></i> Technical Groups</button>
    </div>
    <!-- <div class="user_types">
        <button onclick="filterRegistration('interest_group')"><i class="fas fa-users"></i> Interest Groups</button>
    </div> -->
    <div class="user_types">
        <button onclick="filterRegistration('guest_type')"><i class="fas fa-users"></i> Guest type</button>
    </div>
    
</section>

<!-- all members -->
<div class="allResults displays" id="filterResults">
    <!-- <hr> -->
    <div class="options">
        <div class="search">
            <input type="search" id="searchMenus" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        </div>
        <button id="download_members" class="downloadBtn" onclick="convertToExcel('result_table', 'Registered members for Jewell 2023')">Export to Excel <i class="fas fa-file-excel"></i></button>
    </div>
    <h3 style="text-align:center; padding:4px;text-transform:uppercase">Registered Members for Jewel city 2023</h3>
    <table id="result_table" class="searchTable">
        <thead>
            <tr>
                <td>S/N</td>
                <td>Full Name</td>
                <!-- <td>PCN Number</td> -->
                <td>Phone Number</td>
                <td>type</td>
                <td>State</td>
                <td>Status</td>
                <td>Registration ID</td>
                <!-- <td>Accomodation</td> -->
            </tr>
        </thead>
        <tbody>
            <?php
                //pagination
                if(!isset($_GET['page'])){
                    $page_number = 1;
                }else{
                    $page_number = $_GET['page'];
                }
                //set limit
                $limit = 50;
                //calculate offset
                $offset = ($page_number - 1) * $limit;
                $prev_page = $page_number - 1;
                $next_page = $page_number + 1;
                $adjacents = "2";
                //get number of pages
                $get_pages = $connectdb->prepare("SELECT * FROM users WHERE last_name != 'Admin' AND last_name != 'User'");
                $get_pages->execute();
                $pages = $get_pages->rowCount();
                $total_pages = ceil($pages/$limit);
                //get second to last page
                $second_to_last = $total_pages - 1;
                $get_all = $connectdb->prepare("SELECT * FROM users WHERE last_name != 'Admin' AND last_name != 'User' ORDER BY reg_date LIMIT $offset, $limit");
                $get_all->execute();
                $n = 1;
                
                $alls = $get_all->fetchAll();

                foreach($alls as $all):
            ?>
            <tr>
                <td><button><a href="javascript:void(0)" onclick="showPage('clearance.php?user=<?php echo $all->user_id;?>')" title="View details"><?php echo $n?></a></button></td>
                <td><?php echo $all->first_name . " " . $all->last_name;?></td>
                <!-- <td style="color:var(--otherColor)"><?php echo $all->pcn_number;?></td> -->
                <td style="color:var(--primaryColor)"><?php echo $all->whatsapp;?></td>
                <td style="color:green"><?php echo $all->user_type;?></td>
                <td style="color:green"><?php echo $all->res_state?></td>
                <td style="text-align:center">
                    <?php 
                        if($all->payment_status == 2){
                            echo "<p style='color:green'>A</p>";
                        }else{
                            echo "<p style='color:red'>NA</p>";
                        }
                    ?>
                </td>
                <td><?php echo $all->reg_number;?></td>
                <!-- <td><?php
                    $hotel_status = $connectdb->prepare("SELECT * FROM request_hotel WHERE requester = :requester");
                $hotel_status->bindvalue("requester", $all->user_id);
                $hotel_status->execute();
                if(!$hotel_status->rowCount() > 0){
                    echo "No request";
                }else{
                    $requests = $hotel_status->fetchAll();
                    foreach($requests as $request){
                        if($request->request_status == 1){
                            echo $request->hotel." <i class='fas fa-check' style='color:green'></i>";
                        }else{
                            echo $request->hotel." <i class='fas fa-spinner' style='color:red'></i>";
                        }
                    }
                }
                ?>
                </td> -->
                
            </tr>
            <?php $n++; endforeach;
            
            ?>
        </tbody>
    </table>
    <div class="page_links">
        <?php
            if($get_all->rowCount() > 0){
                echo "<p><strong>Pages ".$page_number." of ".$total_pages."</strong></p>";
        ?>
        <ul class="pages">
            <?php
                if($page_number > 1){
                
            ?>
                <li><a href="javascript:void(0)" onclick="showPage('reg_statistics.php?page=1')"title="Go to first page"><< First page</a></li>
                <li><a href="javascript:void(0)" onclick="showPage('reg_statistics.php?page=<?php echo $prev_page?>')"title="Go to previous page">< Previous</a></li>
            <?php
                }
                if($page_number < $total_pages){
                
            ?>
                <li><a href="javascript:void(0)" onclick="showPage('reg_statistics.php?page=<?php echo $next_page?>')" title="Go to next page">Next ></a></li>
                <li><a href="javascript:void(0)" onclick="showPage('reg_statistics.php?page=<?php echo $total_pages?>')" title="Go to last page">Last Page >></a></li>
            <?php }?>
        </ul>
        <?php }?>
    </div>
    <?php
        if(!$get_all->rowCount() > 0){
            echo "<p class='no_result'>'No result found!'</p>";
        }
    ?>
</div>