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

$playerdata = mysql_query("SELECT * FROM players WHERE player_id = " . $_GET["player"]);

$playerrow = mysql_fetch_array($playerdata);

$gamedata = mysql_query("SELECT status FROM games WHERE game_id = " . $_GET["game"]);

$gamerow = mysql_fetch_array($gamedata);

if ($playerrow['name'] == $_SESSION['username']){
	if ($gamerow['status'] == "open" || $gamerow['status'] == "unlocked")
	{
		if ($_POST["brucie"] == "brucie")
		{
			if ($playerrow['brucies'] > 0)
			{
				$updbrucies = $playerrow['brucies'] - 1;
				mysql_query("UPDATE players SET brucies = " . $updbrucies . " WHERE player_id = " . $playerrow['player_id']);
				mysql_query("INSERT INTO results (score_1, score_2, brucie, game_id, player_id) VALUES (" . (int)$_POST["score1"] . ", " . (int)$_POST["score2"] . ", 1, " . $_GET["game"] . ", " . $_GET["player"] . ")");
				include("log.php");
				$action = "Set prediction: " . $_GET["game"];
				writelog($action);
				if (($_POST["score1"] == 6 && $_POST["score2"] == 0) || ($_POST["score1"] == 0 && $_POST["score2"] == 6))
				{
					header('Location: index.php?sixnil=yes');
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
				header('Location: error.php?error=No+Brucie+Bonuses+available');
				exit();
			}
		}
		else
		{
			mysql_query("INSERT INTO results (score_1, score_2, brucie, game_id, player_id) VALUES (" . (int)$_POST["score1"] . ", " . (int)$_POST["score2"] . ", 0, " . $_GET["game"] . ", " . $_GET["player"] . ")");
			include("log.php");
			$action = "Set prediction: " . $_GET["game"];
			writelog($action);
			if (($_POST["score1"] == 6 && $_POST["score2"] == 0) || ($_POST["score1"] == 0 && $_POST["score2"] == 6))
			{
				header('Location: index.php?sixnil=yes');
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
