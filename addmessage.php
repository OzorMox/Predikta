<?php

//create session
session_start();

//connect to the database
include("connect.php");

if (isset($_SESSION['username']))
{
	$message = $_POST["message"];
	$user = $_SESSION['username'];
	$datetime = date("Y/m/d H:i:s");

	if ($message != "")
	{
		switch (strtoupper($message))
		{
			case "WE LOVE YOU BRUCIE":
				header('Location: index.php?brucie=yes');
				break;
			case "KIRSTY THE BOILER":
				header('Location: index.php?scott=yes');
				break;
			default:
				mysqli_query($connection, "INSERT INTO messages (message, user, datetime) VALUES ('" . strip_tags($message) . "', '" . $user . "', '" . $datetime . "')");
				include("log.php");
				$action = "Added message";
				writelog($action);
				header('Location: index.php');
				break;
		}
	}
	else
	{
		header('Location: index.php');
	}
}
else
{
	header('Location: error.php?error=Session+expired');
}

?>
