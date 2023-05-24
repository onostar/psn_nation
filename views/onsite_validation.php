<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
?>

        <div id="onsite_validation" class="displays allResults">
                <div class="add_user_form">
                    <h3 style="background:var(--moreColor); color:#fff;text-align:center">Onsite validation for Jewell <?php echo date("Y")?></h3>
                    <section>
                        <div class="inputs">
                            <input style="width:50%; padding:10px; border-radius:5px;" type="text" name="user" id="user" placeholder="Enter barcode or name" oninput="validate(this.value)">
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
        
      
    </main>
    <script src="../jquery.js"></script>
    <script src="../script.js"></script>


<?php 
    }else{
        header("Location: registration.php");
    }
?>