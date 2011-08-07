<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_POST["player"] == "")
{
	header('Location: error.php?error=Missing+player+name');
	exit();
}

if ($_POST["brucies"] == "" || !is_numeric($_POST["brucies"]))
{
	header('Location: error.php?error=Missing+or+invalid+data');
	exit();
}

if ($_SESSION['admin'] == 1)
{
	if ($_POST["player"] != "Admin")
	{
		mysql_query("INSERT INTO players (name, password, admin, brucies) VALUES ('" . strip_tags($_POST["player"]) . "', 'default', 0, " . $_POST["brucies"] . ")");
		include("log.php");
		$action = "Added player: " . strip_tags($_POST["player"]) . ", " . $_POST["brucies"] . " Brucies";
		writelog($action);
		header('Location: index.php');
		exit();
	}
	else
	{
		header('Location: error.php?error=Player+name+is+reserved');
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
