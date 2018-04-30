<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_GET["game"] == "" || $_GET["player"] == "")
{
	header('Location: error.php?error=No+ID+found');
	exit();
}

$playerdata = mysqli_query($connection, "SELECT * FROM players WHERE player_id = " . $_GET["player"]);

$playerrow = mysqli_fetch_array($playerdata);

$gamedata = mysqli_query($connection, "SELECT status FROM games WHERE game_id = " . $_GET["game"]);

$gamerow = mysqli_fetch_array($gamedata);

$resultdata = mysqli_query($connection, "SELECT brucie FROM results WHERE game_id = " . $_GET["game"] . " AND player_id = " . $_GET["player"]);

$resultrow = mysqli_fetch_array($resultdata);

if ($playerrow['name'] == $_SESSION['username'])
{
	if ($gamerow['status'] == "open" || $gamerow['status'] == "unlocked")
	{
		mysqli_query($connection, "DELETE FROM results WHERE game_id = " . $_GET["game"] . " AND player_id = " . $_GET["player"]);
		//add Brucie Bonus back on if there was one set
		if ($resultrow['brucie'] == 1)
		{
			$updbrucies = $playerrow['brucies'] + 1;
			mysqli_query($connection, "UPDATE players SET brucies = " . $updbrucies . " WHERE player_id = " . $playerrow['player_id']);
		}
		include("log.php");
		$action = "Deleted prediction: " . $_GET["game"];
		writelog($action);
		header('Location: set.php?game=' . $_GET["game"] . '&player=' . $_GET["player"] . '&team1=' . $_GET["team1"] . '&team2=' . $_GET["team2"]);
		exit();
	}
	else
	{
		header('Location: error.php?error=This+game+is+locked+or+already+set');
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
