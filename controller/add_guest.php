<?php
    include "connections.php";
    session_start();


    $guest = ucwords(htmlspecialchars(stripslashes($_POST['guest_type'])));
    $fee = htmlspecialchars(stripslashes($_POST['guest_fee']));
    /* check if gust type exsits */
    $check_guest = $connectdb->prepare("SELECT * FROM guest_types WHERE guest_type = :guest_type");
    $check_guest->bindvalue("guest_type", $guest);
    $check_guest->execute();
    if($check_guest->rowCount() > 0){
        echo "<p class='exist'><span>".$guest."</span> already exists!</p>";
    }else{
        $add_guest = $connectdb->prepare("INSERT INTO guest_types (guest_type, guest_fee) VALUES (:guest_type, :guest_fee)");
        $add_guest->bindvalue("guest_type", $guest);
        $add_guest->bindvalue("guest_fee", $fee);
        $add_guest->execute();
        if($add_guest){
            echo "<p style='text-align:center; padding:10px; margin:10px 0 0; font-size:1rem; color:green;'><span>".$guest."</span> added Successfully!</p>";

?>
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
                    $get_guest = $connectdb->prepare("SELECT * FROM guest_types ORDER BY guest_type");
                    $get_guest->execute();
                    $rows = $get_guest->fetchAll();
                    foreach($rows as $row){
                ?>
                <tr>
                <td style="color:red; text-align:center"><?php echo $n?></td>
                <td><?php echo $row->guest_type?></td>
                <td style="color:green;"><?php echo number_format($row->guest_fee) ?></td>
                <!-- <td>
                    <a style="background:skyblue; color:#fff; padding:5px 10px;"href="javascript:void(0);" title="View attendance" onclick="showPage('event_attendance.php?event=<?php echo $row->event_id?>')"><i class="fas fa-eye"></i> View</a>
                </td> -->
                <tr>
                <?php $n++; }?>
            </tbody>
        </table>
            <?php
                if(!$get_guest->rowCount() > 0){
                    echo "<p style='text-align:center; padding:10px;background:#fff;'>No result found</p>";
                }
            ?>
    </div>
<?php
        }else{
            echo "failed to add event";
        }
    }
?>