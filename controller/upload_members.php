 <?php
/*    include "connections.php";
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
    }*/
?> 

<?php
session_start();
    include "connections.php";
    if(isset($_POST['upload_paid'])){
    
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['paid_members']['name']) && in_array($_FILES['paid_members']['type'], $csvMimes)){
            
            // If the file is uploaded
            if(is_uploaded_file($_FILES['paid_members']['tmp_name'])){
                
                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['paid_members']['tmp_name'], 'r');
                
                // Skip the first line
                fgetcsv($csvFile);
                
                // Parse data from CSV file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    // Get row data
                    $pcn_number   = $line[0];
                    $first_name  = $line[1];
                    $last_name  = $line[2];
                    $whatsapp  = $line[3];
                    $res_state  = $line[4];
                    $user_email  = $line[5];
                    $gender  = $line[6];
                    $fellow  = $line[7];
                    // $status = $line[3];
                    
                    // Check whether member already exists in the database with the same pcn number
                    $prevQuery = "SELECT * FROM paid_members WHERE pcn_number = '".$line[0]."'";
                    $prevResult = $connectdb->query($prevQuery);
                    
                    if($prevResult->rowCount() > 0){
                        // Update member data in the database
                        $connectdb->query("UPDATE users SET first_name = '".$first_name."' WHERE pcn_number = '".$pcn_number."'");
                    
                    }else{
                        // Insert member data in the database
                        $connectdb->query("INSERT INTO paid_members (pcn_number, first_name, last_name, whatsapp, res_state, user_email, gender, fellow) VALUES ('".$pcn_number."', '".$first_name."', '".$last_name."', '".$whatsapp."', '".$res_state."', '".$user_email."', '".$gender."', '".$fellow."')");
                    }
                }
                
                // Close opened CSV file
                fclose($csvFile);
                
                $_SESSION['success'] = "Paid members uploaded successfully!";
                header("Location: ../views/admin.php");
            }else{
                $_SESSION['error'] = "Failed";
                header("Location: ../views/admin.php");
            }
        }else{
            $_SESSION['error'] = "Invalid file";
                header("Location: ../views/admin.php");
        }
    }
    