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
        <!-- all members -->
        <?php if($last_name == "Admin"){?>
        <div class="allResults displays" id="allMembers">
            <!-- <hr> -->
            <div class="options">
                <div class="search">
                    <input type="search" id="searchMenus" placeholder="Enter keyword" onkeyup="searchData(this.value)">
                </div>
                <button id="download_members" class="downloadBtn" onclick="convertToExcel('result_table', 'Registered members for Jewell 2023')">Export to Excel <i class="fas fa-file-excel"></i></button>
            </div>
            <h3 style="text-align:center; padding:4px;text-transform:uppercase">Registered Members for Jewel city 2023</h3>
            <table id="result_table" class="searchTable">
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Full Name</td>
                        <!-- <td>PCN Number</td> -->
                        <td>Phone Number</td>
                        <td>type</td>
                        <td>State</td>
                        <td>Status</td>
                        <td>Registration ID</td>
                        <!-- <td>Accomodation</td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $get_all = $connectdb->prepare("SELECT * FROM users WHERE last_name != 'Admin' AND last_name != 'User' ORDER BY reg_date");
                        $get_all->execute();
                        $n = 1;
                        
                        $alls = $get_all->fetchAll();

                        foreach($alls as $all):
                    ?>
                    <tr>
                        <td><button><a href="javascript:void(0)" onclick="showPage('clearance.php?user=<?php echo $all->user_id;?>')" title="View details"><?php echo $n?></a></button></td>
                        <td><?php echo ucwords($all->first_name . " " . $all->last_name);?></td>
                        <!-- <td style="color:var(--otherColor)"><?php echo $all->pcn_number;?></td> -->
                        <td style="color:var(--primaryColor)"><?php echo $all->whatsapp;?></td>
                        <td style="color:green"><?php echo $all->user_type;?></td>
                        <td style="color:green"><?php echo $all->res_state?></td>
                        <td style="text-align:center">
                            <?php 
                                if($all->payment_status == 2){
                                    echo "<p style='color:green'>A</p>";
                                }else{
                                    echo "<p style='color:red'>NA</p>";
                                }
                            ?>
                        </td>
                        <td><?php echo $all->reg_number;?></td>
                        <!-- <td><?php
                            $hotel_status = $connectdb->prepare("SELECT * FROM request_hotel WHERE requester = :requester");
                        $hotel_status->bindvalue("requester", $all->user_id);
                        $hotel_status->execute();
                        if(!$hotel_status->rowCount() > 0){
                            echo "No request";
                        }else{
                            $requests = $hotel_status->fetchAll();
                            foreach($requests as $request){
                                if($request->request_status == 1){
                                    echo $request->hotel." <i class='fas fa-check' style='color:green'></i>";
                                }else{
                                    echo $request->hotel." <i class='fas fa-spinner' style='color:red'></i>";
                                }
                            }
                        }
                        ?>
                        </td> -->
                        
                    </tr>
                    <?php $n++; endforeach;
                    
                    ?>
                </tbody>
            </table>
            <?php
                if(!$get_all->rowCount() > 0){
                    echo "<p class='no_result'>'No result found!'</p>";
                }
            ?>
    </div>
        <?php }?>
            
            </section>
            </div>
        </div>
    </main>
        
            
        
    </main>
    <script src="../jquery.js"></script>
    <script src="../jquery.table2excel.js"></script>
    <script src="../script.js"></script>
</body>
</html>

<?php 
    }else{
        header("Location: registration.php");
    }
?>