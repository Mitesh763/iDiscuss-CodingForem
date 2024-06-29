<?php
// script for connect to the database

//connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

// create Connection object
$conn = mysqli_connect($servername, $username, $password, $database);
// or  die("Error! Failed to Connect Database!! : "  .mysqli_connect_error());;
// die if connection was not successfull
// if(!$conn){
//     die("Error! Failed to Connect Database!! : "  .mysqli_connect_error());
// }