<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_POST["date"] == "" || $_POST["time"] == "")
{
	header('Location: error.php?error=Missing+date+or+time');
	exit();
}

$datetime = date('Y-m-d H:i:s', strtotime($_POST["date"] . ' ' . $_POST["time"]));

if (isset($_SESSION['username']))
{
	if ($_POST["custom"] == "yes")
	{
		mysqli_query($connection, "INSERT INTO games (team_1, team_2, date, status, type) VALUES ('" . mysqli_real_escape_string($connection, strip_tags($_POST["customgame1"])) . "', '" . mysqli_real_escape_string($connection, strip_tags($_POST["customgame2"])) . "', '" . $datetime . "', 'open', 'weekend')");
		include("log.php");
		$action = "Added custom game: " . strip_tags($_POST["customgame1"]) . " v " . strip_tags($_POST["customgame2"]) . ", " . $datetime . ", " . $_POST["type"];
		writelog($action);
		if ($_POST["another"] == "yes")
		{
			header('Location: addgame.php?date=' . urlencode($datetime));
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
		mysqli_query($connection, "INSERT INTO games (team_1, team_2, date, status, type) VALUES ('" . strip_tags($_POST["team1"]) . "', '" . strip_tags($_POST["team2"]) . "', '" . $datetime . "', 'open', 'weekend')");
		include("log.php");
		$action = "Added game: " . strip_tags($_POST["team1"]) . " v " . strip_tags($_POST["team2"]) . ", " . $datetime . ", " . $_POST["type"];
		writelog($action);
		if ($_POST["another"] == "yes")
		{
			header('Location: addgame.php?date=' . urlencode($datetime));
			exit();
		}
		else
		{
			header('Location: index.php');
			exit();
		}
	}
}
else
{
	header('Location: error.php?error=Session+expired');
}
	
mysqli_close($connection)

?>
