<?php
    session_start();
    include "../controller/connections.php";
?>
<!-- events -->
<div class="displays" id="guests">
    <div class="add_user_form">
        <h3>Add Sponsors</h3>
        <form method="POST" action="../controller/add_sponsor.php" enctype="multipart/form-data">
            <div class="inputs">
                <div class="data">
                    <label for="category">Category</label>
                    <select name="category" id="category">
                        <option value=""selected>Select sponsor category</option>
                        <option value="Platinum">Platinum</option>
                        <option value="Gold">Gold</option>
                        <option value="Silver">Silver</option>
                    </select>
                </div>
                <div class="data">
                    <label for="sponsor_name">Sponsor Name</label>
                    <input type="text" name="sponsor_name" id="sponsor_name" placeholder="Enter sponsor details" required>
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="logo">Sponsor logo</label>
                    <input type="file" name="logo" id="logo" required>
                </div>
                <div class="data">
                    <button type="submit" id="add_sponsor" name="add_sponsor">Add Sponsor <i class="fas fa-user-graduate"></i></button>
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
                        <td>Category</td>
                        <td>Sponsor</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 1;
                        $get_event = $connectdb->prepare("SELECT * FROM sponsors ORDER BY category");
                        $get_event->execute();
                        $rows = $get_event->fetchAll();
                        foreach($rows as $row){
                    ?>
                    <tr>
                    <td style="color:red; text-align:center"><?php echo $n?></td>
                    <td><?php echo $row->category?></td>
                    <td><?php echo $row->sponsor_name?></td>
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