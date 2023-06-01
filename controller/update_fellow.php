<?php
session_start();
    include "connections.php";
    if(isset($_POST['upload_fellow'])){
    
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['fellow']['name']) && in_array($_FILES['fellow']['type'], $csvMimes)){
            
            // If the file is uploaded
            if(is_uploaded_file($_FILES['fellow']['tmp_name'])){
                
                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['fellow']['tmp_name'], 'r');
                
                // Skip the first line
                fgetcsv($csvFile);
                
                // Parse data from CSV file line by line
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    // Get row data
                    $pcn   = $line[0];
                    $fellow  = $line[1];
                    $last_name  = $line[2];
                    // $status = $line[3];
                    
                    // Check whether member already exists in the database with the same email
                    $prevQuery = "SELECT * FROM paid_members WHERE pcn_number = '".$line[0]."'";
                    $prevResult = $connectdb->query($prevQuery);
                    
                    if($prevResult->rowCount() > 0){
                        // Update member data in the database
                        $connectdb->query("UPDATE paid_members SET fellow = '".$fellow."' WHERE pcn_number = '".$pcn."'");
                    }else{
                        // Insert member data in the database
                        $connectdb->query("INSERT INTO paid_members (pcn_number, fellow, last_name) VALUES ('".$pcn."', '".$fellow."', '".$last_name."')");
                    }
                }
                
                // Close opened CSV file
                fclose($csvFile);
                
                $_SESSION['success'] = "Fellows updated";
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
    