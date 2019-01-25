<?php

/*

  Fill in the values with your database info and put outside of root, making sure all files that use this have the right path

*/

DEFINE ('DB_USER', 'username');
DEFINE ('DB_PASSWORD', 'password');
DEFINE ('DB_HOST', 'host');
DEFINE ('DB_NAME', 'database');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to database ' . mysqli_connect_error());

?>
