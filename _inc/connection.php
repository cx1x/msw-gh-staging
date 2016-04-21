<?php

function mysqli_connector()
{	

	$live = 1;

	if ($live == 1) 
	{

		$db_user = "mswghbet";
		
		$db_pass = "mswDev123456789@";
		
		$db_host = "mswghbet.db.11882384.hostedresource.com";
		
		$db_name = "mswghbet";

	} 
	else 
	{
		
		$db_user = "root";
		
		$db_pass = "";
		
		$db_host = "localhost";
		
		$db_name = "mswghbet";

	}

	$mysqli = new mysqli($db_host,$db_user,$db_pass,$db_name);

	if(mysqli_connect_errno())
	{
    
    	die('Unable to connect to database: '.mysqli_connect_error());
		
	}

	else
	{

		return $mysqli;

	}

}




?>