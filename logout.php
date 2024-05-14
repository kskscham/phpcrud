<?php 
    session_start();
    $_SESSION['Username'] = '';
    session_unset();
    header('location:login.php');