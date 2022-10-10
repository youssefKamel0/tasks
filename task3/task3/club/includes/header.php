<?php

session_start();

$games = [
    'football' => 300,
    'swimming' => 250,
    'vollyball' => 150,
    'others' => 100,
    // 'others2' => 50,
    // 'others3' => 25,

] ;


// use it in reult.php line 112
$games2 = [
    'football' => 'football',
    'swimming' => 'swimming',
    'vollyball' => 'vollyball',
    'others' => 'others',
    // 'others2' => 'others2',
    // 'others3' => 'others3',

] ;

?>

<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>

        tr {
            border-bottom: 1px solid;
        }

        tr td:not(:last-child) {
            width: 16rem;
        }

        .getRight{
            position: absolute;
            right: -6px;
            color: red;
        }
        
        a {
            text-decoration: none;
        }

        .login-page {
            width: 100%;
            height: 100vh;
            display: inline-block;
        }

        .form-right i {
            font-size: 100px;
        }

        .form-control,
        body,
        .form-left,
        .col-md-7,
        .form-right {
            background: #212529 !important;
            color: #fff !important;
        }

        main {
            margin-top: 4rem;
        }

        .input-group-text {
            background-color: #0F1114 !important;
        }
    </style>
</head>
<body>
