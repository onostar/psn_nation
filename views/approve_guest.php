<?php
    include "../controller/connections.php";
?>
<!--Onsite registrants -->
<div id="confirmGuest" class="displays allResults">
    <h2>Delegates</h2>
        <hr>
        <div class="options">
            <div class="search">
                <input type="search" id="searchApproved" placeholder="Enter keyword" onkeyup="searchData(this.value)">
            </div>
            <button id="download_approved" class="downloadBtn" onclick="convertToExcel('approved_table', 'Registered Delegates')">Export to Excel <i class="fas fa-file-excel"></i></button>
        </div>
        
        <table id="approved_table" class="searchTable">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Full Name</td>
                    <td>User type</td>
                    <td>Email</td>
                    <td>Phone Numbers</td>
                    <td>Registration Id</td>
                    <td></td>
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
                    $get_pages = $connectdb->prepare("SELECT * FROM users WHERE whatsapp != 'admin' AND payment_status = 0 AND onsite_delegate = 1");
                    $get_pages->execute();
                    $pages = $get_pages->rowCount();
                    $total_pages = ceil($pages/$limit);
                    //get second to last page
                    $second_to_last = $total_pages - 1;
                    $get_pay = $connectdb->prepare("SELECT * FROM users WHERE whatsapp != 'admin' AND payment_status = 0 AND onsite_delegate = 1 ORDER BY reg_date LIMIT $offset, $limit");
                    $get_pay->execute();
                    $n = 1;
                   
                    $alls = $get_pay->fetchAll();

                    foreach($alls as $all):
                ?>
                <tr>
                        <td><button><a href="javascript:void(0)" onclick="showPage('clearance.php?user=<?php echo $all->user_id;?>')" title="View Registration Slip"><?php echo $n?></a></button></td>
                        <td><?php echo $all->first_name . " " . $all->last_name;?></td>
                        <td><?php echo $all->user_type;?></td>
                        <td><?php echo $all->user_email;?></td>
                        <td><?php echo $all->whatsapp.", ". $all->other_number;?></td>
                        <td><?php echo $all->reg_number;?></td>
                        <td>
                            <button style="background:green;color:#fff; border-radius:5px;" onclick="approveGuest('<?php echo $all->user_id?>')"><i class="fas fa-check"></i></button>
                        </td>
                    
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