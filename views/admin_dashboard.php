<div id="dashboard">
                    
    <div class="cards" id="card5">
        <a href="javascript:void(0)" class="page_navs" onclick="showPage('guest_list.php')">
            <div class="infos">
                <i class="fas fa-users"></i>
                <p> Registered Guests </p>

                <p>
                    <?php
                        $show_members = $connectdb->prepare("SELECT * FROM users WHERE user_type = 'guest'");
                        $show_members->execute();
                        echo $show_members->rowCount();
                    ?>
                </p>
            </div>
        </a>
    </div> 
    <div class="cards" id="card4">
        <a href="javascript:void(0)" onclick="showPage('delegates.php')" data-page="addRestaurant" class="page_navs">
            <div class="infos">
                <i class="fas fa-user-graduate"></i>
                <p> Registered Delegates </p>
                <p>
                    <?php
                        $approved = $connectdb->prepare("SELECT * FROM users WHERE user_type = 'delegate'");
                        
                        $approved->execute();
                        
                        echo $approved->rowCount()

                        
                    ?>
                </p>
            </div>
        </a>
    </div>
    <div class="cards" id="card3">
        <a class="page_navs" data-page="Registered exhbitors" href="javascript:void(0)" onclick="showPage('exhibitors_list.php')">
            <div class="infos">
                <i class="fas fa-store"></i>
            <p> Exhibitors </p>

                <p>
                    <?php
                        $get_booth = $connectdb->prepare("SELECT * FROM exhibitors");
                        
                        $get_booth->execute();
                        
                        echo $get_booth->rowCount()

                        
                    ?>
                </p>
            </div>
        </a>
    </div>
    <div class="cards" id="card0">
        <a href="javascript:void(0)" class="page_navs" data-page="hotel_request">
            <div class="infos">
                <i class="fas fa-hotel"></i>
            <p> Accomodation </p>

                <p>
                    <?php
                        $get_hotel = $connectdb->prepare("SELECT * FROM hotels");
                        
                        $get_hotel->execute();
                        
                        echo $get_hotel->rowCount()

                        
                    ?>
                </p>
            </div>
        </a>
    </div>
    
    
</div>
<hr class='dashboard_hr'>