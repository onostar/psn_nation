<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
    
        $user_details = $connectdb->prepare("SELECT * FROM exhibitors WHERE company_email = :company_email");
        $user_details->bindvalue("company_email", $username);
        $user_details->execute();

        $users = $user_details->fetchAll();
        foreach($users as $user):
?>
<?php $my_company = $user->exhibitor_id;
    $_SESSION['my_company'] = $my_company;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PSN is the National Regulatory Body for the PHarmaceutical Society of NIgeria">
    <meta name="keywords" content="PSN, psn, Pharmacist, pharmacist association, pharmacist society, Nigeria">
    <title>PSN Conference| <?php echo $user->company_name;?></title>
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../fontawesome-free-5.15.1-web/css/all.css">
    <link rel="icon" type="image/png" href="../images/psn_logo2.png" size="32X32">
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
    <!-- <div class="loader">
        <img src="images/psn_logo.jpg" alt="PSN">
        <h2>Welcome to PSN national Conference registration</h2>
    </div> -->
    <main>
    <!-- <section class="top_head" id="topHeader">
            <div class="social_media">
                <p>
                    <span>Call us </span>(+234) 123 456 78
                </p>
                <p>
                    info@acpn.com
                </p>
            </div>
            <div class="contact_phone">
                <ul>
                    <li><a href="javascript:void(0);" class="showRequest">Schedule Appointment</a></li>
                    <li><a href="plans.html">Find plans</a></li>
                    <li><a href="javascript:void(0);">Pay Bills</a></li>
                    <li><a href="javascript:void(0);">Covid-19 Updates</a></li>
                </ul>
            </div>
        </section> -->
        <header>
            <h1 class="logo">
                <a href="exhibitors.php" title="ACPN">
                    <img src="../images/psn_logo2.png" alt="PSN Logo" class="img-fluid">
                </a>
            </h1>
            <h2 id="desktop_h2"><?php echo $user->company_name?></h2>
            <h2 id="mobile_h2">PSN</h2>
            <div class="other_menu">
                <a href="#" title="User type">Exhibitor</a>
            </div>
            <div class="login">
                <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
                <div class="login_option">
                    <div>
                        <button id="loginBtn"><a href="../controller/exh_logout.php">Log out</a></button>
                    </div>    
                </div>
            </div>
            <div class="cart" id="user_data">
                <a href="javascript:void(0);" title="<?php echo "Hello. " .$user->contact_person;?>" id="user_name">
                     <span><?php echo $user->contact_person;?></span> 
                    <div class="user_img">
                        <img src="<?php echo "../logos/".$user->company_logo;?>" alt="Logo">
                    </div>
                </a>
            </div>
            <div class="menu_icon">
                <a href="javascript:void(0)"><i class="fas fa-bars"></i></a>
            </div>
        </header>
    
        
        <div class="admin_main">
            <?php include "exhibitor_menu.php"?>
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
                    if(isset($_SESSION['reg_success'])){
                        echo "<p class='reg_success'>" . $_SESSION['reg_success'] . "</p>";
                        unset($_SESSION['reg_success']);
                    }
                ?>
                
                <div class="booth">
                    <?php
                        if($user->payment_status == 2):
                    ?>
                    <p><i class="fas fa-store"></i> Booth: <?php 
                        $get_booth = $connectdb->prepare("SELECT * FROM booths WHERE booth_id = :booth_id");
                        $get_booth->bindvalue("booth_id", $user->booth);
                        $get_booth->execute();
                        $boothsss = $get_booth->fetchAll();
                        foreach($boothsss as $boothss){
                            echo $boothss->hall." (".$boothss->booth.")";
                        }
                        
                    ?></p>
                    <?php endif?>
                </div>
                <?php include "exhibitor_dashboard.php"?>
                <!--show tag -->
                <div id="paid_receipt" class="displays management">
                    <div class="info"></div>
                    
                    <?php 
                        $payment_status = $connectdb->prepare("SELECT * FROM exhibitors WHERE exhibitor_id = :exhibitor_id AND payment_status = 2");
                        $payment_status->bindvalue("exhibitor_id", $user->exhibitor_id);
                        $payment_status->execute();
                        if(!$payment_status->rowCount() > 0){
                            echo "";
                        }else{
                    ?>
                    <p class="reg_success">
                        You have successfully acquired a booth for the PSN <?php echo date("Y")?> conference.<br> Kindly print your tag below;
                    </p>
                    <h2>Exhibitor Tag</h2>
                    <section class="clearanceSlip">
            
                        <div class="logos">
                            <img src="../images/psn_logo2.png" alt="Logo logo">
                            <P>Jewell city 2023</P>
                        </div>
                        <div class="slip">
                            <div class="slip_back">
                                <img src="../images/psn_logo2.png" alt="psn">
                            </div>
                            <div class="details">
                                <div class="logos_passport">
                                    <div class="passports">
                                        <img src="<?php echo '../logos/'.$user->company_logo;?>" alt="Company logo">
                                    </div>
                                </div>
                                <h3 class="full_name">EXHIBITOR</h3>
                                <p><?php echo $user->company_name?></p>
                                <p><span>ID: </span><?php echo $user->reg_number?></p>
                                <div class="qr_code">
                                <img src="../images/qr_code.png" alt="qr_code">
                                </div>
                            </div>
                        </div>
                        
                        
                    </section>
                    <div class="download">
                        <button id="print" onclick="printExhTag(<?php echo $user->exhibitor_id?>)">Print Tag <i class="fas fa-print"></i></button>
                    </div>
                    <?php }?>
                </div>
                
                
            </section>

        </div>
        
            
        
        
            
        
    </main>
    <script src="../jquery.js"></script>
    <script src="../script.js"></script>
    <script>
        setTimeout(function(){
            $(".success").hide();
            // $(".reg_success").hide();
            $(".success_message").hide();
            $(".error_message").hide();
        }, 2000);
    </script>
</body>
</html>

<?php 
    endforeach;
    }else{
        header("Location: exhibitor_login.php");
    }
?>