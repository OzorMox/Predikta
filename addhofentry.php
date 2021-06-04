<?php

//create session
session_start();

//connect to the database
include("connect.php");

if (isset($_SESSION['username']))
{
	$entry = mysqli_real_escape_string($connection, $_POST["entry"]);
	$awardedto = $_POST['awardedto']; //TODO: this should come from a drop down list of players
    $awardedby = $_SESSION['username'];
	$datetime = date("Y/m/d H:i:s");

	if ($entry != "" && $awardedto != "")
	{
        $playerexists = mysqli_query($connection, "SELECT * FROM players WHERE name = '" . $awardedto . "'");
        
        if (mysqli_num_rows($playerexists) != 0)
        {
            mysqli_query($connection, "INSERT INTO halloffame (entry, awardedto, awardedby, datetime) VALUES ('" . strip_tags($entry) . "', '" . strip_tags($awardedto) . "', '" . $awardedby . "', '" . $datetime . "')");
            include("log.php");
            $action = "Added Hall Of Fame entry";
            writelog($action);
            header('Location: halloffame.php');
            break;
        }
        else
        {
            header('Location: error.php?error=Player+does+not+exist');
        }
	}
	else
	{
		header('Location: halloffame.php');
	}
}
else
{
	header('Location: error.php?error=Session+expired');
}

?>
