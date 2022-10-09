<?php

session_start();

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
