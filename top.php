<?php
    session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>PHP Online Store</title>
    </head>
    <body>
        <div class="mx-auto container">
            <h1>PHP Online Store</h1>
            <a href="index.php">Home</a> - <a href="cart.php">Cart</a>
            <span class="badge badge-primary badge-pill" id="cart_count"></span>
            <br><br>