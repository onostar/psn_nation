<div id="dashboard">
                    
    <div class="cards" id="card0">
        <a href="javascript:void(0)">
            <p>Registration status</p>
            <div class="infos">
                <?php
                    $get_status = $connectdb->prepare("SELECT payment_status FROM exhibitors WHERE company_email = :company_email");
                    $get_status->bindvalue("company_email", $username);
                    $get_status->execute();
                    $stat = $get_status->fetch();
                    if($stat->payment_status == 1){
                        echo "<i class='fas fa-spinner'></i>";
                    }elseif($stat->payment_status == 2){
                        echo "<i class='fas fa-check'></i>";
                    }else{
                        echo "<i class='fas fa-ban'></i>";
                    }
                ?>
                
                <p>
                    <?php
                        
                        if($stat->payment_status == 1){
                            echo "Processing";
                        }elseif($stat->payment_status == 2){
                            echo "Approved";
                        }else{
                            echo "Pending";
                        }

                        
                    ?>
                </p>
            </div>
        </a>
    </div> 
    <div class="cards" id="card4">
        <a href="javascript:void(0)" class="page_navs" data-page="orderList">
            <div class="infos">
                <i class="fas fa-cart-arrow-down"></i>
            <p>Pending Orders</p>

                <p>
                <?php
                    $orders = $connectdb->prepare("SELECT * FROM orders WHERE company = :company AND order_status = 0");
                    $orders->bindvalue('company', $user->exhibitor_id);
                    $orders->execute();
                    echo $orders->rowCount();
                ?>
                </p>
            </div>
        </a>
    </div> 
    <div class="cards" id="card5">
        <a href="javascript:void(0)">
            <div class="infos">
                <i class="fas fa-coins"></i>
                <p>Daily sales</p>

                <p>
                    <?php
                        
                        $sales = $connectdb->prepare("SELECT SUM(item_price) AS today_sales  FROM orders WHERE company = :company AND order_status = 1 AND delivery_date = CURDATE()");
                        $sales->bindvalue('company', $user->exhibitor_id);
                        $sales->execute();
                        
                        $totals = $sales->fetchAll();
                        foreach($totals as $total){
                            echo "₦ " . number_format($total->today_sales, 2);
                        }
                    ?>
                </p>
            </div>
        </a>
    </div> 
    
</div>