<?php
    if (!isset($_SESSION)) { session_start(); }
    $_SESSION = array(); 
    unset($_SESSION['email']);
    session_destroy(); 
    header("Location: index1.html"); // Or wherever you want to redirect
    exit();
?>