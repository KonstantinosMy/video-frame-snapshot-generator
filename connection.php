<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="platform";

if(!$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
die("Αποτυχία σύνδεσης");
}
?>