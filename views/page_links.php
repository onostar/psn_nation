<div class="page_links">
        <?php
            if($get_all->rowCount() > 0){
                echo "<p><strong>Pages ".$page_number." of ".$total_pages."</strong></p>";
        ?>
        <ul class="pages">
            <?php
                if($page_number > 1){
                
            ?>
                <li><a href="javascript:void(0)" onclick="showPage('reg_statistics.php?page=1')"title="Go to first page"><< First page</a></li>
                <li><a href="javascript:void(0)" onclick="showPage('reg_statistics.php?page=<?php echo $prev_page?>')"title="Go to previous page">< Previous</a></li>
            <?php
                }
                if($page_number < $total_pages){
                
            ?>
                <li><a href="javascript:void(0)" onclick="showPage('reg_statistics.php?page=<?php echo $next_page?>')" title="Go to next page">Next ></a></li>
                <li><a href="javascript:void(0)" onclick="showPage('reg_statistics.php?page=<?php echo $total_pages?>')" title="Go to last page">Last Page >></a></li>
            <?php }?>
        </ul>
        <?php }?>
    </div>