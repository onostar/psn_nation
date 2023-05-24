<?php
    require "../controller/connections.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    
    $user_details = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
    $user_details->bindvalue("user_id", $id);
    $user_details->execute();

    $users = $user_details->fetchAll();
    foreach($users as $user):
    
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,600&family=Poppins:wght@200;300;400;500;700&family=Roboto:wght@300;400;500;700;900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Coda+Caption:wght@800&display=swap');
#attendanceSlip{
    width:100vw;
    height:100vh;
    background:#fff;
    margin:0;
    box-shadow: 2px 2px 2px var(--secondaryColor);
}
.top_details{
    display:flex;
    justify-content: space-between;
    align-items:center;
    text-align: center;
    width:100%;
    padding:10px 40px;
}
.top_details figure{
    width:100px;
    height:100px;
    overflow: hidden;
}
.top_details figure:nth-child(1){
    border-radius:50%;
}
.top_details figure img{
    width:100%;
    height:100%;
}
.cert h3{
    font-size:1.8rem;
}
.cert p{
    color:rgb(238, 123, 29);
    font-size:1.2rem;
    font-family:"Coda caption";
}
.details{
    margin:20px 0;
}
.details h2{
    font-size:1.6rem;
    margin:0;
    text-transform: uppercase;
}
.details hr{
    width:80%;
    margin:0 auto;
}
.details p{
    width:80%;
    margin:0 auto;
    border:none;
}
.details{
    padding:10px;
    display:flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align:Center;
}
.details p{
    /* border:1px solid rgba(167, 164, 164, .5); */
    padding:10px;
    color:rgba(66, 65, 65, .9);
    text-transform: uppercase;
    margin:5px 0;
    font-size:1.1rem;
}
.details p span{
    font-weight: bolder;
    
}
.details .full_name{
    font-weight:bold;
}
.dates{
    margin:10px 0 0;
    font-size:1rem;
}
.theme{
    color:red;
}
.theme_note{
    color:rgb(19, 73, 19)!important;
    font-weight: bold;
}
.stamp{
    margin:0;
    text-align:center;
}
.signatories{
    display:flex;
    align-items: center;
    justify-content: space-around;
    text-align: center;
    margin-bottom: 30px;
    padding:20px;
}

.stamp i{
    font-size:5rem;
    color:red;
    padding:10px
}
.slip{
    position:relative;
    width:100%;
    height:100%;
}
.slip_back{
    position:absolute;
    top:0;
    left:0;
    height:100%;
    width:100%;
    opacity: .1;
    text-align: center;
}
.slip_back img{
    width:100%;
    height:100%;
    object-fit: cover;
}
.passports{
    margin:10px;
    height:200px;
    width:200px;
    overflow: hidden;
    border-radius:50%;
    box-shadow: 2px 2px 2px 2px #c4c4c4;
}
.passports img{
    width:100%;
    height:100%;
}

.heading{
    text-align:center;
}

</style>
<head>
<link rel="stylesheet" href="../fontawesome-free-5.15.1-web/css/all.css">
</head>
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
                    <h3>CERTIFICATE OF PARTICIPATION</h3>
                    <p>This is to certify that</p>
                </div>
                <figure>
                    <img src="../images/psn_logo2.png" alt="psn">
                    <figcaption>Motto</figcaption>
                </figure>
                
            </div>
            <div class="details">
                <h2 class="full_name"><?php echo $user->last_name . " " .$user->first_name?></h2>
                <hr>
                <p>Attended the <span>41st Annual National Conference</span> of the Pharmaceutical Society of Nigeria (PSN) <span>"JEWELL CITY" 2023</p>
                <div class="dates">
                    <h4>July 24<sup>th</sup> to 29<sup>th</sup>, 2022</h4>
                </div>
                <h4 class="theme">Theme:</h4>
                <p class="theme_note">"Benefits of community pharmacist to the modern day Nigerian society"</p>
            </div>
            <div class="stamp">
                    <i class="fas fa-certificate"></i>
                </div>
            <div class="signatories">
                <div class="sign">
                    <p>Pharm. <span>jjjjjj iijiiiii,</span>FPSN, FNAPharm, FPC</p>
                    <p class="title">President</p>
                </div>
                
                <div class="sign">
                    <p>Pharm. <span>jhghgah kjkj kjkj,</span>FPSN</p>
                    <p class="title">National Secretary</p>
                </div>
            </div>
        </div>
    </div>
    
    
</section>
<?php endforeach; }?>
<script>
    window.print();
    window.close();
</script>