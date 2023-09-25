<?php
$hostname="localhost";
$dbuser= "root";
$dbpassword= "";
$dbname="cse_482";
$con= mysqli_connect($hostname,$dbuser,$dbpassword,$dbname);
if(!$con){
    die("Something went wrong");
}
?>