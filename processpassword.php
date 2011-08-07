<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_SESSION['username'] == "")
{
	header('Location: error.php?error=No+session');
	exit();
}

$playerdata = mysql_query("SELECT * FROM players WHERE name = '" . $_SESSION['username'] . "'");

$playerrow = mysql_fetch_array($playerdata);

if ($_SESSION['username'] != "")
{
	if ($playerrow['password'] == $_POST["oldpassword"])
	{
		mysql_query("UPDATE players SET password = '" . $_POST["newpassword"] . "' WHERE name = '" . $_SESSION['username'] . "'");
		include("log.php");
		$action = "Changed password";
		writelog($action);
		header('Location: index.php?message=You+have+changed+your+password');
		exit();
	}
	else
	{
		header('Location: error.php?error=Incorrect+current+password');
		exit();
	}
}
else
{
	header('Location: error.php?error=No+session');
	exit();
}
	
mysql_close($connection)

?>
