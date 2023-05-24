<?php
    include "../controller/connections.php";

    $filter = htmlspecialchars(stripslashes($_POST['filter']));
    $get_filter = $connectdb->prepare("SELECT * FROM users WHERE attendance != 0 AND guest_type = :guest_type ORDER BY reg_date");
    $get_filter->bindValue("guest_type", $filter);
    $get_filter->execute();
    // if($get_filter->rowCount() > 0){
        //get guest type name
        $get_guest_type = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
        $get_guest_type->bindValue('guest_type_id', $filter);
        $get_guest_type->execute();
        $row = $get_guest_type->fetch();
    
?>
    
    <h2><?php echo $row->guest_type?> Attendance List for PSN 2023 Conference</h2>
    <hr>
    <div class="options">
        <div class="search">
            <input type="search" id="searchAttendance" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        </div>
        <button id="downloadAttend" class="downloadAttend" onclick="convertToExcel('filter_attend_table', '<?php echo $filter?> Attendance List for PSN 2023 Conference')">Export to Excel <i class="fas fa-file-excel"></i></button>
    </div>
    <table id="filter_attend_table">
        <thead>
            <tr>
                <td>S/N</td>
                <td>Full Name</td>
                <td>User type</td>
                <td>PCN Number</td>
                <td>Country</td>
                <td>State</td>
                <td>Phone Numbers</td>
                <td>Reg_Number</td>
                
            </tr>
        </thead>
        <tbody>
        <?php
        if($get_filter->rowCount() > 0){
                $n = 1;
                $alls = $get_filter->fetchAll();

                foreach($alls as $all):
            ?>
            <tr>
                <td style="color:red; text-align:center"><?php echo $n?></td>
                <td><?php echo $all->first_name . " " . $all->last_name;?></td>
                <td style="color:var(--primaryColor)"><?php echo $all->user_type?></td>
                <td><?php echo $all->pcn_number;?></td>
                <td><?php 
                    if($all->country == ""){
                        echo "Nigeria";
                    }else{
                        echo $all->country;
                    }
                ?></td>
                <td><?php echo $all->res_state?></td>
                <td><?php echo $all->whatsapp.", ".$all->other_number;?></td>
                <td><?php echo $all->reg_number;?></td>
                
            </tr>
        <?php $n++; endforeach; }?>
    </tbody>
</table>
<?php
    
    if(!$get_filter->rowCount() > 0){
        echo "<p class='no_result'>'No result found!'</p>";
    }

?>