
<?php

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "mess_mate";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connection to 
 Db failed: %s\n". $conn -> error);
 
// $conn = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 return $conn;
 }
 

?>
