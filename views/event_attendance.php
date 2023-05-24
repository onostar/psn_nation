<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
?>

        <!-- attendance list -->
        <?php
            if(isset($_GET['event'])){
                $event = $_GET['event'];
                //get event name
                $get_event = $connectdb->prepare("SELECT event FROM events WHERE event_id = :event_id");
                $get_event->bindValue("event_id", $event);
                $get_event->execute();
                $event_name = $get_event->fetch();
        ?>
        <div id="attendance" class="displays allResults">
            <button onclick="showPage('add_events.php')" id="goback">Go back <i class ="fas fa-angle-double-left"></i></button>
            <h2>Attendance List for <?php echo $event_name->event . " ".date ("Y")?></h2>
                <hr>
                <div class="options">
                    <div class="search">
                        <input type="search" id="searchMenus" placeholder="Enter keyword" onkeyup="searchData(this.value)">
                    </div>
                    <button id="download_members" class="downloadBtn" onclick="convertToExcel('attendance_table', 'Attendance List for <?php echo $event_name->event.' '.date ('Y')?>')">Export to Excel <i class="fas fa-file-excel"></i></button>
                </div>
                <table id="attendance_table" class="searchTable">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Full Name</td>
                            <td>Type</td>
                            <td>State</td>
                            <td>Phone Numbers</td>
                            <td>Registration No.</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                                $get_all = $connectdb->prepare("SELECT * FROM attendance WHERE event = :event ORDER BY date_attend");
                                $get_all->bindValue("event", $event);
                                $get_all->execute();
                                $n = 1;
                                
                                $alls = $get_all->fetchAll();

                                foreach($alls as $all):
                            ?>
                            <tr>
                                <?php
                                    //get user details
                                    $get_user = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
                                    $get_user->bindValue("user_id", $all->pharmacist);
                                    $get_user->execute();
                                    $users = $get_user->fetchAll();
                                    foreach($users as $user){
                                        $fullname = $user->last_name . " ". $user->first_name;
                                        $type = $user->user_type;
                                        $numbers = $user->whatsapp . ", ".$user->other_number;
                                        $state = $user->res_state;
                                        $reg = $user->reg_number;
                                        $id = $user->user_id;
                                    }
                                ?>
                                <td><button><a href="javascript:void(0)" onclick="showPage('clearance.php?user=<?php echo $id;?>')" title="View details"><?php echo $n?></a></button></td>
                                <td><?php echo $fullname;?></td>
                                <td><?php echo $type;?></td>
                                <td><?php echo $state?></td>
                                <td><?php echo $numbers;?></td>
                                <td><?php echo $reg;?></td>
                                
                            </tr>
                        <?php $n++; endforeach;?>
                    </tbody>
                </table>
                <?php
                    if(!$get_all->rowCount() > 0){
                        echo "<p class='no_result'>'No result found!'</p>";
                    }
                ?>
            </div>
            
        <?php }?>
        
      
    </main>
    <script src="../jquery.js"></script>
    <script src="../script.js"></script>
</body>
</html>

<?php 
    }else{
        header("Location: registration.php");
    }
?>