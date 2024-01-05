<?php
 $nr_indeksu = '164333';
 $nrGrupy = '1';
 echo 'Patryk Bachanek' .$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
 echo 'Zastosowanie metody include() <br />';
 echo '<br/>Zadanie 2  <br />';
 echo 'a) Metoda include(), require_once() <br /> ';
 // Zadanie 2
echo ' include()  :<br /> ';
$color = '';
$fruit = '';
 echo "A $color $fruit <br />"; // A
 include 'vars.php';
 echo "A $color $fruit <br />";
echo 'require_once() <br /> ';
$s = require_once('fiddle.php');
echo "\n" . $s . '<br/>';
$s = require_once('fiddle.php');
echo "\n" . $s. "<br/>";
echo '<br/> B) if else elseif switch: <br/>';
$a = 1;
$b = 0;
if ($a > $b)
 echo "a is bigger than b";
elseif ($a == $b)
 echo "a and b are equal";
else
 echo "b is bigger";

echo "<br/>switch: <br/>";
$i = 1;
switch ($i) {
 case 0:
  echo "i equals 0";
  break;
 case 1:
  echo "i equals 1";
  break;
 case 2:
  echo "i equals 2";
  break;
}
echo '<br/>while i for <br/>';
$k = 1;
while ($k <= 10) {
 echo $k++.' ';
}
echo '<br/>';
for( $j=0; $j<5;$j++) {
 echo $j . ' ';
}
 echo '<br/>Hello ' . htmlspecialchars($_GET["name"]) . '!';

echo '<br/>sesja <br/>';
$value = 10;
$_SESSION["newsession"]=$value;
echo $_SESSION["newsession"];

echo '<br/>POST<br/>';
?>

<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
 Name: <input type="text" name="fname">
 <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // collect value of input field
 $name = $_POST['fname'];
 if (empty($name)) {
  echo "Name is empty";
 } else {
  echo 'Hello ' . htmlspecialchars($_POST["fname"]) . '!';
 }
}

?>

</body>
</html>