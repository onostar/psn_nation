<?php
    include "../controller/connections.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to Jewel 2023 PSN National Conference">
    <meta name="keywords" content="PSN, psn, Pharmacist, pharmaceutical society of Nigeria">
    <title>Jewel city 2023 conference| Recover password</title>
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../fontawesome-free-5.15.1-web/css/all.css">
    <link rel="icon" type="image/png" href="../images/conference_logo.png" size="32X32">
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
    <main>
            <section class="reg_log">
                
                <div class="login_page">
                    <h1>
                        <a href="../index.php">
                            <img src="../images/conference_logo.png" alt="logo">
                        </a>
                    </h1>
                    
                    <h2>Welcome Guests!</h2>
                    <p>Recover your password</p>
                    <?php
                        if(isset($_SESSION['success'])){
                            echo "<p class='success' style='color:green'>" . $_SESSION['success']. "</p>";
                            unset($_SESSION['success']);
                        }
                    ?>
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "<p class='error'>" . $_SESSION['error']. "</p>";
                            unset($_SESSION['error']);
                        }
                    ?>
                    <form action="../controller/forget_password.php" method="POST">
                        <div class="data">
                            <label for="username">Enter registered email address</label>
                            <input type="email" name="email" id="email" placeholder="mail@example.com" required>
                        </div>
                        
                        <div class="data">
                            <button type="submit" id="recover" name="recover">Get password <i class="fas fa-key"></i></button>

                        </div>
                        
                    </form>
                    <div class="signup_option">
                        <p>Don't have an account yet? <a href="guest_registration.php">Signup now</a></p>
                    </div>
                    <div id="foot">
                        <p >&copy;<?php echo Date("Y");?> PSN. All Rights Reserved.</p>

                    </div>

                </div>
                <div class="adds">
                    <h2>PSN</h2>
                    <h2>jEWEL CITY <?php echo Date("Y");?></h2>
                    <h2>National Conference</h2>
                </div>
            </section>
    </main>
    <script src="../jquery.js"></script>
    <script src="../script.js"></script>
</body>
</html>