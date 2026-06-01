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

if ($_POST["date"] == "" || $_POST["time"] == "")
{
	header('Location: error.php?error=Corrupt+post+data');
	exit();
}

$datetime = date('Y-m-d H:i:s', strtotime($_POST["date"] . ' ' . $_POST["time"]));

$gamedata = mysqli_query($connection, "SELECT status FROM games WHERE game_id = " . $_GET["game"]);

$gamerow = mysqli_fetch_array($gamedata);

if ($_SESSION['admin'] == 1)
{
	if ($gamerow['status'] == "open" || $gamerow['status'] == "unlocked")
	{
		if (!mysqli_query($connection, "UPDATE games SET date = '" . $datetime . "' WHERE game_id = " . $_GET["game"]))
		{
			header('Location: error.php?error=Database+query+failed+to+complete');
			exit();
		}
		if (!mysqli_query($connection, "UPDATE games SET type = '" . $_POST["type"] . "' WHERE game_id = " . $_GET["game"]))
		{
			header('Location: error.php?error=Database+query+failed+to+complete');
			exit();
		}
		include("log.php");
		$action = "Changed game date/type: " . $_GET["game"] . ": " . $datetime . ", " . $_POST["type"];
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

mysqli_close($connection)

?>
