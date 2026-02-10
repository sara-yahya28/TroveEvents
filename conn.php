
<?php
$username = "root";
$password = "";
$dbname = "trova_3";
$db = new PDO('mysql:host=localhost;dbname='. $dbname . ';charset=utf8', $username , $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>