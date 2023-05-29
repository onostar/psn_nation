<?php
    include "../controller/connections.php";
?>
<!-- events -->
<div class="displays" id="surveys">
    
    <div class="event_result">
        <div class="allResults" style="width:90%;">
        <h3 style="text-align:center; font-size:1.1rem">View submitted surveys</h3>
            <table>
                <thead>
                    <tr style="background:var(--moreColor)">
                        <td>S/N</td>
                        <td>Name</td>
                        <td>User type</td>
                        <td>Date</td>
                        <!-- <td></td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 1;
                        $get_survey = $connectdb->prepare("SELECT * FROM surveys ORDER BY post_date");
                        $get_survey->execute();
                        $rows = $get_survey->fetchAll();
                        foreach($rows as $row){
                            //get name
                            $get_name = $connectdb->prepare("SELECT * FROM users WHERE user_id = :user_id");
                            $get_name->bindvalue("user_id", $row->delegate);
                            $get_name->execute();
                            $details = $get_name->fetchAll();
                            foreach($details as $detail){
                                $full_name = $detail->last_name . " " .$detail->last_name;
                                $type = $detail->user_type;
                            }
                    ?>
                    <tr>
                    <td><?php echo $n?></td>
                    <td><?php echo $full_name?></td>
                    <td><?php echo $type?></td>
                    <td><?php echo date("jS M, Y", strtotime($row->post_date))?></td>
                    <!-- <td>
                        <a style="background:var(--primaryColor); color:#fff; padding:5px 10px;"href="javascript:void(0);" title="View attendance" onclick="showPage('view_survey.php?survey=<?php echo $row->survey_id?>')"><i class="fas fa-eye"></i> View</a>
                    </td> -->
                    <tr>
                    <?php $n++; }?>
                </tbody>
                
            </table>
            <?php
                    if(!$get_survey->rowCount() > 0){
                        echo "<p style='text-align:center; padding:10px;background:#fff;'>No event</p>";
                    }
                ?>
        </div>
    </div>
</div>