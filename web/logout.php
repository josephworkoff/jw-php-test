<?php 
    session_start();
    unset($_SESSION['id']);
    session_destroy();
    header('Location: https://jw-php-test.herokuapp.com/login');
?>