<?php
    include "../controller/connections.php";
?>
<div class="all_sponsors">
    <marquee behavior="smooth" direction="left">
        <!-- <span><strong>Sponsors:</strong> </span> -->
        <?php
            $get_sponsors = $connectdb->prepare("SELECT * FROM sponsors ORDER BY category LIMIT 5");
            $get_sponsors->execute();
            $rows = $get_sponsors->fetchAll();
            foreach($rows as $row){
        ?>
            <img src="<?php echo '../sponsors/'.$row->logo?>" alt="<?php echo $row->sponsor_name?>" title="<?php echo $row->sponsor_name?>">
        <?php }?>
    </marquee>
</div>