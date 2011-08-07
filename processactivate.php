<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_POST["score1"] == "" || (!is_numeric($_POST["score1"])))
{
	header('Location: error.php?error=Invalid+entry');
	exit();
}

if ($_POST["score2"] == "" || (!is_numeric($_POST["score2"])))
{
	header('Location: error.php?error=Invalid+entry');
	exit();
}

if ($_POST["score1"] < 0 || $_POST["score2"] < 0)
{
	header('Location: error.php?error=Negative+values+are+not+allowed');
	exit();
}

if ($_GET["game"] == "")
{
	header('Location: error.php?error=No+game+ID+found');
	exit();
}

if ($_SESSION['admin'] == 1)
{
	if (!mysql_query("UPDATE games SET actual_1 = " . $_POST["score1"] . ", actual_2 = " . $_POST["score2"] . ", status = 'set' WHERE game_id = " . $_GET["game"]))
	{
		header('Location: error.php?error=Database+query+failed+to+complete');
		exit();
	}
	else
	{
		include("log.php");
		$action = "Activated game: " . $_GET["game"] . ": " . $_POST["score1"] . "-" . $_POST["score2"];
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
