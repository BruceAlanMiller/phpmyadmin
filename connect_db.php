<?php 
# establishing link to database using username, password and database name 
$link = mysqli_connect('localhost', 'HNDCSSA16', 'tqCgDdP7yZ', 'HNDCSSA16'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysqli_error()); 
} 
# establishing link to database using username, password and database name 
  
# Set encoding to match PHP script encoding.
mysqli_set_charset( $link, 'utf8' ) ;

?> 

