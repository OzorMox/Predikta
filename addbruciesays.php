<?php

//create session
session_start();

//connect to the database
include("connect.php");

if (isset($_SESSION['username']))
{
	$bruciesays = $_POST["bruciesays"];
	$user = $_SESSION['username'];
	$datetime = date("Y/m/d H:i:s");

	if ($bruciesays != "")
	{
        mysqli_query($connection, "INSERT INTO bruciesays (bruciesays, user, datetime) VALUES ('" . strip_tags($bruciesays) . "', '" . $user . "', '" . $datetime . "')");
        include("log.php");
        $action = "Added Brucie Says";
        writelog($action);
        header('Location: index.php');
        break;
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
