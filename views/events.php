<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
    
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE pcn_number = :pcn_number AND payment_status = 2");
    $user_details->bindvalue("pcn_number", $username);
    $user_details->execute();

    $users = $user_details->fetchAll();
    foreach($users as $user):
?>
<!-- events -->
<div class="allResults displays" id="events">
    <div class="infos"></div>
    <h2 style="margin-top:0;">Mark attendance for Events</h2>
    <hr>
    <h4 style="background:var(--moreColor); color:#fff; padding:10px;">Available Events for today</h4>
    <table>
        <thead>
            <tr>
                <td>S/N</td>
                <td>Event</td>
                <td>Venue</td>
                <td>Time</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_event = $connectdb->prepare("SELECT * FROM events WHERE date(event_date) = CURDATE() ORDER BY event_date");
                $get_event->execute();
                $rows = $get_event->fetchAll();
                foreach($rows as $row){
            ?>
            <tr>
            <td><?php echo $n?></td>
            <td><?php echo $row->event?></td>
            <td style="color:red"><?php echo $row->venue?></td>
            <!-- <td><?php echo date("jS M, Y", strtotime($row->event_date))?></td> -->
            <td><?php echo date("H:i:sa", strtotime($row->event_date))?></td>
            <td>
                <?php
                    $get_attendance = $connectdb->prepare("SELECT * FROM attendance WHERE pharmacist = :pharmacist AND event = :event");
                    $get_attendance->bindValue("pharmacist", $user->user_id);
                    $get_attendance->bindValue("event", $row->event_id);
                    $get_attendance->execute();
                    if($get_attendance->rowCount() > 0){
                ?>
                <p style="color:green">Event attended <i class="fas fa-user-check"></i></p>
                <?php }else{ ?>
                <a style="background:green; color:#fff; padding:5px 10px;"href="javascript:void(0);" title="Mark present" onclick="attendEvent('<?php echo $row->event_id?>', '<?php echo $user->user_id?>')"><i class="fas fa-check"></i> Attend</a>
                <?php }?>
            </td>
            </tr>
            <?php $n++; }?>
        </tbody>
        
    </table>
    <?php
        if(!$get_event->rowCount() > 0){
            echo "<p style='text-align:center; padding:10px;background:#fff;'>No event</p>";
        }
    ?>
    <?php 
        endforeach; 
        }
        if(!$user_details->rowCount() > 0){
            echo "<div class='management'>
            <h2 style='margin-top:0;'>Mark attendance for Events</h2>
            <p class='enrolled'>Registration status is currently pending!</p></div>";
        }
    ?>
</div>
