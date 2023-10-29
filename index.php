<?php
    session_start();
    include "controller/connections.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to Jewel 2023 PSN National Conference">
    <meta name="keywords" content="PSN, psn, Pharmacist, pharmaceutical society of Nigeria">
    <title>Jewel city 2023 Conference Portal</title>
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
    <link rel="icon" type="image/png" href="images/conference_logo.png" size="32X32">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<!-- <div class="loader">
        <img src="images/psn_logo2.png" alt="logo">
        <h1>Welcome to Eko Akete 2022</h1>

    </div> -->
    <div class="main">
    <section class="top_head" id="topHeader">
        <marquee behavior="" direction="left">
            <p><strong>Arrivals:</strong> 30th Ocotober, 2023 <strong>Departures:</strong> 4th November, 2023</p>
            <p><strong>Venue:</strong> International Conference Centre, Gombe</p>
            <p><strong>Theme:</strong> Pharmacy Practice: A pivot to Universal Health Coverage in Nigeria</p>
        </marquee>
    </section>
    <section id="banner">
        <header id="mainHeader" class="main_header">
            <h1>
                <a href="index.php">
                    <img src="images/conference_logo.png" alt="logo">
                </a>
            </h1>
            <nav id="navigation">
                <ul>
                    <!-- <li><a href="" title="who we are">Who we are</a></li> -->
                   
                    <!-- <li id="estore"><a href="store/index.php" target="_blank"title="Order for items"><i class="fas fa-store"></i>E-store</a></li> -->
                    <!-- <li><a href="contact.html" title="Contact us">Get in touch</a></li> -->
                    <!-- <li id="exhi"><a href="views/exhibitor_login.php" title="Exhibitor login portal">Exhibitors Login <i class="fas fa-sign-in-alt"></i></a></li> -->
                    <!-- <li><a href="blog.html" title="Job recruitment">Our Blog</a></li> -->
                    <li id="exhi"><a href="views/registration.php" title="Members Portal">Delegate Login <i class="fas fa-sign-in-alt"></i></a></li>
                    <li id="login"><a href="guests/guest_login.php" title="Guests portal">Guests Login <i class="fas fa-sign-in-alt"></i></a></li>
                    <li style="background:var(--otherColor); padding:15px;"><a href="views/onsite_registration.php" title="Onsite registration">Onsite Registration <i class="fas fa-sign-in-alt"></i></a></li>
                    <!-- <li><a href="views/late_registration.php" title="Late registration for Delegate">Delegate Registration <i class="fas fa-sign-in-alt"></i></a></li>
                    <li><a href="guests/late_registration.php" title="Late registration for Guests">Guests Registration <i class="fas fa-sign-in-alt"></i></a></li> -->
                </ul>
            </nav>
            <div class="menu-icon" onclick="displayMenu()"><a href="javascript:void(0);"><i class="fas fa-bars"></i></a></div>
        </header>
        <div id="slider">
            <div class="slides">
                <div class="slide">
                    <div class="banner_img">
                        <img src="images/psn_poster.jpg" alt="banner">
                    </div>
                    <div class="taglines">
                        <div class="taglines_note">
                            <!-- <h2>PSN Jewel city 2023 Conference</h2>
                            <p>Kicking off 30th October to November 4th 2023, at the Gombe International Conference Centre, Gombe</p> -->
                            <div class="btns">
                                <!-- <a href="javascript:void(0)" class="showRequest">Schedule an Appointment Now</a> -->
                                <a href="guests/guest_login.php" title="Guests portal" style="background:var(--primaryColor)">Guests Login <i class="fas fa-sign-in-alt"></i></a>
                                <a href="views/registration.php" style="background:var(--otherColor); padding:15px;">Delegates <i class="fas fa-sign-in-alt"></i></a>
                                <a href="views/onsite_registration.php">Onsite Registration <i class="fas fa-sign-in-alt"></i></a>
                            </div>
                        </div>
                        <div class="taglines_mission">
                            <h3>This event is sponsored by</h3>
                            <div class="vismis_slide">
                                <?php
                                    $get_sponsors = $connectdb->prepare("SELECT * FROM sponsors ORDER BY category LIMIT 5");
                                    $get_sponsors->execute();
                                    $rows = $get_sponsors->fetchAll();
                                    foreach($rows as $row){
                                ?>
                                <div class="datas vissions">
                                    <figure class="icon">
                                        <img src="<?php echo 'sponsors/'.$row->logo?>" alt="<?php echo $row->sponsor_name?>" title="<?php echo $row->sponsor_name?>">
                                        <figcaption>
                                            <?php echo $row->sponsor_name?>
                                        </figcaption>
                                    </figure>
                                    
                                </div>
                                <?php }?>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                
            </div>
            
        </div>
        <!-- <div class="client_assess">
            <a href="#reqMaster">Client Assessment Form</a><i class="fas fa-plus"></i>
        </div> -->
    </section>
</div>
<!-- display login information -->
    <div class="flash_info" id="flashInfo">
        <div class="flash_main">
            <h2>Login Instruction</h2>
            <div class="flash_img">
                <img src="images/conference_logo.png" alt="logo">
            </div>
            <p><strong style="color:red">Please Note!</strong> All Registered Pharmacists in Nigeria should click on the <strong>"Delegate"</strong> button to login or register.<br> While pharmacists in diaspora, accompanied persons, NYSC, Interns, etc should click on the <strong>"Guest"</strong> button to login or register</p>
            <p id="last_child">We look forward to seeing you at Jewel city 2023!</p>
            <button onclick="closeInfo()">Close <i class="fas fa-window-close"></i></button>
        </div>
    </div>
    <script src="jquery.js"></script>
    <script src="script.js"></script>
</body>
</html>