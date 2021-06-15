<?php
	$conn = new mysqli('localhost', 'root', '', 'samaygnaw');
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
?>	