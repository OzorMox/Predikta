<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_SESSION['admin'] == 1)
{
	if ($_POST["reset"] == "reset")
	{
        mysql_query("UPDATE players SET brucies = 0 WHERE player_id = " . $_GET["player"]);

		include("log.php");
		$action = "Reset Brucies: " . $_POST["brucies"] . " for player: " . $_GET["player"];
		writelog($action);
		header('Location: index.php');
		exit();
	}
	else
	{
		if (is_numeric($_POST["brucies"]))
		{
            $playerdata = mysql_query("SELECT * FROM players WHERE player_id = " . $_GET["player"]);
            
			while ($playerrow = mysql_fetch_array($playerdata))
			{
                $brucies = $playerrow['brucies'] + $_POST["brucies"];
                mysql_query("UPDATE players SET brucies = " . $brucies . " WHERE player_id = " . $_GET["player"]);
			}
			include("log.php");
			$action = "Added Brucies: " . $_POST["brucies"] . " for player: " . $_GET["player"];
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
