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

//find which predictions have Brucies set
$resultdata = mysqli_query($connection, "SELECT player_id FROM results WHERE brucie = 1 AND game_id = " . $_GET["game"]);

if ($_SESSION['admin'] == 1)
{
	while ($resultrow = mysqli_fetch_array($resultdata))
	{
		//get current number of Brucies and update
		$playerdata = mysqli_query($connection, "SELECT brucies FROM players WHERE player_id = " . $resultrow['player_id']);
		$playerrow = mysqli_fetch_array($playerdata);
		mysqli_query($connection, "UPDATE players SET brucies = " . ($playerrow['brucies'] + 1) . " WHERE player_id = " . $resultrow['player_id']);
	}
	mysqli_query($connection, "DELETE FROM games WHERE game_id = " . $_GET["game"]);
	mysqli_query($connection, "DELETE FROM results WHERE game_id = " . $_GET["game"]);
	include("log.php");
	$action = "Deleted game: " . $_GET["game"];
	writelog($action);
	header('Location: index.php');
	exit();
}
else
{
	header('Location: error.php?error=Permission+denied');
	exit();
}

mysqli_close($connection);

?>
