<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_POST["date"] == "")
{
	header('Location: error.php?error=Missing+date');
	exit();
}

if ($_POST["custom"] == "yes")
{
	mysqli_query($connection, "INSERT INTO games (team_1, team_2, date, status, type) VALUES ('" . strip_tags($_POST["customgame1"]) . "', '" . strip_tags($_POST["customgame2"]) . "', '" . $_POST["date"] . "', 'open', '" . $_POST["type"] . "')");
	include("log.php");
	$action = "Added custom game: " . strip_tags($_POST["customgame1"]) . " v " . strip_tags($_POST["customgame2"]) . ", " . $_POST["date"] . ", " . $_POST["type"];
	writelog($action);
	if ($_POST["another"] == "yes")
	{
		header('Location: addgame.php?date=' . $_POST["date"]);
		exit();
	}
	else
	{
		header('Location: index.php');
		exit();
	}
}
else
{
	mysqli_query($connection, "INSERT INTO games (team_1, team_2, date, status, type) VALUES ('" . strip_tags($_POST["team1"]) . "', '" . strip_tags($_POST["team2"]) . "', '" . $_POST["date"] . "', 'open', '" . $_POST["type"] . "')");
	include("log.php");
	$action = "Added game: " . strip_tags($_POST["team1"]) . " v " . strip_tags($_POST["team2"]) . ", " . $_POST["date"] . ", " . $_POST["type"];
	writelog($action);
	if ($_POST["another"] == "yes")
	{
		header('Location: addgame.php?date=' . $_POST["date"]);
		exit();
	}
	else
	{
		header('Location: index.php');
		exit();
	}
}
	
mysqli_close($connection)

?>
