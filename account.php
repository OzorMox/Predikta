<?php
  session_start();

  if ($_SESSION['username'] == "")
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

    $t_sql = "UPDATE `players` SET " . 
               "`email` = '" . $_POST['email'] . "', " . 
               "`avatar` = '" . $_POST['avatar'] . "', " . 
               "`send_reminder_email` = " . $t_reminder . " " . 
             "WHERE `name` = '" . mysql_real_escape_string($_SESSION['username']) . "'";

    mysql_query($t_sql);
  }

  $t_email = "";
  $t_show_reminder = false;
  $t_avatar = "";

  // Get account settings from database for this user
  $t_sql = "SELECT `email`, `send_reminder_email`, `avatar` FROM `players` " . 
	   "WHERE `name` = '" . mysql_real_escape_string($_SESSION['username']) . "'";

  $t_result = mysql_query($t_sql);
  
  if($t_row = mysql_fetch_assoc($t_result))
  {
    if($t_row['email'] != null && strlen($t_row['email']) > 0)
      $t_email = $t_row['email'];

    if($t_row['send_reminder_email'])
      $t_show_reminder = $t_row['send_reminder_email'];

    if($t_row['avatar'] != null && strlen($t_row['avatar']) > 0)
      $t_avatar = $t_row['avatar'];
  }
?>
<html>
<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?

include("title");

echo "<form name=\"accountsetings\" action=\"account.php\" method=\"post\">";
echo "Update your account settings.";
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
echo "<th>Send reminder email?</th>";
$t_checked = "";
if ($t_show_reminder)
  $t_checked = " checked=\"yes\"";
echo "<td><input name=\"reminder\" type=\"checkbox\"" . $t_checked . "\" /></td>";
echo "</tr>";
echo "</table>";
echo "<br />";
echo "<input name=\"submit\" type=\"submit\" value=\"Save Settings\" />";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
