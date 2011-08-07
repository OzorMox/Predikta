<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_GET["month"] == "" || $_GET["player"] == "")
{
	header('Location: error.php?error=No+ID+found');
	exit();
}

if (!is_numeric($_POST["points"]))
{
	header('Location: error.php?error=Invalid+entry');
	exit();
}

if ($_SESSION['admin'] == 1)
{
	if (!mysql_query("UPDATE players SET " . $_GET["month"] . " = " . $_POST["points"] . " WHERE player_id = " . $_GET["player"]))
	{
		header('Location: error.php?error=Database+query+failed+to+complete');
		exit();
	}
	else
	{
		include("log.php");
		$action = "Set player points: " . $_GET["player"] . ", " . $_GET["month"] . ": " . $_POST["points"];
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
