<?php  
/** 
 * using mysqli_connect for database connection  */ 
  
$databaseHost = '127.0.0.1'; 
$databaseName = 'supplier'; 
$databaseUsername = 'root'; 
$databasePassword = 'root'; 
  
$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);  
  
?> 
