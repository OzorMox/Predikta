<?php

//create session
if (!isset($_SESSION))
{
	session_start();
}

function writelog($action)
{
	//connect to the database
	include("connect.php");

	//if action contains "Automatically locked game" or "BrucieAI", then never log a username
	$autolockgame = "Automatically locked game";
	$bruciepredicts = "BrucieAI";
	$action = mysqli_real_escape_string($connection, strip_tags($action));
	
	//set default username (blank)
	$user = "--";

	if ($_SESSION['username'] != "")
	{
		if (strpos($action, $autolockgame) === false && strpos($action, $bruciepredicts) === false)
		{
			$user = $_SESSION['username'];
		}
	}

	$datetime = date("Y/m/d H:i:s");

	if ($action != "")
	{
		mysqli_query($connection, "INSERT INTO log (action, user, datetime) VALUES ('" . $action . "', '" . $user . "', '" . $datetime . "')");
	}
}

?>
