<?php
    include "../controller/connections.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PSN is the National Regulatory Body for the PHarmaceutical Society of NIgeria">
    <meta name="keywords" content="PSN, psn, Pharmacist, pharmacist association, pharmacist society, Nigeria">
    <title>PSN National Conference| Exhibitor Registration</title>
    <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../fontawesome-free-5.15.1-web/css/all.css">
    <link rel="icon" type="image/png" href="../images/psn_logo2.png" size="32X32">
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
    
    <main>
            <section class="reg_log">
                
                <div class="login_page" id="reg_form">
                    <h1>
                        <a href="../index.php">
                            <img src="../images/psn_logo2.png" alt="logo">
                        </a>
                    </h1>
                    
                    <h2>Welcome Exhibitor!</h2>
                    <p>Register your company</p>
                    <?php
                        if(isset($_SESSION['success'])){
                            echo "<p class='success'>" . $_SESSION['success']. "</p>";
                            unset($_SESSION['success']);
                        }
                    ?>
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "<p class='error'>" . $_SESSION['error']. "</p>";
                            unset($_SESSION['error']);
                        }
                    ?>
                    <form action="../controller/reg_exhibitors.php" method="POST" enctype="multipart/form-data" id="exh_register" class="form">
                    <div class="input">
                        <div class="data">
                            <input type="text" name="company_name" id="company_name" placeholder="Company Name" required>

                        </div>
                        <div class="data">
                            <input type="text" name="company_address" id="company_address" placeholder="Your company Address" required>

                        </div>
                    </div>
                    <div class="input">
                        <div class="data">
                            <input type="tel" name="company_phone" id="company_phone" placeholder="Company's Phone number" required onchange="checkNumber(this.value)">
                        </div>
                        <div class="data">
                            <input type="text" name="contact_person" id="contact_person" placeholder="Contact person Full Name" required>
                        </div>
                    </div>
                    <div class="input">
                        <div class="data">
                            <select name="designation" id="designation" required>
                                <option value="" selected>Designation</option>
                                <option value="Director">Director</option>
                                <option value="General manager">General Manager</option>
                                <option value="Sales manager">Sales manager</option>
                                <option value="Sales Rep">Sales Rep</option>
                                
                            </select>
                        </div>
                        <div class="data">
                            <input type="tel" name="contact_phone" id="contact_phone" placeholder="Contact Mobile Number" required>
                        </div>
                    </div>
                    <div class="input">
                        
                        <div class="data">
                            <input type="email" name="company_email" id="company_email" placeholder="Company's Email address" required>
                        </div>
                        <div class="data">
                            <!-- <label for="staff_number">Number of staffs</label> -->
                            <input type="number" name="staff_number" id="staff_number" required placeholder="How many staffs wll be present?">
                        </div>
                    </div>
                    <div class="input">
                        <div class="data">
                            <!-- <label for="portal_manager">Online store Manager</label> -->
                            <input type="text" name="portal_manager" id="portal_manager" required placeholder="Online store manager">
                        </div>
                        <div class="data">
                            <!-- <label for="manager_contact">Store manager contact</label> -->
                            <input type="tel" name="manager_contact" id="manager_contact" required placeholder="Online store contact number">
                        </div>
                    </div>
                    <div class="input">
                        <div class="data">
                            <label for="company_logo">Upload Company Logo</label>
                            <input type="file" name="company_logo" id="company_logo" required>
                        </div>
                        <div class="data">
                            <label for="company_password">Create Password</label>
                            <input type="password" name="company_password" id="company_password" required placeholder="*******">
                        </div>
                    </div>
                    
                        <div class="data" id="reg_btn">
                            <button type="submit" name="register_exhibitor" id="register_exhibitor">Register <i class="fas fa-paper-plane"></i></button>
                            
                        </div>
                        
                    
                    
                </form>
                    <div class="signup_option">
                        <p>Already have an account? <a href="exhibitor_login.php">Login now</a></p>
                    </div>
                    <div id="foot">
                        <p >&copy;<?php echo Date("Y");?> PSN. All Rights Reserved.</p>

                    </div>

                </div>
                <div class="adds" id="reg_adds">
                    <h2>PSN</h2>
                    <h2><?php echo date ("Y");?></h2>
                    <h2>National Conference</h2>
                </div>
            </section>
    </main>
    <script src="../jquery.js"></script>
    <script src="../script.js"></script>
</body>
</html>