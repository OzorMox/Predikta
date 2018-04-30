<?php

//create session
session_start();

//connect to the database
include("connect.php");

$playerdata = mysqli_query($connection, "SELECT * FROM players");

if ($_SESSION['admin'] == 1)
{
	if ($_POST["reset"] == "reset")
	{
		while ($playerrow = mysqli_fetch_array($playerdata))
		{
			if ($playerrow['name'] != "Admin")
			{
				mysqli_query($connection, "UPDATE players SET brucies = 0 WHERE player_id = " . $playerrow['player_id']);
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
		if (is_numeric($_POST["brucies"]))
		{
			while ($playerrow = mysqli_fetch_array($playerdata))
			{
				if ($playerrow['name'] != "Admin")
				{
					$brucies = $playerrow['brucies'] + $_POST["brucies"];
					mysqli_query($connection, "UPDATE players SET brucies = " . $brucies . " WHERE player_id = " . $playerrow['player_id']);
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
	
mysqli_close($connection)

?>
