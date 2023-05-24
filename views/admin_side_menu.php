<aside class="main_menu" id="mobile_log">
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
    <nav>
        <!-- <?php echo $last_name?> -->
        <h3><a href="admin.php" title="Home"><i class="fas fa-home"></i> Main menu</a></h3>
        <ul>
            <?php if($last_name == "Admin"){?>
            <li><a href="javascript:void(0);" id="regStat" title="Registration statistics" class="page_navs" onclick="showPage('reg_statistics.php')"><i class="fas fa-users"></i> Registered</a></li> 
            <?php }?>   
            <li><a href="javascript:void(0);" id="addEvent" title="Add events" class="page_navs" data-page="events" onclick="showPage('add_events.php')"><i class="fas fa-hotel"></i> Manage Events</a></li>
            <?php if($last_name == "Admin"){?>
            <li><a href="javascript:void(0);" id="addStore" class="page_navs" data-page="addRestaurant" onclick="showPage('delegates.php')"><i class="fas fa-user-tie"></i> Delegates</a></li>
            <?php }?>
            <li><a href="javascript:void(0)" title="Validate user" onclick="showPage('onsite_validation.php')"><i class="fas fa-users"></i> Onsite validation</a></li>
            <!-- <li><a href="javascript:void(0)" title="Register user" onclick="showPage('onsite_registration.php')"><i class="fas fa-user"></i> Onsite Registration</a></li> -->
            <?php if($last_name == "Admin"){?>
            <li><a href="javascript:void(0)" title="Conference attendance list" class="page_navs" data-page="attendance_list" onclick="showPage('attendance_list.php')"><i class="fas fa-user-graduate"></i> Attendance List</a></li>
            <li><a href="javascript:void(0);" class="addMenu allMenus" title="manage accomodations"><span><i class="fas fa-hotel"></i> Accomodation </span><span><i class="fas fa-chevron-down"></i></span></a>
                <ul class="nav1Menu">
                    <!-- <li><a href="javascript:void(0);" id="addMenu" title="View accomodation requests" class="page_navs" data-page="hotel_request" onclick="showPage('confirm_accomod.php')"><i class="fas fa-paper-plane"></i> Accomodation requests</a></li>
                    <li><a href="javascript:void(0);" id="addMenu" title="Approve bulk requests" class="page_navs" data-page="bulk_request" onclick="showPage('confirm_bulk.php')"><i class="fas fa-users"></i> Confirm Bulk requests</a></li> -->
                    <li><a href="javascript:void(0);" id="addHot" title="Add hotels" class="page_navs" data-page="add_hotel" onclick="showPage('add_hotels.php')"><i class="fas fa-hotel"></i> Add Hotels</a></li>
                    <!-- <li><a href="javascript:void(0);" id="addrm" title="Add rooms to hotel" class="page_navs" data-page="add_rooms" onclick="showPage('add_rooms.php')"><i class="fas fa-hotel"></i> Add Rooms & prices</a></li> -->
                    <li><a href="javascript:void(0);" id="acomls" title="Add rooms to hotel" class="page_navs" data-page="accom_list" onclick="showPage('accomodations.php')"><i class="fas fa-book"></i> Accomodation list</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="addExh allMenus" title="manage accomodations"><span><i class="fas fa-cart-arrow-down"></i> Exhibition </span><span class="second_icon"><i class="fas fa-chevron-down" style="box-shadow:none;"></i></span></a>
                <ul class="nav2Menu">
                    <li><a href="javascript:void(0);" id="addexhi" title="Add Exhibitors" class="page_navs" onclick="showPage('add_exhibitors.php')"><i class="fas fa-user-tie"></i> Add exhibitors</a></li>
                    <li><a href="javascript:void(0);" id="xhi" title="View Exhibitors" class="page_navs" data-page="exhibitors" onclick="showPage('exhibitors_list.php')"><i class="fas fa-users"></i> Exhibitors list</a></li>
                    <!-- <li><a href="javascript:void(0);" id="confBooth" title="COnfirm exhibitors payment" class="page_navs" data-page="booth_payments" onclick="showPage('confirm_exhibitor.php')"><i class="fas fa-coins"></i> Confirm payment</a></li> -->
                    <li><a href="javascript:void(0);" id="addexhi" title="Add halls/ categories" class="page_navs" data-page="booth_categories" onclick="showPage('add_hall.php')"><i class="fas fa-store"></i> Booth categories/Hall</a></li>
                    <li><a href="javascript:void(0);" id="addexhi" title="Add booths" class="page_navs" data-page="add_booths" onclick="showPage('add_booth.php')"><i class="fas fa-store"></i> Add Booths</a></li>
                    <li><a href="javascript:void(0);" id="addexhi" title="Booth list" class="page_navs" data-page="booths" onclick="showPage('booth_list.php')"><i class="fas fa-store"></i> Booth List</a></li>
                    <!-- <li><a href="javascript:void(0);" id="addexhi" title="Add Exhibition items" class="page_navs" data-page="add_items"> <i class="fas fa-shopping-cart"></i> Add items</a></li>
                    <li><a href="javascript:void(0);" id="addFeat" title="Add Exhibition items" class="page_navs" data-page="featured_items"> <i class="fas fa-star"></i> Featured items</a></li>
                    <li><a href="javascript:void(0);" id="addexhi" title="Exhibition items" class="page_navs" data-page="itemList"><i class="fas fa-cart-arrow-down"></i> Item List</a></li>
                    <li><a href="javascript:void(0);" id="updateUser" class="page_navs" data-page="orderList"><i class="fas fa-shopping-cart"></i> Manage Orders</a></li>
                    <li><a href="javascript:void(0);" id="updateUser" class="page_navs" data-page="deliveryList"><i class="fas fa-coins"></i> Delivery Reports</a></li> -->
                </ul>
            </li>
            <li style="margin:0 0 100px 0!important"><a href="javascript:void(0);" class="guestMenu allMenus" title="manage accomodations"><span><i class="fas fa-users"></i> Guests </span><span><i class="fas fa-chevron-down"></i></span></a>
                <ul class="nav3Menu">
                    <li><a href="javascript:void(0)" onclick="showPage('manage_guests.php')" title="Manage guest types"><i class="fas fa-user-tie"></i> Manage guests</a></li>
                    <li><a href="javascript:void(0)" onclick="showPage('guest_list.php')" title="List of guests"><i class="fas fa-users"></i> Guest List</a></li>
                    <!-- <li><a href="javascript:void(0)" onclick="showPage('confirm_guest.php')" title="Confirm guests payment"><i class="fas fa-users"></i> Confirm Guest payment</a></li> -->
                </ul>
            </li>
            <!-- <li><a href="../controller/get_paid_members.php" id="upLoadMem" class="page_navs" data-page="connect to pharmagateway"><i class="fas fa-users"></i> get paid members</a></li> -->
            <?php }?>
        </ul>
    </nav>
</aside>
