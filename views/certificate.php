<!--PRINT CERTIFICATE -->
<div id="certificate" class="displays management">
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

    <div class="info"></div>
    <?php 
        $attendance_status = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id AND attendance != 0");
        $attendance_status->bindvalue("user_id", $user->user_id);
        $attendance_status->execute();
        if(!$attendance_status->rowCount() > 0){
            echo "<h2>Certificate of participation</h2>
            <p class='enrolled'>You did not attend this conference!</p>";
        }else{
            if($user->attendance == 1){
            
    ?>
        <!-- survey form -->
        <h2 style="color:var(--otherColor)">Kindly fill the survey form below to generate your certificate</h2>
        <div class="add_user_form" style="border-radius:20px;  overflow:hidden">
            <h3>Conference survey form</h3>
            <section id="addCatForm">
                <!-- <div class="inputs">
                    <div class="data">
                        <input type="hidden" name="delegate" id="delegate" value="<?php echo $user->user_id?>">
                        <label for="satisfaction">What is your level of satisfaction with this event?</label>
                        <select name="satisfaction" id="satisfaction">
                            <option value="" selected>Select a response</option>
                            <option value="Satisfied">Satisfied</option>
                            <option value="Not Satisfied">Not Satisfied</option>
                            <option value="Can do better">Can do better</option>
                        </select>
                    </div>
                    <div class="data">
                        <label for="elements">What elements of the event did you like the most?</label>
                        <textarea name="elements" id="elements" cols="30" rows="5" placeholder="Your response"></textarea>
                    </div>
                </div>
                <div class="inputs">
                    <div class="data">
                        <label for="registration">Did you have any issues registering for or attending this conference?</label>
                        <textarea name="registration" id="registration" cols="30" rows="5" placeholder="Your response"></textarea>
                    </div>
                    <div class="data">
                        <label for="topics">What topics would you like to see more of at our next conference?</label>
                        <textarea name="topics" id="topics" cols="30" rows="5" placeholder="Your response"></textarea>
                    </div>
                </div> -->
                <div class="inputs">
                    <!-- <div class="data">
                        <label for="speakers">How satisfied where you with the speakers and sessions at the events?</label>
                        <select name="speakers" id="speakers">
                            <option value="" selected>Select a response</option>
                            <option value="Satisfied">Satisfied</option>
                            <option value="Not Satisfied">Not Satisfied</option>
                            <option value="Can do better">Can do better</option>
                        </select>
                    </div> -->
                    <div class="data" style="width:100%">
                        <p style="text-align:center">KIndly click on the link below to submit a survey form and generate your certficate</p>
                        <div class="survey_button">
                            <button id="submit_survey" name="submit_survey" onclick="submitSurvey('<?php echo $user->user_id?>')">Survey Form <i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
<?php }else{?>
    <h2>Certificate of Attendance</h2>
    <p class="reg_success">
        Congratulations on attending the Jewell City 2023 PSN National conference.<br> You can print your certifcate of attendance below
    </p>
    <section id="attendanceSlip">

        <div class="slip">
            <div class="slip_back">
                <img src="../images/psn_logo2.png" alt="psn">
            </div>
            <div class="all_details">
                <div class="top_details">
                    <figure clsas="first_child">
                        <img src="<?php echo '../passports/'.$user->passport?>" alt="ACPN">
                    <figcaption>Motto</figcaption>
                    </figure>
                    <div class="cert">
                        <h3>CERTIFICATE OF ATTENDANCE</h3>
                        <p>This certificate is presented to</p>
                    </div>
                    <figure>
                        <img src="../images/conference_logo.png" alt="psn">
                        <figcaption>Motto</figcaption>
                    </figure>
                    
                </div>
                <div class="details">
                    <h2 class="full_name"><?php echo $user->last_name . " " .$user->first_name?></h2>
                    <hr>
                    <p>For Attending the <span>Annual National Conference</span> of the Pharmaceutical Society of Nigeria (PSN) <span>"JEWEL CITY" <?php echo date("Y")?></p>
                    <div class="dates">
                        <h4>Oct 30<sup>th</sup> to Nov 4<sup>th</sup>, 2023</h4>
                    </div>
                    <h4 class="theme">Theme:</h4>
                    <p class="theme_note">"Pharmacy Practice: A pivot to Universal Health Coverage in Nigeria"</p>
                </div>
                <div class="stamp">
                        <i class="fas fa-certificate"></i>
                    </div>
                <div class="signatories">
                    <div class="sign">
                        <img src="../images/president_sign.png">
                        <p>Prof. <span>Cyril Odianose Usifoh,</span>FPSN</p>
                        <p class="title">President</p>
                    </div>
                    
                    <div class="sign">
                        <img src="../images/secretary_sign.jpg">
                        <p>Pharm. <span>Gbenga Falabi,</span>FPSN</p>
                        <p class="title">National Secretary</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="yelow">
            <p></p>
        </div>
        <p></p>
    </section>
    <div class="download">
        <button id="print" onclick="printCertificate('<?php echo $user->user_id?>')">Print <i class="fas fa-print"></i></button>
    </div>
    <?php } }?>

<?php endforeach; }?>
</div>
