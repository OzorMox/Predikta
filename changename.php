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

if ($_POST["name"] == "")
{
	header('Location: error.php?error=Missing+player+name');
	exit();
}

if ($_SESSION['admin'] == 1)
{
	if (!mysqli_query($connection, "UPDATE players SET name = '" . $_POST["name"] . "' WHERE player_id = " . $_GET["player"]))
	{
		header('Location: error.php?error=Database+query+failed+to+complete');
		exit();
	}
	else
	{
		include("log.php");
		$action = "Changed name: " . $_GET["player"] . ": " . $_POST["name"];
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

mysqli_close($connection);

?>
