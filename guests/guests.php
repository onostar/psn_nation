<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
    
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE user_email = :user_email");
    $user_details->bindvalue("user_email", $username);
    $user_details->execute();

    $users = $user_details->fetchAll();
    foreach($users as $user):
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to Jewel city 2023 PSN National Conference">
    <meta name="keywords" content="PSN, psn, Pharmacist, pharmaceutical society of Nigeria">
    <title>Jewel city 2023 | <?php echo $user->last_name . " " . $user->first_name;?></title>
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
                <a href="guests.php" title="Jewel city 2023">
                    <img src="../images/conference_logo.png" alt="PSN Logo" class="img-fluid">
                </a>
            </h1>
            <h2 id="desktop_h2">Jewel city 2023</h2>
            <h2 id="mobile_h2">Jewel city 2023</h2>
            <div class="other_menu">
                <a href="#" title="User type"><?php echo $user->user_type?></a>
            </div>
            <div class="login">
                <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
                <div class="login_option">
                    <div>
                        <button id="loginBtn"><a href="../controller/guest_logout.php">Log out</a></button>
                    </div>    
                </div>
            </div>
            <div class="cart" id="user_data">
                <a href="javascript:void(0);" title="<?php if($user->gender == "Male"){
                    echo "Mr. " .$user->last_name;
                }else{
                    echo "Ms. " .$user->last_name;
                }
                ?>" id="user_name">
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

                <?php include "guest_menu.php"?>
            </aside>
            <div class="contents">
                <?php include "../views/loading.php"?>;
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
                <?php
                    if(isset($_SESSION['reg_success'])){
                        echo "<p id='reg_success'>" . $_SESSION['reg_success'] . "</p>";
                        unset($_SESSION['reg_success']);
                    }
                ?>
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
                        You have successfully registered for the PSN 2023 National conference.<br> Kindly present the slip below at the point of physical validation
                    </p>
                    <h2>Registration Slip</h2>
                    <section class="clearanceSlip">
                        <?php
                            // change background color base on guest type
                            //get guest type
                            $find_type = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
                            $find_type->bindvalue("guest_type_id", $user->guest_type);
                            $find_type->execute();
                            $type = $find_type->fetch();
                            if($type->guest_type == "Student" || $type->guest_type == "Intern" || $type->guest_type == "NYSC"){
                        ?>
                        <div class="logos" style="background:yellow;color:#000">
                        <?php }elseif($type->guest_type == "Diaspora"){?>
                        <div class="logos" style="background:gold">
                        <?php }else{?>
                        <div class="logos" style="background:purple">
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
                                <p class="full_name"><?php echo $user->last_name . " " .$user->first_name?></p>
                                <?php
                                    
                                    if($type->guest_type != "Diaspora"){
                                        if($type->guest_type == "student" || $type->guest_type == "intern" || $type->guest_type == "NYSC"){
                                    
                                ?>
                                <p id="fellow" style="background:yellow;color:#000"><?php echo $type->guest_type?></p>
                                <?php }else{?>
                                <p id="fellow" style="background:purple"><?php echo $type->guest_type?></p>
                                <?php }}?>
                                <p><span>Registration ID:</span><br><?php echo $user->reg_number?></p>
                                <div class="qr_code">
                                <?php
                                    /* echo "<img src='../controller/barcode.php?codetype=code128&size=200&text=".$user->barcode."'/>"; */
                                    require '../vendor/autoload.php';

                    // This will output the barcode as HTML output to display in the browser
                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    echo $generator->getBarcode($user->barcode, $generator::TYPE_CODE_128);
                                ?>
                                <!-- <h4 class="barcode"><?php echo $user->barcode?></h4> -->
                                </div>
                                <!-- guest type -->
                                <div class="tag_sponsor">
                                    <img src="../images/mega_logo.jpg" alt="mega" class="mega">

                                </div>
                                
                                
                            </div>
                        </div>
                        
                        
                    </section>
                    <div class="download">
                        <button id="print" onclick="printGuestTag('<?php echo $user->user_id?>')">Print slip <i class="fas fa-print"></i></button>
                    </div>
                    <?php }?>
                </div>
                
                
                
                
                
                
        
                
                
                

            </section>
            </div>
        </div>
        
            
        
        
            
        
    </main>
    <script src="../jquery.js"></script>
    <script src="../script.js"></script>
    <script src="https://dropin.vpay.africa/dropin/v1/initialise.js"></script>
    <script>
        //hide success or error message after 2 seconds
        setTimeout(function(){
            $(".success_message").hide();
            $(".error_message").hide();
            $(".error_note").hide();
            $("#reg_success").hide();
        }, 3000);
    </script>
    <!-- check payment status and make payment -->
    <?php
        if($user->payment_status == 0){
            //display payment summary
            //get guest type
            $find_types = $connectdb->prepare("SELECT guest_type FROM guest_types WHERE guest_type_id = :guest_type_id");
            $find_types->bindvalue("guest_type_id", $user->guest_type);
            $find_types->execute();
            $gtype = $find_types->fetch();
    ?>
    <div id="payment_summary">
        <div class="payment_summary">
            <div class="sum_title">
                <img src="../images/conference_logo.png" alt="Logo">
                <h3>Jewel city 2023 Registration Summary</h3>
            </div>
            <h2>Transaction details</h2>
            <table id="payment_table">
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Item</td>
                        <td>Description</td>
                        <td>Amount</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center; color:red">1</td>
                        <td>Conference fee</td>
                        <td>PSN jewel city registration fee for <?php echo $gtype->guest_type?> participants</td>
                        <td><?php echo "₦".number_format($user->fee, 2);?></td>
                            
                    </tr>
                    <tr>
                        <td style="text-align:center; color:red">2</td>
                        <td>Charges</td>
                        <td>Switch fee + other charges (3%)</td>
                        <td><?php 
                            $charges = $user->fee * 0.03;
                            echo "₦".number_format($charges, 2);
                        ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="font-weight:bold">Total amount due:</td>
                        <td style="color:green; font-weight:bold">
                            <?php
                                //get total
                                $total_due = $charges + $user->fee;
                                echo "₦".number_format($total_due, 2);
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="proceed_btn">
                <button onclick="onsiteVpay('<?php echo $user->fee?>', '<?php echo $user->user_id?>', '<?php echo $user->user_email?>')">Proceed to payment <i class="fas fa-angle-double-right"></i></button>
            </div>
        </div>
    </div>
    <?php
           /*  echo "<script>
                vpay('$user->fee', '$user->user_id', '$user->user_email');
            </script>"; */
        }
    ?>
    
</body>
</html>

<?php 
    endforeach;
    }else{
        header("Location: guest_login.php");
    }
?>