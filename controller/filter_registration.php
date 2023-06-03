<?php
    include "../controller/connections.php";

    $filter = htmlspecialchars(stripslashes($_POST['filter']));
    $get_filter = $connectdb->prepare("SELECT COUNT($filter) AS total, $filter AS infos FROM users WHERE $filter != '' GROUP BY $filter ORDER BY reg_date");
    // $get_filter->bindValue("user_type", $filter);
    $get_filter->execute();
?>

    <h3><?php 
        if($filter == "tech_group"){
            echo "Technical Group";
        }elseif($filter == "res_state"){
            echo "State";
        }elseif($filter == "interest_group"){
            echo "Interest Group";
        }elseif($filter == "user_type"){
            echo "User type";
        }else{
    echo $filter; }?> Registration Statistics for Jewel City 2023 Conference</h3>
        <div class="filter_block">
            <?php
                if($get_filter->rowCount() > 0){
                    $rows = $get_filter->fetchAll();
                    foreach($rows as $row){
            ?>
            <div class="blocks">
                <?php
                    if($filter == "Country"){
                        echo "<i class='fas fa-flag'></i>";
                    }elseif($filter == "res_state"){
                        echo "<i class='fas fa-map'></i>";

                    }elseif($filter == "tech_group"){
                        echo "<i class='fas fa-users'></i>";

                    }else{
                ?>
                <i class="fas fa-user-tie"></i>
                <?php }?>
                <!-- check for guest type -->
                <?php
                    if($filter == "guest_type"){
                        //get guest type name
                        $get_guest_type = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
                        $get_guest_type->bindValue('guest_type_id', $row->infos);
                        $get_guest_type->execute();
                        $guest = $get_guest_type->fetch();

                ?>
                <p><?php echo $guest->guest_type?> -></p> 
                <?php }else{?>
                <p><?php echo $row->infos?> -></p> 
                <?php }?>
                <p class="values"><?php echo $row->total?></p>   
            </div>
            <?php }}?>
        </div>

<?php
    if(!$get_filter->rowCount() > 0){
        echo "<p class='no_result'>'No result found!'</p>";
    }
?>