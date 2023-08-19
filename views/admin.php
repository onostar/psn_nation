<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $user_details = $connectdb->prepare("SELECT * FROM users WHERE pcn_number = :pcn_number");
        $user_details->bindValue("pcn_number", $username);
        $user_details->execute();

        $users = $user_details->fetchAll();
        foreach($users as $user){
            $last_name = $user->last_name;
        }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to Jewel city 2023 PSN National Conference">
    <meta name="keywords" content="PSN, psn, Pharmacist, pharmaceutical society of Nigeria">
    <title>Jewel city 2023 | Admin</title>
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
    <!-- <section class="top_head" id="topHeader">
            <div class="social_media">
                <p>
                    <span>Call usq5 </span>(+234) 123 456 78
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
                <a href="admin.php" title="Jewel city 2023">
                    <img src="../images/conference_logo.png" alt="PSN Logo" class="img-fluid">
                </a>
            </h1>
            <div class="search">
                <form class="form-inline" method="POST">
                    <input type="search" name="search_items" placeholder="search members, reg_number, search phone number" id="search_items">
                    <button type="submit" name="searchBtn" id="searchBtn" class="main_searchbtn">Search <i class="fas fa-search"></i></button>
                    <button type="submit" name="searchBtn" id="searchBtn" class="mobilesearchbtn" ><i class="fas fa-search"></i></button>
                </form>
                
            </div>
            <div class="other_menu">
                <a href="#" title="Our Gallery">Admin</a>
            </div>
            <div class="login">
                <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
                <div class="login_option">
                    <div>
                        <button id="loginBtn"><a href="../controller/logout.php">Log out</a></button>
                        <!-- <h3>OR</h3>
                        <a href="registration.php" id="signupBtn">Member Registration</a> -->
                    </div>
                </div>
            </div>
            <div class="cart">
                <a href="javascript:void(0);" title="Registered members" data-page="allMembers" class="page_navs"><i class="fas fa-users"></i> <span id="reg_text">Registered </span>
                    <span id="cart_value"><?php
                    $get_members = $connectdb->prepare("SELECT * FROM users WHERE last_name != 'Admin' AND last_name != 'User'");
                    $get_members->execute();
                    echo $get_members->rowCount();
                    ?> </span></a>
            </div>
            <div class="menu_icon" id="menu_icon">
                <a href="javascript:void(0)"><i class="fas fa-bars"></i></a>
            </div>
        </header>

    
        
        <div class="admin_main">
            <?php include "admin_side_menu.php"?>
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
                <h4 style="color:var(--primaryColor);width:90%;margin:0 auto;"><i class="fas fa-home"></i> Dashboard</h4>
                <?php include "admin_dashboard.php" ?>
                
                <!-- search results -->
                <!-- <div class="allResults">
                    
                </div> -->
        

        <div class="charts">
            <div id="chart1" class="chart">
                <!-- chart for user types -->
                <?php
                    $get_types = $connectdb->prepare("SELECT COUNT(res_state) as total, res_state FROM users WHERE user_type != '' GROUP BY res_state");
                    $get_types->execute();
                    $rows = $get_types->fetchAll();
                    foreach($rows as $row){
                        $usertype[] = $row->res_state;
                        $totaltype[] = $row->total;
                    }
                ?>
                <h3>State Registration statistics</h3>
                <canvas id="chartjs_bar1"></canvas>
            </div>
            <div id="chart2" class="chart">
                <!-- chart for technical group -->
                <?php
                    $get_types = $connectdb->prepare("SELECT COUNT(tech_group) as groups, tech_group FROM users WHERE user_type != '' GROUP BY tech_group");
                    $get_types->execute();
                    $rows = $get_types->fetchAll();
                    foreach($rows as $row){
                        $techgroup[] = $row->tech_group;
                        $totalgroup[] = $row->groups;
                    }
                ?>
                <h3 style="background:var(--moreColor)">Technical group statistics</h3>
                <canvas id="chartjs_bar2"></canvas>
            </div>
            
        </div>
            
            </section>
            </div>
        </div>
    
    </main>
        
            
        
    </main>
    <script src="../jquery.js"></script>
    <script src="../jquery.table2excel.js"></script>
    <script src="../Chart.min.js"></script>
    <script src="../script.js"></script>
    <script type="text/javascript">
      var ctx2 = document.getElementById("chartjs_bar1").getContext('2d');
                var myChart = new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        labels:<?php echo json_encode($usertype); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969aa",
                                "#ff407b",
                                "#331523",
                                "#ffc750",
                                "#03454b",
                                "#0b4466e6",
                                "#008000",
                                "#d2691e",
                                "#a52a2a",
                                "#00eeff",
                                "#2f00ff",
                                "#ff00aa",
                                "#ff0000",
                                "#1f1d1d",
                                "#380f0f",
                                "#e4671f",
                                "#1fe46b",
                                "#008000",
                                "#d2691e",
                                "#a52a2a",
                                "#00eeff",
                                "#2f00ff",
                                "#ff00aa",
                                "#ff0000",
                                "#1f1d1d",
                                "#380f0f",
                                "#e4671f",
                                "#1fe46b",
                                "#c5f174",
                                "#d874f1",
                                "#f8fc0d",
                                "#35d3be"
                            ],
                            data:<?php echo json_encode($totaltype); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
      var ctx = document.getElementById("chartjs_bar2").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($techgroup); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969aa",
                                "#ff407b",
                                "#331523",
                                "#ffc750"
                            ],
                            data:<?php echo json_encode($totalgroup); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: true,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>
</body>
</html>

<?php 
    }else{
        header("Location: registration.php");
    }
?>