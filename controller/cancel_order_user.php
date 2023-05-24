<?php
    include "connections.php";
    session_start();

    if(isset($_GET['cancel'])){
        $item_id = $_GET['cancel'];
        $cancel_order = $connectdb->prepare("UPDATE orders SET order_status = -1, delivery_date = CURDATE() WHERE order_id = :order_id");
        $cancel_order->bindvalue('order_id', $item_id);
        $cancel_order->execute();

        if($cancel_order){
           /*  echo "<script>alert('Order cancelled!');
            window.open('admin.php', '_parent');</script>"; */
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
            $subject = "Order Cancelled";
            $details = "Hello $name->first_name, your order $item_name, with order number: $order_id has been Cancelled for some reason. \n You can order again. Thanks for your business";
            $mailHeader = "FROM: ACPN EKo Akate 2022";
            
            //send notification
            $send_notification = $connectdb->prepare("INSERT INTO notifications (customer_email, subject, details) VALUES(:customer_email, :subject, :details)");
            $send_notification->bindvalue("customer_email", $customer);
            $send_notification->bindvalue("subject", $subject);
            $send_notification->bindvalue("details", $details);
            $send_notification->execute();
            //send mail
            mail($customer, $subject, $details, $mailHeader) or die("Error!");
            $_SESSION['error'] = "Order Cancelled!";
            header("Location: ../views/exhibitors.php");
        }else{
            $_SESSION['error'] = "failed to cancel";
            header("Location: ../views/exhibitors.php");
        }
    }