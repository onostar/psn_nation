<?php
    include "../controller/connections.php";
?>
<!--Approved members -->
<div id="addRestaurant" class="displays allResults">
    <h2>All Registered Fellows</h2>
        <hr>
        <div class="options">
            <div class="search">
                <input type="search" id="searchApproved" placeholder="Enter keyword" onkeyup="searchData(this.value)">
            </div>
            
            
            <button id="download_approved" class="downloadBtn" onclick="convertToExcel('fellow_table', 'Registered Fellows')">Export to Excel <i class="fas fa-file-excel"></i></button>
        </div>
        
        <table id="fellow_table">
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
                    //pagination
                    if(!isset($_GET['page'])){
                        $page_number = 1;
                    }else{
                        $page_number = $_GET['page'];
                    }
                    //set limit
                    $limit = 500;
                    //calculate offset
                    $offset = ($page_number - 1) * $limit;
                    $prev_page = $page_number - 1;
                    $next_page = $page_number + 1;
                    $adjacents = "2";
                    //get number of pages
                    $get_pages = $connectdb->prepare("SELECT * FROM users WHERE fellow = 1 AND payment_status = 2");
                    $get_pages->execute();
                    $pages = $get_pages->rowCount();
                    $total_pages = ceil($pages/$limit);
                    //get second to last page
                    $second_to_last = $total_pages - 1;
                    $get_pay = $connectdb->prepare("SELECT * FROM users WHERE fellow = 1 AND payment_status = 2 ORDER BY reg_date LIMIT $offset, $limit");
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
        <div class="page_links">
            <?php
                if($get_pay->rowCount() > 0){
                    echo "<p><strong>Pages ".$page_number." of ".$total_pages."</strong></p>";
            ?>
            <ul class="pages">
                <?php
                    if($page_number > 1){
                    
                ?>
                    <li><a href="javascript:void(0)" onclick="showPage('delegates.php?page=1')"title="Go to first page"><< First page</a></li>
                    <li><a href="javascript:void(0)" onclick="showPage('delegates.php?page=<?php echo $prev_page?>')"title="Go to previous page">< Previous</a></li>
                <?php
                    }
                    if($page_number < $total_pages){
                    
                ?>
                    <li><a href="javascript:void(0)" onclick="showPage('delegates.php?page=<?php echo $next_page?>')" title="Go to next page">Next ></a></li>
                    <li><a href="javascript:void(0)" onclick="showPage('delegates.php?page=<?php echo $total_pages?>')" title="Go to last page">Last Page >></a></li>
                <?php }?>
            </ul>
            <?php }?>
        </div>
        <?php
             if(!$get_pay->rowCount() > 0){
                echo "<p class='no_result'>'No result found!'</p>";
            }
        ?>
    </div>