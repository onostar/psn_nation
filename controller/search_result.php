<?php
    session_start();
    include "connections.php";


        // if(isset($_POST['search'])){
    $result = $_POST['search_items'];
    $search_user = $connectdb->prepare("SELECT * FROM users WHERE user_email LIKE '%$result%' OR reg_number LIKE '%$result%' OR whatsapp LIKE '%$result%' OR first_name LIKE '%$result%' OR last_name LIKE '%$result%' OR res_state LIKE '%$result%' OR pcn_number LIKE '%$result%' AND pcn_number != 'admin' ORDER BY reg_date DESC");

    $search_user->execute();
    $n = 1;

    ?>
    <h2>Showing results for <span><?php echo $result?></span></h2>
    <hr>
    <table id="result_table">
        <thead>
            <tr>
                <td>S/N</td>
                <td>Full Name</td>
                <td>PCN Number</td>
                <td>Phone Number</td>
                <td>Email</td>
                <td>State</td>
                <td>Registration ID</td>
                <td>Accomodation</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $get_all = $connectdb->prepare("SELECT * FROM users WHERE pcn_number != 'admin' ORDER BY reg_date");
                $get_all->execute();
                $n = 1;
                if(!$get_all->rowCount()){
                    echo "<p class='no_result'>'No result found!'</p>";
                }
                $alls = $get_all->fetchAll();

                foreach($alls as $all):
            ?>
            <tr>
                    <td><button><a href="javascript:void(0)" onclick="viewSlip('<?php echo $all->user_id;?>')" title="View Slip"><?php echo $n?></a></button></td>
                    <td><?php echo $all->first_name . " " . $all->last_name;?></td>
                    <td><?php echo $all->pcn_number;?></td>
                    <td><?php echo $all->whatsapp;?></td>
                    <td><?php echo $all->user_email;?></td>
                    <td><?php echo $all->res_state?></td>
                    <td><?php echo $all->reg_number;?></td>
                    <td><?php
                        if($all->hotel_status == 1){
                            echo $all->hotel;
                        }else{
                            echo "Nil";
                        }  
                    ?>
                    </td>
                
            </tr>
            <?php $n++; endforeach;?>
        </tbody>
    </table>

   