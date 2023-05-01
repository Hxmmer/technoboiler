<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technoboiler</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <h2 class="logo">Techno Boiler</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
            <?php
                if (isset($_SESSION['uid'])) {
                    echo "<a href='profile.php'>Profile</a>";
                    echo "<a href='logout.php'>Log out</a>";
                } else {
                    "<button class='btnLogin-popup'>Login</button>";
                };
            ?>
            <!-- <button class="btnLogin-popup">Login</button> -->
        </nav>
    </header>