<?php
    include "connections.php";

    $delegate = htmlspecialchars(stripslashes($_POST['delegate']));
    $satisfaction = htmlspecialchars(stripslashes($_POST['satisfaction']));
    $elements = htmlspecialchars(stripslashes($_POST['elements']));
    $registration = htmlspecialchars(stripslashes($_POST['registration']));
    $topics = htmlspecialchars(stripslashes($_POST['topics']));
    $speakers = htmlspecialchars(stripslashes($_POST['speakers']));

    $submit_survey = $connectdb->prepare("INSERT INTO surveys (delegate, satisfaction, elements, registration, topics, speakers) VALUES (:delegate, :satisfaction, :elements, :registration, :topics, :speakers)");
    $submit_survey->bindValue("delegate", $delegate);
    $submit_survey->bindValue("satisfaction", $satisfaction);
    $submit_survey->bindValue("elements", $elements);
    $submit_survey->bindValue("registration", $registration);
    $submit_survey->bindValue("topics", $topics);
    $submit_survey->bindValue("speakers", $speakers);
    $submit_survey->execute();

    if($submit_survey){
        $update_status = $connectdb->prepare("UPDATE users SET attendance = 2 WHERE user_id = :user_id");
        $update_status->bindValue("user_id", $delegate);
        $update_status->execute();

        if($update_status){
            echo "<div class='success'><p><i class='fas fa-thumbs-up'></i> Survey submitted successfully!</p></div>";
        }
    }else{
        echo "<div class='error'><p>Error! No submit</p></div>";
    }
   

?>