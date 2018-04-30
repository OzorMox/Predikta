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
	if (!mysqli_query($connection, "UPDATE games SET actual_1 = 0, actual_2 = 0, status = 'locked' WHERE game_id = " . $_GET["game"]))
	{
		header('Location: error.php?error=Database+query+failed+to+complete');
		exit();
	}
	else
	{
		include("log.php");
		$action = "Deleted actual score: " . $_GET["game"];
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
