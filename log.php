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

	//if action is "automatically locked game", then never log a username
	$autolockgame = "Automatically locked game";
	//set default username (blank)
	$user = "--";

	if ($_SESSION['username'] != "")
	{
		if (strpos($action, $autolockgame) === false)
		{
			$user = $_SESSION['username'];
		}
	}

	$datetime = date("Y/m/d H:i:s");

	if ($action != "")
	{
		mysql_query("INSERT INTO log (action, user, datetime) VALUES ('" . $action . "', '" . $user . "', '" . $datetime . "')");
	}
}

?>
