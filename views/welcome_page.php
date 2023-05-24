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
    <meta name="description" content="Welcome to Jewel 2023 PSN National Conference">
    <meta name="keywords" content="PSN, psn, Pharmacist, pharmaceutical society of Nigeria">
    <title>Jewel city 2023| <?php echo $user->first_name . " " . $user->last_name;?></title>
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
        <section class="top_head" id="topHeader">
            <div class="social_media">
                <p>
                    <span>Call us </span>(+234) 123 456 78
                </p>
                <p>
                    info@psnconference.org
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
        </section>
        <header>
            <h1 class="logo">
                <a href="../index.php" title="ACPN">
                    <img src="../images/conference_logo.png" alt="PSN Logo" class="img-fluid">
                </a>
            </h1>
            <!-- <div class="search">
                <form class="form-inline" action="views/search_result.php" method="POST">
                    <input type="search" name="search_items" placeholder="search members, reg_number, search phone number">
                    <button type="submit" name="search" class="main_searchbtn">Search <i class="fas fa-search"></i></button>
                    <button type="submit" name="search" class="mobilesearchbtn" ><i class="fas fa-search"></i></button>
                </form>
                
            </div> -->
            <h2 id="desktop_h2">Jewel city 2023 Registration</h2>
            <h2 id="mobile_h2">Jewel city 2023</h2>
            <!-- 
            <div class="other_menu">
                <a href="#" title="Our Gallery">Gallery</a>
            </div> -->
            <!-- <div class="login">
                <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
                <div class="login_option">
                    <div>
                        <button id="loginBtn"><a href="search_result.php">Download Slip</a></button>
                        <h3>OR</h3>
                        <a href="registration.php" id="signupBtn">Member Registration</a>
                    </div>
                </div>
            </div> -->
            <div class="cart">
                <a href="javascript:void(0);" title="Registered members"><i class="fas fa-users"></i> Notifications
                    <span id="cart_value">
                     <i class="fas fa-bell"></i></span></a>
            </div>
            <!-- <div class="menu_icon">
                <a href="javascript:void(0)"><i class="fas fa-bars"></i></a>
            </div> -->
        </header>
        
        
        <!-- <hr> -->
        <P id="p" style="text-align:center;"> User details</P>
        <div class="details_form">
            
            <!-- for paid members -->
            <?php
                if(isset($_SESSION['reg_success'])){
                    echo "<p id='reg_success'>" . $_SESSION['reg_success'] . "</p><br><p id='reg_success'>Kindly confirm your details below and upload your passport.</p>";
            ?>
                <div class="management displays" style="display:block" id="profile">
                    <div class="info"></div>
                    <div class="add_user_form">
                        <h3 style="text-align:center">Update profile</h3>
                        <form method="POST"  id="addCatForm" action="../controller/update_profile.php" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $user->user_id?>" name="user_id">
                            <div class="inputs">
                                
                                <div class="data">
                                    <h2>PCN: <?php echo $user->pcn_number;?></h2>
                                </div>
                            </div>
                            <div class="inputs">
                                <div class="data">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" value="<?php echo $user->first_name;?>" id="first_name" required>
                                </div>
                                <div class="data">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" value="<?php echo $user->last_name;?>" id="last_name" required>
                                </div>
                            </div>
                            <div class="inputs">
                                <div class="data">
                                    <label for="whatsapp">whatsapp No.</label>
                                    <input type="tel" name="whatsapp" value="<?php echo $user->whatsapp;?>" id="whatsapp" required>
                                </div>
                                <div class="data">
                                    <label for="other_number">Other Number</label>
                                    <input type="tel" name="other_number" value="<?php echo $user->other_number;?>" id="other_number">
                                </div>
                            </div>
                            <div class="inputs">
                                <div class="data">
                                    <label for="user_email">Email address</label>
                                    <input type="email" name="user_email" value="<?php echo $user->user_email;?>" id="user_email" required>
                                </div>
                                <div class="data">
                                    <label for="res_state">State of practice</label>
                                    <select name="res_state" id="res_state" required>
                                        <option value="<?php echo $user->res_state?>"selected><?php echo $user->res_state?></option>
                                        <option value="Abia">Abia</option>
                                        <option value="Adamawa">Adamawa</option>
                                        <option value="Akwa-ibom">Akwa-ibom</option>
                                        <option value="Anambra">Anambra</option>
                                        <option value="Bauchi">Bauchi</option>
                                        <option value="Bayelsa">Bayelsa</option>
                                        <option value="Benue">Benue</option>
                                        <option value="Borno">Borno</option>
                                        <option value="Cross rivers">Cross Rivers</option>
                                        <option value="Delta">Delta</option>
                                        <option value="Ebonyi">Ebonyi</option>
                                        <option value="Edo">Edo</option>
                                        <option value="Ekiti">Ekiti</option>
                                        <option value="Enugu">Enugu</option>
                                        <option value="Gombe">Gombe</option>
                                        
                                        <option value="Imo">Imo</option>
                                        <option value="Jigawa">Jigawa</option>
                                        <option value="Kaduna">Kaduna</option>
                                        <option value="Kano">Kano</option>
                                        <option value="Katsina">Katsina</option>
                                        <option value="Kebbi">Kebbi</option>
                                        <option value="Kogi">Kogi</option>
                                        <option value="Kwarra">Kwarra</option>
                                        <option value="Lagos">Lagos</option>
                                        <option value="Nasarawa">Nassarawa</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Ogun">Ogun</option>
                                        <option value="Ondo">Ondo</option>
                                        <option value="Osun">Osun</option>
                                        <option value="Oyo">Oyo</option>
                                        <option value="Plateau">Plateau</option>
                                        <option value="Rivers">Rivers</option>
                                        <option value="Sokoto">Sokoto</option>
                                        <option value="Taraba">Taraba</option>
                                        <option value="Yobe">Yobe</option>
                                        <option value="Zamfara">Zamfara</option>
                                        <option value="Abuja">Abuja</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="inputs">
                                <div class="data">
                                    <div class="user_passport">
                                        <img src="<?php echo "../passports/".$user->passport;?>" alt="Passport">
                                    </div>
                                    <label for="passport">Upload passport</label>
                                    <input type="file" name="passport" id="passport" required>
                                </div>
                                <div class="data">
                                    <label for="other_number">Gender</label>
                                    <select name="gender" id="gender" required>
                                        <option value="<?php echo $user->gender;?>" selected><?php echo $user->gender;?></option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                    
                                </div>
                                
                            </div>
                            <div class="inputs">
                                <div class="data">
                                    <label for="tech_group">Technical Group</label>
                                    <select name="tech_group" id="tech_group" required>
                                    <option value=""selected>Select technical group</option>
                                    <option value="PSN-YPG">PSN-YPG</option>
                                    <option value="ACPN">ACPN</option>
                                    <option value="NAPA">NAPA</option>
                                    <option value="NAIP">NAIP</option>
                                    <option value="ALPS">ALPS</option>
                                    <option value="CPAN">CPAN</option>
                                    <option value="AHAPN">AHAPN</option>
                                    </select>
                                </div>
                                <div class="update_btn data">
                                    <button type="submit" id="update" name="update">Update Profile <i class="fas fa-user"></i></button>
                                </div>
                            </div>
                            
                            
                                <!-- <div class="inputs">
                                    <div class="proceed">
                                        <a href="user.php" title="Proceed to dashboard">Proceed <i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div> -->
                                
                            
                        </form>
                    </div>  
                </div>
            <?php
                    // unset($_SESSION['reg_success']);
                    // unset($_SESSION['upload']);
                }
            ?>
            
            
           
        </div>
        
            
        
    </main>
    <script src="../jquery.js"></script>
    <script src="../script.js"></script>
</body>
</html>

<?php 
    endforeach;
    }else{
        header("Location: registration.php");
    }
?>