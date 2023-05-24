<?php
    include "connections.php";
    session_start();
    $_SESSION['error'] = "";
    $_SESSION['success'] = "";

    if(isset($_POST["upload"]))
    {
     $file = $_FILES["upLoadPaid"]["tmp_name"];
     $file_open = fopen($file, "r");
     while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
     {
      $name = $csv[0];
      $pcn = $csv[1];
    //   $country = $csv[2];
      $upload_users = $connectdb->prepare("INSERT INTO paid_members (pcn_number, pharmacist) VALUES (:pcn_number, :pharmacist)");
      $upload_users->bindvalue("pharmacist", $name);
      $upload_users->bindvalue("pcn_number", $pcn);
      $upload_users->execute();
      if($upload_users){
          $_SESSION['success'] = "Upload successful!";
          header("Location: ../views/admin.php");
      }else{
        $_SESSION['error'] = "file Upload failed!";
        header("Location: ../views/admin.php");
      }
     }
    }
?>