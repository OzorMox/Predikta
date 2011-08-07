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

$playerdata = mysql_query("SELECT * FROM players WHERE player_id = " . $_GET["player"]);

$playerrow = mysql_fetch_array($playerdata);

$gamedata = mysql_query("SELECT status FROM games WHERE game_id = " . $_GET["game"]);

$gamerow = mysql_fetch_array($gamedata);

$resultdata = mysql_query("SELECT brucie FROM results WHERE game_id = " . $_GET["game"] . " AND player_id = " . $_GET["player"]);

$resultrow = mysql_fetch_array($resultdata);

if ($playerrow['name'] == $_SESSION['username'])
{
	if ($gamerow['status'] == "open" || $gamerow['status'] == "unlocked")
	{
		mysql_query("DELETE FROM results WHERE game_id = " . $_GET["game"] . " AND player_id = " . $_GET["player"]);
		//add Brucie Bonus back on if there was one set
		if ($resultrow['brucie'] == 1)
		{
			$updbrucies = $playerrow['brucies'] + 1;
			mysql_query("UPDATE players SET brucies = " . $updbrucies . " WHERE player_id = " . $playerrow['player_id']);
		}
		include("log.php");
		$action = "Deleted prediction: " . $_GET["game"];
		writelog($action);
		header('Location: index.php');
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
	
mysql_close($connection)

?>
