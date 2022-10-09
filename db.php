<?php
define('DSN', 'mysql:host=localhost;dbname=uts_forum');
define('DBUSER', 'root');
define('DBPASS', '');

$db = new PDO(DSN, DBUSER, DBPASS);

// mysqli_connect("server" , "username" , "password" , "database");
$conn = mysqli_connect("localhost", "root", "", "uts_forum") or die("Connection Failed");
