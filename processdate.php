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

if ($_POST["date"] == "")
{
	header('Location: error.php?error=Corrupt+post+data');
	exit();
}

$gamedata = mysql_query("SELECT status FROM games WHERE game_id = " . $_GET["game"]);

$gamerow = mysql_fetch_array($gamedata);

if ($_SESSION['admin'])
{
	if ($gamerow['status'] == "open" || $gamerow['status'] == "unlocked")
	{
		if (!mysql_query("UPDATE games SET date = '" . $_POST["date"] . "' WHERE game_id = " . $_GET["game"]))
		{
			header('Location: error.php?error=Database+query+failed+to+complete');
			exit();
		}
		if (!mysql_query("UPDATE games SET type = '" . $_POST["type"] . "' WHERE game_id = " . $_GET["game"]))
		{
			header('Location: error.php?error=Database+query+failed+to+complete');
			exit();
		}
		include("log.php");
		$action = "Changed game date/type: " . $_GET["game"] . ": " . $_POST["date"] . ", " . $_POST["type"];
		writelog($action);
		header('Location: index.php');
		exit();
	}
	else
	{
		header('Location: error.php?error=This+game+is+not+open');
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
