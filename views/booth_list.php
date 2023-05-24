<?php include "../controller/connections.php"?>
<!-- booth list -->
<div class="allResults displays" id="booths">
    <h2>Booths list</h2>
    <hr>
    <div class="options">
        <div class="search">
            <input type="search" id="searchBoothList" placeholder="Enter keyword">
        </div>
        <button id="download_boothList" class="downloadBtn">Export to Excel <i class="fas fa-file-excel"></i></button>
    </div>
    
    <table id="boothList_table">
        <thead>
            <tr>
                <td>S/N</td>
                <td>Hall</td>
                <td>Booth</td>
                <td>Price</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $get_all = $connectdb->prepare("SELECT * FROM booths ORDER BY booth");
                $get_all->execute();
                $n = 1;
                
                $alls = $get_all->fetchAll();

                foreach($alls as $all):
            ?>
            <tr>
                <td style="text-align:center; color:red"><?php echo $n?></td>
                <td><?php echo $all->hall?></td>
                <td style=" color:green"><?php echo $all->booth?></td>
                <td><?php echo "₦ ".number_format($all->booth_price, 2, ".");?></td>
                <td>
                    <?php
                        if($all->booth_status == 1){
                            echo "<span style='color:red'>Taken</span>";
                        }else{
                            echo "Available";
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