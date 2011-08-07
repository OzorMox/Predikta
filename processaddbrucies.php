<?php

//create session
session_start();

//connect to the database
include("connect.php");

$playerdata = mysql_query("SELECT * FROM players");

if ($_SESSION['admin'] == 1)
{
	if ($_POST["reset"] == "reset")
	{
		while ($playerrow = mysql_fetch_array($playerdata))
		{
			if ($playerrow['name'] != "Admin")
			{
				mysql_query("UPDATE players SET brucies = 0 WHERE player_id = " . $playerrow['player_id']);
			}
		}
		include("log.php");
		$action = "Reset Brucies";
		writelog($action);
		header('Location: index.php');
		exit();
	}
	else
	{
		if ($_POST["brucies"] > 0 && is_numeric($_POST["brucies"]))
		{
			while ($playerrow = mysql_fetch_array($playerdata))
			{
				if ($playerrow['name'] != "Admin")
				{
					$brucies = $playerrow['brucies'] + $_POST["brucies"];
					mysql_query("UPDATE players SET brucies = " . $brucies . " WHERE player_id = " . $playerrow['player_id']);
				}
			}
			include("log.php");
			$action = "Added Brucies: " . $_POST["brucies"];
			writelog($action);
			header('Location: index.php');
			exit();
		}
		else
		{
			header('Location: error.php?error=Invalid+entry');
			exit();
		}
	}
}
else
{
	header('Location: error.php?error=Permission+denied');
	exit();
}
	
mysql_close($connection)

?>
