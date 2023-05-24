<?php
    session_start();
    require "../controller/connections.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PSN is the National Regulatory Body for the PHarmaceutical Society of NIgeria">
    <meta name="keywords" content="PSN, psn, Pharmacist, pharmacist association, pharmacist society, Nigeria">
    <title>PSN Conference| Attendance</title>
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../fontawesome-free-5.15.1-web/css/all.css">
    <link rel="icon" type="image/png" href="../images/psn_logo2.png" size="32X32">
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
    
    <section class="top_head" id="topHeader">
        <div class="social_media">
            <p>
                <span>Call us </span>(+234) 123 456 78
            </p>
            <p>
                info@psn.com
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
            <a href="user_attendance.php" title="PSN COnference attendance">
                <img src="../images/psn_logo2.png" alt="PSN Logo" class="img-fluid">
            </a>
        </h1>
        <div class="search">
            <form class="form-inline" method="POST">
                <input type="search" name="search_items" placeholder="search members, reg_number, search phone number">
                <button type="submit" name="searchBtn" class="main_searchbtn" id="searchBtn">Search <i class="fas fa-search"></i></button>
                <button type="submit" name="search_items" class="mobilesearchbtn" id="searchBtn"><i class="fas fa-search"></i></button>
            </form>
            
        </div>
        <div class="other_menu">
            <a href="admin.php" title="Our Gallery">Audit</a>
        </div>
        <div class="login">
            <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
            <div class="login_option">
                <div>
                    <button id="loginBtn"><a href="../controller/logout.php">Log out</a></button>
                    
                </div>
            </div>
        </div>
        <div class="cart">
            <a href="javascript:void(0);" title="Registered members"><i class="fas fa-users"></i> Registered 
                <span id="cart_value"><?php
                $get_members = $connectdb->prepare("SELECT * FROM users WHERE last_name != 'Admin' AND last_name != 'User'");
                $get_members->execute();
                echo $get_members->rowCount();
                ?> </span></a>
        </div>
        <div class="menu_icon">
            <a href="javascript:void(0)"><i class="fas fa-bars"></i></a>
        </div>
    </header>

    <main>
        <div class="success">
            <?php
                if(isset($_SESSION['success'])){
                    echo "<p>" .$_SESSION['success']. "</p>";
                    unset($_SESSION['success']);
                }
            ?>
        </div>
        <!-- search results -->
                

        <!-- attendance list -->
        <div id="attendance" class="displays allResults">
            <h2>Attendance List for PSN Conference  2023</h2>
                <hr>
                <div class="search">
                    <input type="search" id="searchAttendance" placeholder="Enter keyword">
                </div>
                <table id="attendance_table">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Full Name</td>
                            <td>PCN Number</td>
                            <td>State</td>
                            <td>Phone Numbers</td>
                            <td>Reg_Number</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                                $get_all = $connectdb->prepare("SELECT * FROM users WHERE last_name != 'Admin' AND last_name != 'User' AND payment_status = 2 ORDER BY reg_date");
                                $get_all->execute();
                                $n = 1;
                                
                                $alls = $get_all->fetchAll();

                                foreach($alls as $all):
                            ?>
                            <tr>
                                <td><button><a href="javascript:void(0)" onclick="viewSlip('<?php echo $all->user_id;?>')" title="View slip"><?php echo $n?></a></button></td>
                                <td><?php echo $all->first_name . " " . $all->last_name;?></td>
                                <td><?php echo $all->pcn_number;?></td>
                                <td><?php echo $all->res_state?></td>
                                <td><?php echo $all->whatsapp.", ".$all->other_number;?></td>
                                <td><?php echo $all->reg_number;?></td>
                                <td>
                                    <?php
                                        if($all->attendance == 0){
                                    ?>
                                    <button title="Mark Present" onclick="markPresent('<?php echo $all->pcn_number?>')"class="action accept"><i class="fas fa-check"></i></button>
                                    <button title="Mark absent"onclick="markAbsent('<?php echo $all->pcn_number?>')"class="action decline"><i class="fas fa-ban"></i></button>
                                    <?php
                                        }else{
                                            echo "<span style='color:green';>Present <i class='fas fa-check'></i></span>";   
                                        }
                                    ?>
                                </td>
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