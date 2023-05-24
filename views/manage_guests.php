<?php
    session_start();
    include "../controller/connections.php";
?>
<!-- events -->
<div class="displays" id="guests">
    <div class="add_user_form">
        <h3>Add Guest types and fees</h3>
        <form method="POST">
            <div class="inputs">
                <div class="data">
                    <label for="guest_type">Guest type</label>
                    <input type="text" name="guest_type" id="guest_type" placeholder="Input guest type" required>
                </div>
                <div class="data">
                    <label for="guest_fee">Guest fee (NGN)</label>
                    <input type="number" name="guest_fee" id="guest_fee" placeholder="input fee for guest type" required>
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <button onclick="addGuest()" type="submit" id="add_guest" name="add_guest">Add Guest <i class="fas fa-plus"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="guest_types">
        <div class="allResults" style="width:70%; margin:40px auto;">
        <h3>Guest types</h3>
            <table>
                <thead>
                    <tr style="background:var(--moreColor)">
                        <td>S/N</td>
                        <td>Guest type</td>
                        <td>Fees (NGN)</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 1;
                        $get_event = $connectdb->prepare("SELECT * FROM guest_types ORDER BY guest_type");
                        $get_event->execute();
                        $rows = $get_event->fetchAll();
                        foreach($rows as $row){
                    ?>
                    <tr>
                    <td style="color:red; text-align:center"><?php echo $n?></td>
                    <td><?php echo $row->guest_type?></td>
                    <td style="color:green;"><?php echo number_format($row->guest_fee)?></td>
                    <!-- <td>
                        <a style="background:skyblue; color:#fff; padding:5px 10px;"href="javascript:void(0);" title="View attendance" onclick="showPage('event_attendance.php?event=<?php echo $row->event_id?>')"><i class="fas fa-eye"></i> View</a>
                    </td> -->
                    <tr>
                    <?php $n++; }?>
                </tbody>
            </table>
                <?php
                    if(!$get_event->rowCount() > 0){
                        echo "<p style='text-align:center; padding:10px;background:#fff;'>No result found</p>";
                    }
                ?>
        </div>
    </div>
</div>