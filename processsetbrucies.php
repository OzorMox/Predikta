<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_SESSION['admin'] == 1)
{
	if ($_POST["reset"] == "reset")
	{
        mysqli_query($connection, "UPDATE players SET brucies = 0 WHERE player_id = " . $_GET["player"]);

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
            $playerdata = mysqli_query($connection, "SELECT * FROM players WHERE player_id = " . $_GET["player"]);
            
			while ($playerrow = mysqli_fetch_array($playerdata))
			{
                $brucies = $playerrow['brucies'] + $_POST["brucies"];
                mysqli_query($connection, "UPDATE players SET brucies = " . $brucies . " WHERE player_id = " . $_GET["player"]);
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
	
mysqli_close($connection)

?>
