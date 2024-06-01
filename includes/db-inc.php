<?php

$serverName = 'localhost';
$bdUsername = 'root';
$bdPassword = '';
$bdName = 'tb';

$conn = mysqli_connect($serverName, $bdUsername, $bdPassword, $bdName);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_errno());
}