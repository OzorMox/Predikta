<html>

<head>
<title>Predikta</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>
<?php include("title"); ?>

<?php

echo "Clear the log?";
echo "<br>";
echo "<br>";
echo "Click OK to confirm";
echo "<br>";
echo "<form name=\"clearlog\" action=\"processclear.php\" method=\"post\">";
echo "<br>";
echo "<input type=\"submit\" value=\"OK\">";
echo "</form>";
echo "<a href=\"viewlog.php\">Back</a>";

?>

</center>
</body>

</html>
