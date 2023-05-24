<?php
    include "connections.php";
    session_start();

    if(isset($_GET['dispense'])){
        $item_id = $_GET['dispense'];
        $dispense_item = $connectdb->prepare("UPDATE orders SET order_status = 1, delivery_date = CURDATE() WHERE order_id = :order_id");
        $dispense_item->bindvalue('order_id', $item_id);
        $dispense_item->execute();

        if($dispense_item){
            /* echo "<script>alert('Item dispensed!');
            window.open('admin.php', '_parent');</script>"; */
            //get customer name
            $get_customer = $connectdb->prepare("SELECT * FROM orders WHERE order_id = :order_id");
            $get_customer->bindvalue("order_id", $item_id);
            $get_customer->execute();
            $shows = $get_customer->fetchAll();
            foreach($shows as $show){
            $customer = $show->customer_email;
            $order_id = $show->order_number;
            $item_name = $show->item_name;
            }
            //get customer name
            $get_name = $connectdb->prepare("SELECT first_name FROM shoppers WHERE email = :email");
            $get_name->bindvalue("email", $customer);
            $get_name->execute();
            $name = $get_name->fetch();
            
            //send notification and email to customer
            $subject = "Item Dispensed";
            $details = "Hello $name->first_name, your order $item_name, with order number: $order_id has been dispensed for delivery to your address. \n Thanks for your business. Do Shop more with Us";
            $mailHeader = "FROM: Admin";
            
            //send notification
            $send_notification = $connectdb->prepare("INSERT INTO notifications (customer_email, subject, details) VALUES(:customer_email, :subject, :details)");
            $send_notification->bindvalue("customer_email", $customer);
            $send_notification->bindvalue("subject", $subject);
            $send_notification->bindvalue("details", $details);
            $send_notification->execute();
            //send mail
            mail($customer, $subject, $details, $mailHeader) or die("Error!");
            $_SESSION['success'] = "Item Dispensed!";
            
            header("Location: ../views/admin.php");
        }else{
            $_SESSION['error'] = "failed to dispense";
            header("Location: ../views/admin.php");
        }
    }