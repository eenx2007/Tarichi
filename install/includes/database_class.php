<?php

class Database {

	// Function to the database and tables and fill them with the default data
	function create_database($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],'');

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Create the prepared statement
		$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['database']);

		// Close the connection
		$mysqli->close();

		return true;
	}

	// Function to create the tables and fill them with the default data
	function create_tables($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);
		$_SESSION['hostname']=$data['hostname'];
		$_SESSION['username']=$data['username'];
		$_SESSION['password']=$data['password'];
		$_SESSION['database']=$data['database'];
		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Open the default SQL file
		$query = file_get_contents('assets/install.sql');

		// Execute a multi query
		$mysqli->multi_query($query);

		
		// Close the connection
		$mysqli->close();
		
		
		
		return true;
	}
	
	function set_config($data)
	{
		$mysqli = new mysqli($_SESSION['hostname'],$_SESSION['username'],$_SESSION['password'],$_SESSION['database']);
		if(mysqli_connect_errno())
			return false;
		$query1='update user set username="'.$data['username'].'", password="'.md5($data['password']).'"';
		$mysqli->query($query1);
		$query2='update site_config set site_name="'.$data['site_name'].'", site_slogan="'.$data['site_slogan'].'", site_main_email="'.$data['site_main_email'].'"';
		$mysqli->query($query2);
		$mysqli->close();
		$_SESSION['admin_username']=$data['username'];
		$_SESSION['admin_password']=$data['password'];
		$_SESSION['site_name']=$data['site_name'];
		$_SESSION['site_slogan']=$data['site_slogan'];
		$_SESSION['site_main_email']=$data['site_main_email'];
		return true;
	}
	
}
?>

