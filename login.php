<?php

//create session
session_start();

//connect to the database
include("connect.php");

if ($_POST["username"] == "")
{
	header('Location: error.php?error=Username+was+blank');
	exit();
}

$playerdata = mysqli_query($connection, "SELECT * FROM players WHERE name = '" . $_POST["username"] . "'");

$playerrow = mysqli_fetch_array($playerdata);

//check for admin user
$admindata = mysqli_query($connection, "SELECT * FROM players WHERE name = 'Admin'");

$admincheck = mysqli_num_rows($admindata);

if ($admincheck == 1)
{
	if ($_POST["password"] != "")
	{
		if ($playerrow['password'] == $_POST["password"])
		{
			$_SESSION['username'] = $playerrow['name'];
			$_SESSION['admin'] = $playerrow['admin'];
			include("log.php");
			$action = "Logged in";
			writelog($action);
			if ($playerrow['password'] == "default")
			{
				header('Location: loggedin.php?username=' . $playerrow['name'] . '&warn=yes');
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
			header('Location: error.php?error=Incorrect+login+details');
			exit();
		}
	}
	else
	{
		header('Location: error.php?error=Password+was+blank');
		exit();
	}
}
else
{
	header('Location: error.php?error=Bad+admin+configuration');
	exit();
}

mysqli_close($connection)

?>
