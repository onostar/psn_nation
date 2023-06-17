<div id="rooms">
<?php
    include "../controller/connections.php";
    
        //get room details
        if(isset($_GET['hotel'])){
            $hotel = $_GET['hotel'];
            //get hotel name
            $get_hotel = $connectdb->prepare("SELECT hotel FROM hotels WHERE hotel_id = :hotel_id");
            $get_hotel->bindValue("hotel_id", $hotel);
            $get_hotel->execute();
            $rows = $get_hotel->fetch();
            $hotel_name = $rows->hotel;
?>


<div class="displays all_details">
    <!-- <div class="info"></div> -->
    <button class="page_navs" id="back" onclick="showPage('accomodations.php')"><i class="fas fa-angle-double-left"></i> Back</button>
    <div class="guest_name">
        
        <div class="displays allResults" id="payment_det">
        
            <div class="payment_details">
            <h3>Available room types with price for <?php echo strtoupper($hotel_name)?> </h3>
                <table id="guest_payment_table" class="searchTable">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Room</td>
                            <td>Amount</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $n = 1;
                            $get_rooms =$connectdb->prepare('SELECT * FROM rooms WHERE hotel = :hotel');
                            $get_rooms->bindValue("hotel", $hotel);
                            $get_rooms->execute();
                            $rows = $get_rooms->fetchAll();
                            foreach($rows as $row){
                        ?>
                        <tr>
                            <td style="text-align:center; color:red;"><?php echo $n?></td>
                            <td><?php echo $row->room?></td>
                            <td style="color:green"><?php echo "₦".number_format($row->price, 2);?></td>
                            
                        </tr>
                        
                        <?php $n++; }?>
                    </tbody>
                </table>
                <?php
                    if(!$get_rooms->rowCount() > 0){
                        echo "<p style='color:chocolate'>No records found</p>";
                    }
                ?>
            </div>
            
            
    </div>
    
</div>
<?php
            }
        
    
?>
</div>