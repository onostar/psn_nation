<?php
    session_start();
    include "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $user_details = $connectdb->prepare("SELECT * FROM users WHERE pcn_number = :pcn_number");
        $user_details->bindValue("pcn_number", $username);
        $user_details->execute();

        $users = $user_details->fetchAll();
        foreach($users as $user){
            $last_name = $user->last_name;
        }
?>
<!-- events -->
<div class="displays" id="events">
    <?php if($last_name == "Admin"){?>
    <div class="add_user_form">
        <h3>Add an Event</h3>
        <form method="POST">
            <div class="inputs">
                <div class="data">
                    <label for="event">Event title</label>
                    <input type="text" name="event" id="event" placeholder="Input event name" required>
                </div>
                <div class="data">
                    <label for="venue">Event Venue</label>
                    <input type="text" name="venue" id="venue" placeholder="Type event venue" required>
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="event_date">Event Date</label>
                    <input type="datetime-local" name="event_date" id="event_date" required>
                </div>
                <div class="data">
                    <button onclick="addEvent()" type="submit" id="add_event" name="add_event">Add event <i class="fas fa-plus"></i></button>
                </div>
            </div>
        </form>
    </div>
    <?php }?>
    <div class="event_result">
        <h3 style="text-align:center; color:var(--secondaryColor);font-size:1.2rem">Manage Events</h3>
        <div class="allResults" style="width:90%;">
            <table>
                <thead>
                    <tr style="background:var(--moreColor)">
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
                    <tr>
                    <?php $n++; }?>
                </tbody>
                
            </table>
            <?php
                    if(!$get_event->rowCount() > 0){
                        echo "<p style='text-align:center; padding:10px;background:#fff;'>No event</p>";
                    }
                ?>
        </div>
    </div>
</div>
<?php }?>