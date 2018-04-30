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

//what to toggle to?
if ($_GET["admin"] == 1)
	$setadmin = 0;
else
	$setadmin = 1;

if ($_SESSION['username'] == "Admin")
{
	if (!mysqli_query($connection, "UPDATE players SET admin = " . $setadmin . " WHERE player_id = " . $_GET["player"]))
	{
		header('Location: error.php?error=Database+query+failed+to+complete');
		exit();
	}
	else
	{
		include("log.php");
		$action = "Changed admin status: " . $_GET["player"] . ": " . $setadmin;
		writelog($action);
		header('Location: index.php');
		exit();
	}
}
else
{
	header('Location: error.php?error=Permission+denied');
	exit();
}
	
mysqli_close($connection)

?>
