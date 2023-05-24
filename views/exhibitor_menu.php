<aside class="main_menu" id="mobile_log">
    <div class="login">
        <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
        <div class="login_option">
            <div>
                <button id="loginBtn"><a href="../controller/exh_logout.php">Log out</a></button>
                
            </div>
        </div>
    </div>
    <nav>
        <h3><a href="exhibitors.php" title="Home"><i class="fas fa-home"></i> Dashboard</a></h3>
        <ul>        
            <li><a href="javascript:void(0);" id="addCat" title="View floor plans" class="page_navs" onclick="showPage('floor_plans.php')"><i class="fas fa-building"></i> Floor plans</a></li>
            <li><a href="javascript:void(0);" id="addCat" title="Upload payment" class="page_navs" onclick="showPage('exhibitor_payment.php')"><i class="fas fa-money-check-alt"></i> Upload payment</a></li>
            <li><a href="javascript:void(0);" id="updateUser" class="page_navs" onclick="showPage('update_exhibitor.php')"><i class="fas fa-user"></i> Update profile</a></li>
            <li><a href="javascript:void(0);" id="addHot" title="Add items" class="page_navs" data-page="add_items"><i class="fas fa-paper-plane"></i>Add Items </a></li>
            <li><a href="javascript:void(0);" id="itemsBtn" class="page_navs" data-page="itemList"><i class="fas fa-gift"></i> Item list</a></li>
            <li><a href="javascript:void(0);" id="updateUser" class="page_navs" data-page="orderList"><i class="fas fa-shopping-cart"></i> Manage Orders </a></li>
            <li><a href="javascript:void(0);" id="updateUser" class="page_navs" data-page="deliveryList"><i class="fas fa-coins"></i> Delivery Reports </a></li>
            
        </ul>
    </nav>
</aside>
<aside class="mobile_menu" id="mobile_log">
    <div class="login">
        <button id="loginDiv"><i class="far fa-user"></i> Account <i class="fas fa-chevron-down"></i></button>
        <div class="login_option">
            <div>
                <button id="loginBtn"><a href="../controller/logout.php">Log out</a></button>
                
            </div>
        </div>
    </div>
    <nav>
        <h3><a href="user.php" title="Home"><i class="fas fa-home"></i> Dashboard</a></h3>
        <ul>        
        <li><a href="javascript:void(0);" id="addCat" title="View floor plans" class="page_navs" data-page="floor_plans"><i class="fas fa-building"></i> Floor plans</a></li>
            <li><a href="javascript:void(0);" id="addCat" title="Upload payment" class="page_navs" data-page="addCategories"><i class="fas fa-money-check-alt"></i> Upload payment</a></li>
            <li><a href="javascript:void(0);" id="addHot" title="Add items" class="page_navs" data-page="add_items"><i class="fas fa-paper-plane"></i>Add Items </a></li>
            
            <li><a href="javascript:void(0);" id="itemsBtn" class="page_navs" data-page="itemList"><i class="fas fa-gift"></i> Item list</a></li>
            <li><a href="javascript:void(0);" id="updateUser" class="page_navs" data-page="orderList"><i class="fas fa-shopping-cart"></i> Manage Orders </a></li>
            <li><a href="javascript:void(0);" id="updateUser" class="page_navs" data-page="deliveryList"><i class="fas fa-coins"></i> Delivery Reports </a></li>
            <li><a href="javascript:void(0);" id="updateUser" class="page_navs" data-page="profile"><i class="fas fa-user"></i> Update profile</a></li>
        </ul>
    </nav>
</aside>