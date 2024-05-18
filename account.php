<?php
session_start();

if (!isset($_SESSION['username']))
{
  header('Location: error.php?error=No+session');
  exit();
}

// Connect to the database
include("connect.php");

// If the submit button has been pressed, change the settings
if (isset($_POST['submit']) && $_POST['submit'])
{
  $t_reminder = 0;
  if ($_POST['reminder'])
  {
    $t_reminder = 1;
  }

  $t_mobile_view = 0;
  if ($_POST['mobileview'])
  {
    $t_mobile_view = 1;
  }
  
  if ($_POST["oldpassword"] != "")
  {
    $playerdata = mysqli_query($connection, "SELECT * FROM players WHERE name = '" . $_SESSION['username'] . "'");

    $playerrow = mysqli_fetch_array($playerdata);
    
    if ($playerrow['password'] == $_POST["oldpassword"])
    {
      mysqli_query($connection, "UPDATE players SET password = '" . $_POST["newpassword"] . "' WHERE name = '" . $_SESSION['username'] . "'");
      include("log.php");
      $action = "Changed password";
      writelog($action);
      header('Location: index.php?message=You+have+changed+your+password');
      exit();
    }
    else
    {
      header('Location: error.php?error=Incorrect+current+password');
      exit();
    }
  }

  $t_sql = "UPDATE `players` SET " . 
              "`email` = '" . $_POST['email'] . "', " . 
              "`avatar` = '" . $_POST['avatar'] . "', " . 
              "`send_reminder_email` = " . $t_reminder . " " . 
              "`mobile_view` = " . $t_mobile_view . " " . 
            "WHERE `name` = '" . $_SESSION['username'] . "'";

  mysqli_query($connection, $t_sql);
}

$t_email = "";
$t_show_reminder = false;
$t_mobile_view = false;
$t_avatar = "";

// Get account settings from database for this user
$t_sql = "SELECT `email`, `send_reminder_email`, `mobile_view`, `avatar` FROM `players` " . 
    "WHERE `name` = '" . $_SESSION['username'] . "'";

$t_result = mysqli_query($connection, $t_sql);

while ($t_row = mysqli_fetch_assoc($t_result))
{
  if ($t_row['email'] != null && strlen($t_row['email']) > 0)
  {
    $t_email = $t_row['email'];
  }

  if ($t_row['send_reminder_email'])
  {
    $t_show_reminder = $t_row['send_reminder_email'];
  }

  if ($t_row['avatar'] != null && strlen($t_row['avatar']) > 0)
  {
    $t_avatar = $t_row['avatar'];
  }

  if ($t_row['mobile_view'])
  {
    $t_mobile_view = $t_row['mobile_view'];
  }
}

?>
<html>
<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php

include("title");

echo "<form name=\"accountsettings\" action=\"account.php\" method=\"post\">";
echo "Update your account settings";
echo "<br>";
echo "<br>";
echo "<table>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=\"2\"><strong>Avatar Settings</strong></th>";
echo "</tr>";
echo "<tr>";
echo "<th>URL</th>";
echo "<td><input name=\"avatar\" type=\"text\" size=\"40\" maxlength=\"1000\" value=\"" . $t_avatar . "\" /></td>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=\"2\"><strong>Email Reminder Settings</strong></th>";
echo "</tr>";
echo "<tr>";
echo "<th>Email Address</th>";
echo "<td><input name=\"email\" type=\"text\" size=\"30\" maxlength=\"255\" value=\"" . $t_email . "\" /></td>";
echo "</tr>";
echo "<tr>";
echo "<th>Send Reminder Email?</th>";
$t_checked = "";
if ($t_show_reminder)
  $t_checked = " checked=\"yes\"";
echo "<td><input name=\"reminder\" type=\"checkbox\"" . $t_checked . "\" /></td>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=\"2\"><strong>Mobile View</strong></th>";
echo "</tr>";
echo "<tr>";
$t_checked = "";
if ($t_mobile_view)
  $t_checked = " checked=\"yes\"";
echo "<td><input name=\"mobileview\" type=\"checkbox\"" . $t_checked . "\" /></td>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=\"2\"><strong>Change Password</strong></th>";
echo "</tr>";
echo "<tr>";
echo "<th>Current</th>";
echo "<td><input type=\"password\" name=\"oldpassword\" /></td>";
echo "</tr>";
echo "<tr>";
echo "<th>New</th>";
echo "<td><input type=\"password\" name=\"newpassword\" /></td>";
echo "</table>";
echo "<br />";
echo "<input name=\"submit\" type=\"submit\" value=\"Save\" />";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
