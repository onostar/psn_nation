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
        <div id="event_validation" class="displays allResults">
            <button onclick="showPage('add_events.php')" id="goback">Go back <i class ="fas fa-angle-double-left"></i></button>
                <div class="add_user_form">
                    <h3 style="background:var(--primaryColor); color:#fff">Validate attendance for <?php echo $event_name->event . " ".date ("Y")?></h3>
                    <section>
                        <div class="inputs">
                            <input style="width:50%; padding:10px; border-radius:5px;" type="text" name="user" id="user" placeholder="Enter barcode or name" oninput="attendEvent('<?php echo $event?>', this.value)">
                        </div>
                        <div class="inputs">
                            <div class="users_result">

                            </div>
                        </div>
                    </section>
                    <div class="user_info">
                
                    </div>
                </div>
                
            
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