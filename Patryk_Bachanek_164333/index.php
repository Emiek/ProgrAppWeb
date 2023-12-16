<?php
include 'showpage.php';
include 'cfg.php';
$conn = db_connect();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
/* po tym komentarzu będzie kod do dynamicznego ładowania stron */
if($_GET['idp'] == '') $strona = PokazPodstrone(7,$conn);
if($_GET['idp'] == 'beginner') $strona = PokazPodstrone(1,$conn);
if($_GET['idp'] == 'grunt') $strona = PokazPodstrone(3,$conn);
if($_GET['idp'] == 'kontakt') $strona = PokazPodstrone(5,$conn);
if($_GET['idp'] == 'spinning') $strona = PokazPodstrone(2,$conn);
if($_GET['idp'] == 'splawik') $strona = PokazPodstrone(4,$conn);
if($_GET['idp'] == 'filmy') $strona = PokazPodstrone(6,$conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="css/style.css">
        <meta http-equiv="Content-Language" content="pl" />
        <meta name="Author" content="Patryk Bachanek" />
        <script src="js/kolorujtlo.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/timedate.js" type="text/javascript"></script>
        <title>Moje hobby to wędkarstwo</title>
    </head>
    <body onload="startclock()">
        <table class="menu">
            <tr>
                <td> <a href="index.php?idp="> Home </a></td>
                <td> <a href="index.php?idp=beginner"> Wędkarstwo jak zacząć </a></td>
                <td> <a href="index.php?idp=spinning"> Spinning </a></td>
                <td> <a href="index.php?idp=grunt"> Grunt </a></td>
                <td> <a href="index.php?idp=splawik"> Spławik </a></td>
                <td> <a href="index.php?idp=kontakt"> Kontakt </a></td>
                <td> <a href="index.php?idp=filmy"> Filmy </a></td>
            </tr>
        </table>
        <?php
            echo $strona;
        ?>

        <?php
             $nr_indeksu = '164333';
             $nrGrupy = '1';
             echo 'Autor: Patryk Bachanek '.$nr_indeksu.' grupa '.$nrGrupy.' wersja 1.6v <br /><br />';
        ?>

    </body>
</html>