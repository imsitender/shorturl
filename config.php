<?php
// Database configuration
$Host     = "localhost";
$Username = "root";
$Password = "";
$database  = "url_short";
$base_url='http://localhost/shorturl/'; 

// Create database connection
try{
    $db = new mysqli($Host, $Username, $Password, $database);
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}