
<div class="login">
        <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
        <div class="login_option">
            <div>
                <button id="loginBtn"><a href="../controller/guest_logout.php">Log out</a></button>
                
            </div>
        </div>
    </div>
    <nav>
        <h3><a href="guests.php" title="Home"><i class="fas fa-home"></i> Dashboard</a></h3>
        <ul>
            <!-- <?php
                $pay_status = $connectdb->prepare("SELECT payment_status FROM users WHERE user_email = :user_email");
                $pay_status->bindvalue("user_email", $user->user_email);
                $pay_status->execute();
                $payStat = $pay_status->fetch();
                if($payStat->payment_status == 0 || $payStat->payment_status == 1){
                    
            ?>
            <li><a href="javascript:void(0);" id="addCat" title="Upload payment" class="page_navs" onclick="showPage('upload_payment.php')"><i class="fas fa-paper-plane"></i>Upload payment</a></li>
            <?php }?> -->
            <?php
                $pay = $connectdb->prepare("SELECT payment_status FROM users WHERE user_email = :user_email AND payment_status = 2");
                $pay->bindvalue("user_email", $user->user_email);
                $pay->execute();
                if($pay->rowCount() > 0){
                    
            ?>
            <li><a href="javascript:void(0);" id="addMenu" title="Request accomodation" class="page_navs" onclick="showPage('../views/accomodations.php')"><i class="fas fa-hotel"></i> View Accomodation</a></li>
            <li><a href="javascript:void(0);" id="addMenu" title="print tag" class="page_navs" onclick="showPage('print_tag.php')"><i class="fas fa-print"></i> Print tag</a></li>
            <?php }else{?>
                <li><a href="guests.php" id="addMenu" title="print tag" class="page_navs"><i class="fas fa-coins"></i> Make payment</a></li>
            <?php }?>
            <?php
                $get_request = $connectdb->prepare("SELECT * FROM request_hotel WHERE requester = :requester");
                $get_request->bindvalue("requester", $user->reg_number);
                $get_request->execute();
                if($get_request->rowCount() > 0){
                    $details = $get_request->fetchAll();
                    foreach($details as $detail){
                        if($detail->request_status == 0){

            ?>
            <li><a href="javascript:void(0);" id="addMenu" title="Add hotel payment" class="page_navs" data-page="confirm_hotel" onclick="showPage('upload_accomod_slip.php')"><i class="fas fa-receipt"></i> Upload accomodation receipt</a></li>
            <?php } } }?>
           <!--  <?php
                $get_bulk = $connectdb->prepare("SELECT * FROM request_hotel WHERE requester = :requester AND request_status = 1");
                $get_bulk->bindvalue("requester", $user->reg_number);
                $get_bulk->execute();
                if($get_bulk->rowCount() > 0){

            ?>
            <li><a href="javascript:void(0);" id="addMenu" title="Make request for other members" class="page_navs" data-page="bulk_request" onclick="showPage('bulk_request.php')"><i class="fas fa-users"></i> Bulk request</a></li>
            
            <li><a href="javascript:void(0);" id="addMenu" title="Add bulk payment" class="page_navs" data-page="confirm_bulk" onclick="showPage('bulk_upload.php')"><i class="fas fa-receipt"></i> Upload bulk receipt</a></li>
            <?php }?> -->
            <!-- <li><a href="javascript:void(0);" id="addStore" class="page_navs" data-page="printTag" onclick="showPage('print_tag.php')"><i class="fas fa-print"></i> Print Tag</a></li> -->
            <!-- <li><a href="javascript:void(0);" id="addEve" title="view & attend events" class="page_navs" data-page="events" onclick="showPage('events.php')"><i class="fas fa-hotel"></i> Events</a></li> -->
            <li><a href="javascript:void(0);" id="addStore" class="page_navs" data-page="certificate" onclick="showPage('certificate.php')"><i class="fas fa-certificate"></i> Conference Certificate</a></li>
            <li><a href="javascript:void(0);" id="downloads" class="page_navs" data-page="conference_downloads"><i class="fas fa-download"></i> Conference Downloads</a></li>
            <li><a href="javascript:void(0);" id="gallery" class="page_navs" data-page="conference_gallerys"><i class="fas fa-photo-video"></i> Conference Gallery</a></li>
            <li><a href="javascript:void(0);" id="updateUser" class="page_navs" data-page="profile" onclick="showPage('update_profile.php')"><i class="fas fa-user"></i> Update Profile</a></li>
        </ul>
    </nav>