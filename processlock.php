<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_GET["game"] == "")
{
	header('Location: error.php?error=No+game+ID+found');
	exit();
}

if ($_SESSION['admin'] == 1)
{
	if (!mysql_query("UPDATE games SET status = 'locked' WHERE game_id = " . $_GET["game"]))
	{
		header('Location: error.php?error=Database+query+failed+to+complete');
		exit();
	}
	else
	{
		include("log.php");
		$action = "Locked game: " . $_GET["game"];
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
	
mysql_close($connection)

?>
