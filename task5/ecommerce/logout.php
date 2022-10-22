<?php 

session_start();


    unset($_SESSION['user']);
    header('location:login.php');


if (isset($_COOKIE['rememberMe'])) {

    setcookie('rememberMe', '', time() - 3600, '/');

}