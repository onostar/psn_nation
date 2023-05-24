<?php
    include "connections.php";
    session_start();


    $event = ucwords(htmlspecialchars(stripslashes($_POST['event'])));
    $venue = ucwords(htmlspecialchars(stripslashes($_POST['venue'])));
    $date = htmlspecialchars(stripslashes($_POST['event_date']));
    /* check if event exsits */
    $check_event = $connectdb->prepare("SELECT * FROM events WHERE event = :event");
    $check_event->bindvalue("event", $event);
    $check_event->execute();
    if($check_event->rowCount() > 0){
        echo "<p class='exist'><span>".$event."</span> already exists!</p>";
    }else{
        $add_event = $connectdb->prepare("INSERT INTO events (event, venue, event_date) VALUES (:event, :venue, :event_date)");
        $add_event->bindvalue("event", $event);
        $add_event->bindvalue("venue", $venue);
        $add_event->bindvalue("event_date", $date);
        $add_event->execute();
        if($add_event){
            echo "<p style='text-align:center; padding:10px; background:green; color:#fff;'><span>".$event."</span> added Successfully!</p>";

?>
    <div class="allResults" style="width:90%;">
        <table>
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Event</td>
                    <td>Venue</td>
                    <td>Date</td>
                    <td>Time</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $n = 1;
                    $get_event = $connectdb->prepare("SELECT * FROM events ORDER BY event_date");
                    $get_event->execute();
                    $rows = $get_event->fetchAll();
                    foreach($rows as $row){
                ?>
                <tr>
                <td><?php echo $n?></td>
                <td><?php echo $row->event?></td>
                <td><?php echo $row->venue?></td>
                <td><?php echo date("jS M, Y", strtotime($row->event_date))?></td>
                <td><?php echo date("H:i:sa", strtotime($row->event_date))?></td>
                    <td>
                        <a style="background:var(--primaryColor); color:#fff; padding:5px 10px;"href="javascript:void(0);" title="View attendance" onclick="showPage('event_attendance.php?event=<?php echo $row->event_id?>')"><i class="fas fa-eye"></i> View</a>
                        <a style="background:var(--secondaryColor); color:#fff; padding:5px 10px;"href="javascript:void(0);" title="Validate attendance" onclick="showPage('event_validation.php?event=<?php echo $row->event_id?>')"><i class="fas fa-users"></i> validate</a>
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
    </div>
<?php
        }else{
            echo "failed to add event";
        }
    }
?>