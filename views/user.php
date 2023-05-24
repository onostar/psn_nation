<?php
    session_start();
    
        
    
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE pcn_number = :pcn_number");
    $user_details->bindvalue("pcn_number", $username);
    $user_details->execute();

    $users = $user_details->fetchAll();
    foreach($users as $user):
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to Jewel city 2023 PSN National Conference">
    <meta name="keywords" content="PSN, psn, Pharmacist, pharmaceutical society of Nigeria">
    <title>Jewel city 2023 | <?php echo $user->first_name . " " . $user->last_name;?></title>
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../fontawesome-free-5.15.1-web/css/all.css">
    <link rel="icon" type="image/png" href="../images/conference_logo.png" size="32X32">
    <link rel="stylesheet" href="../style.css">
   
</head>
<body>
    <!-- <div class="loader">
        <img src="images/psn_logo.jpg" alt="PSN">
        <h2>Welcome to PSN national Conference registration</h2>
    </div> -->
    <main>
    
        <header>
            <h1 class="logo">
                <a href="user.php" title="Jewel city 2023">
                    <img src="../images/conference_logo.png" alt="PSN Logo" class="img-fluid">
                </a>
            </h1>
            <h2 id="desktop_h2">Psn Jewel city 2023</h2>
            <h2 id="mobile_h2">Jewel city 2023</h2>
            <div class="other_menu">
                <a href="#" title="User type"><?php echo $user->user_type?></a>
            </div>
            <div class="login">
                <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
                <div class="login_option">
                    <div>
                        <button id="loginBtn"><a href="../controller/logout.php">Log out</a></button>
                    </div>    
                </div>
            </div>
            <div class="cart" id="user_data">
                <a href="javascript:void(0);" title="<?php echo "Pharm. " .$user->last_name;?>" id="user_name">
                     <span><?php echo $user->last_name . " " . $user->first_name;?></span> 
                    <div class="user_img">
                        <img src="<?php echo "../passports/".$user->passport;?>" alt="passport">
                    </div>
                </a>
            </div>
            <div class="menu_icon" id="menu_icon">
                <a href="javascript:void(0)"><i class="fas fa-bars"></i></a>
            </div>
        </header>
    
        
        <div class="admin_main">
            <aside class="main_menu" id="mobile_log">

                <?php include "user_side_menu.php"?>
            </aside>
            <div class="contents">
                <?php include "loading.php"?>;
            <section id="contents">
                <div class="success_message">
                    <p>
                        <?php
                            if(isset($_SESSION['success'])){
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                            }
                        ?>
                    </p>
                </div>
                <div class="error_message">
                    <p>
                        <?php
                            if(isset($_SESSION['error'])){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                        ?>
                    </p>
                </div>
                <?php
                    if(isset($_SESSION['error_note'])){
                        echo "<p class='error_note'>" . $_SESSION['error_note'] . "</p>";
                        unset($_SESSION['error_note']);
                    }
                ?>
                <!-- <?php
                    if(isset($_SESSION['reg_success'])){
                        echo "<p id='reg_success'>" . $_SESSION['reg_success'] . "</p>";
                        unset($_SESSION['reg_success']);
                    }
                ?> -->
                
                        <!-- <form method="post" class="passport_form" action="../controller/upload_passport.php" enctype="multipart/form-data">
                            <label><?php echo $_SESSION['upload']; ?></label><br>
                            <input type="hidden" value="<?php echo $user->user_id;?>" name="user_id">
                            <input type="file" name="passport" required>
                            <button type="submit" name="upload_passport">Upload <i class="fas fa-upload"></i></button>
                        </form> -->
                
                <div class="quick_links" id="quickLinks">
                    <div class="links page_navs" onclick="showPage('accomodations.php')">
                        <i class="fas fa-hotel"></i>
                        <p>Hotel</p>
                    </div>
                    <div class="links page_navs" onclick="showPage('print_tag.php')">
                        <i class="fas fa-print"></i>
                        <p>Print tag</p>
                    </div>
                    <div class="links page_navs" onclick="showPage('certificate.php')">
                        <i class="fas fa-certificate"></i>
                        <p>certificate</p>
                    </div>
                </div>
                <?php include "dashboard.php"?>
                <!--show RECEIPT -->
                <div id="paid_receipt" class="displays management">
                    <div class="info"></div>
                    
                    <?php 
                        $payment_status = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id AND payment_status = 2 AND passport != ''");
                        $payment_status->bindvalue("user_id", $user->user_id);
                        $payment_status->execute();
                        if(!$payment_status->rowCount() > 0){
                            echo "";
                        }else{
                    ?>
                    <p class="reg_success">
                        You have successfully registered for the PSN 2023 National conference.<br> Kindly present the slip below at the point of physical registration
                    </p>
                    <h2>Registration Slip</h2>
                    <section class="clearanceSlip">
                        <?php if ($user->fellow == 1){?>
                        <div class="logos" style="background:blue">
                        <?php }else{?>
                        <div class="logos">
                        <?php }?>
                            <img src="../images/conference_logo.png" alt="PSN logo">
                            <P>Jewel city 2023</P>
                        </div>
                        <div class="slip">
                            <div class="slip_back">
                                <img src="../images/psn_logo2.png" alt="psn">
                            </div>
                            <div class="details">
                                <div class="logos_passport">
                                    <div class="passports">
                                        <img src="<?php echo '../passports/'.$user->passport;?>" alt="member passport">
                                    </div>
                                </div>
                                <p class="full_name"><?php echo $user->first_name . " " .$user->last_name?></p>
                               <!-- fellow -->
                                <?php
                                    if($user->fellow == 1){
                                ?>
                                <p id="fellow" style="background:blue; border-radius:5px; color:#fff;">FPSN</p>
                                <?php }else{?>
                                <p style="background:rgb(10, 63, 10); color:#fff;border-radius:5px;"><?php echo $user->user_type?></p>
                                <?php }?>
                                <p><span>Registration ID: </span><br><?php echo $user->reg_number?></p>
                                <div class="qr_code">
                                <?php
                                    
                                    echo "<img src='../controller/barcode.php?codetype=code128&size=200&text=".$user->barcode."'/>";
                                    
                                ?>
                                <h4 class="barcode"><?php echo $user->barcode?></h4>
                                </div>
                            </div>
                        </div>
                        
                        
                    </section>
                    <div class="download">
                        <button id="print" onclick="printTag('<?php echo $user->pcn_number?>')">Print slip <i class="fas fa-print"></i></button>
                    </div>
                    <?php }?>
                </div>
                
                
                
                
                
                
        
                
                
                

            </section>
            </div>
        </div>
        
            
        
        
            
        
    </main>
    <script src="../jquery.js"></script>
    <script src="../script.js"></script>
    <script>
        //hide success or error message after 2 seconds
        setTimeout(function(){
            $(".success_message").hide();
            $(".error_message").hide();
            $(".error_note").hide();
            $("#reg_success").hide();
        }, 3000);
    </script>
    
</body>
</html>

<?php 
    endforeach;
    }else{
        header("Location: registration.php");
    }
?>