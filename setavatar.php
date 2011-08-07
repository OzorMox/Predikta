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
	if (!mysql_query("UPDATE players SET avatar = '" . $_POST["avatar"] . "' WHERE player_id = " . $_GET["player"]))
	{
		header('Location: error.php?error=Database+query+failed+to+complete');
		exit();
	}
	else
	{
		include("log.php");
		$action = "Set avatar: " . $_GET["player"];
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

mysql_close($connection);

?>
