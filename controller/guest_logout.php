<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../guests/guest_login.php");

?>