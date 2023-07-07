<?php
    session_start();
    include "connections.php";
    // require "../barcodes/vendor/autoload.php";
    //barcode generator

    // if(isset($_POST['add_sponsor'])){
        
        $category = ucwords(htmlspecialchars(stripslashes($_POST['category'])));
        $sponsor = ucwords(htmlspecialchars(stripslashes($_POST['sponsor_name'])));
        $logo = $_FILES['logo']['name'];
        $logo_folder = "../sponsors/".$logo;
        $logo_size = $_FILES['logo']['size'];
        $allowed_ext = array('jpg', 'png', 'jpeg', 'webp');
        /* get current file extention */
        $file_ext = explode('.', $logo);
        $file_ext = strtolower(end($file_ext));
        if(in_array($file_ext, $allowed_ext)){
            //compress image
            function compressImage($source, $destination, $quality){
                //get image info
                $imgInfo = getimagesize($source);
                $mime = $imgInfo['mime'];
                //create new image from file
                switch($mime){
                    case 'image/png':
                        $image = imagecreatefrompng($source);
                        imagejpeg($image, $destination, $quality);
                        break;
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($source);
                        imagejpeg($image, $destination, $quality);
                        break;
                    
                    case 'image/webp':
                        $image = imagecreatefromwebp($source);
                        imagejpeg($image, $destination, $quality);
                        break;
                    default:
                        $image = imagecreatefromjpeg($source);
                        imagejpeg($image, $destination, $quality);
                }
                //return compressed image
                return $destination;
            }
            $compress = compressImage($_FILES['logo']['tmp_name'], $logo_folder, 80);
            if($compress){
                // add sponsor to database
                $add_sponsor = $connectdb->prepare("INSERT INTO sponsors (category, sponsor_name, logo) VALUES (:category, :sponsor_name, :logo)");
                $add_sponsor->bindvalue("category", $category);
                $add_sponsor->bindvalue("sponsor_name", $sponsor);
                $add_sponsor->bindvalue("logo", $logo);
                $add_sponsor->execute();
                if($add_sponsor){
                    $_SESSION['success'] = "Sponsor added";
                    header("Location: ../views/admin.php");
                }else{
                    $_SESSION['error'] = "failed to add sponsor";
                    header("Location: ../views/admin.php");
                }
            }else{
                $_SESSION['error'] = "image upload failed";
                header("Location: ../views/admin.php");
            }
        }else{
            $_SESSION['error'] = "Error! Image format not supported";
            header("Location: ../views/admin.php");
        }
    // }else{
    //     $_SESSION['error'] = "update failed!";
    //     header("Location: ../views/admin.php");

    // }
        

    

?>