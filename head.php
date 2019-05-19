<?php
// შეცდომების გამოტანა
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// სესიის სახელის შეცვლა
session_name('Lesson-3');
// სესიის დაწყება
session_start();

// Default Time Zone
date_default_timezone_set("Asia/Tbilisi");

require('library/db.php'); // load mysql connection
require('library/functions.php'); // load functions

$db = new db;
$func = new functions;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="sitchi">
    <title><?=$title?></title>
    <link rel="stylesheet" href="style/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/css/my.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Lesson - 3</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">პოსტები</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/deleted.php">წაშლილი პოსტები</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item my-lg-0">
                    <a class="btn btn-success" href="/newPost.php">პოსტის დამატება</a>
                </li>
            </ul>
        </div>
    </nav>
