<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_GET["player"] == "")
{
	header('Location: error.php?error=No+player+ID+found');
	exit();
}

if ($_SESSION['admin'] == 1)
{
	//check that this isn't the admin user
	$playerdata = mysqli_query($connection, "SELECT * FROM players WHERE player_id = " . $_GET["player"]);
	$playerrow = mysqli_fetch_array($playerdata);
	if ($playerrow['name'] != "Admin")
	{
		mysqli_query($connection, "DELETE FROM players WHERE player_id = " . $_GET["player"]);
		mysqli_query($connection, "DELETE FROM results WHERE player_id = " . $_GET["player"]);
		include("log.php");
		$action = "Deleted player: " . $_GET["player"];
		writelog($action);
		header('Location: index.php');
		exit();
	}
	else
	{
		header('Location: error.php?error=This+user+cannot+be+deleted');
	}
}
else
{
	header('Location: error.php?error=Permission+denied');
	exit();
}

mysqli_close($connection);

?>
