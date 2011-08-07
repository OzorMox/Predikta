<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?

include("title");

echo "<form name=\"changepassword\" action=\"processpassword.php\" method=\"post\">";
echo "Enter your current password";
echo "<br>";
echo "<br>";
echo "<input type=\"password\" name=\"oldpassword\" />";
echo "<br>";
echo "<br>";
echo "Enter your new password";
echo "<br>";
echo "<br>";
echo "<input type=\"password\" name=\"newpassword\" />";
echo "<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"index.php\">Back</a>";

?>

</center>
</body>

</html>
