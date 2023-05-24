<?php include "../controller/connections.php"?>
<!-- Accomodation list -->
<div id="accom_list" class="displays allResults">
    <h2>Accomodation Lists</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchAccomod" placeholder="Enter keyword" onkeyup="searchData(this.value)">
    </div>
    <table id="accomod_table" class="searchTable">
        <thead>
            <tr>
                <td>S/N</td>
                <td>Hotel</td>
                <td>Address</td>
                <td>website</td>
                <td>Contact</td>
                
            </tr>
        </thead>
        <tbody>
            <?php
                /* $get_rooms = $connectdb->prepare("SELECT * FROM rooms ORDER BY hotel");
                $get_rooms->execute();
                $n = 1;
                
                $rooms = $get_rooms->fetchAll();

                foreach($rooms as $room): */
                $n = 1;
                $get_hotels = $connectdb->prepare("SELECT * FROM hotels ORDER BY hotel");
                $get_hotels->execute();
                $rows = $get_hotels->fetchAll();
                foreach($rows as $row){

            ?>
            <tr>
                <td style="color:red; text-align:center"><?php echo $n?></td>
                <td><?php echo $row->hotel;?></td>
                
                <!-- <td style="color:green;"><?php echo $room->room?></td> -->
                <td style="color:green;"><?php echo $row->hotel_address?></td>
                <!-- <td style="color:red;"><?php echo "₦ ".number_format($room->price);?></td> -->
                <td style="color:red;"><?php echo "<a href='https://$row->website' title='hotel website' target='_blank'>$row->website</a>"?></td>
                <!-- <td style="text-align:center;">
                    <?php
                        if($room->room_quantity == 0){
                            echo "<span style='color:red'>Fully Booked</pan>";
                        }else{
                            echo "<span style='color:green'>" .$room->room_quantity."</p>";
                        }
                    ?>
                </td>
                <td style="text-align:center;">
                    <?php
                        $get_bookings = $connectdb->prepare("SELECT * FROM request_hotel WHERE room = :room AND hotel = :hotel AND request_status = 1");
                        $get_bookings->bindvalue("room", $room->room);
                        $get_bookings->bindvalue("hotel", $room->hotel);
                        $get_bookings->execute();
                        echo $get_bookings->rowCount();
                    ?>
                </td> -->
                <td><?php echo $row->contact_phone?></td>
                
            </tr>
            <?php $n++; };?>
        </tbody>
    </table>
    <?php
        if(!$get_hotels->rowCount() > 0){
            echo "<p class='no_result'>'No result found!'</p>";
        }
    ?>
</div>