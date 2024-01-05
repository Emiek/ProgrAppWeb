<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
/* po tym komentarzu będzie kod do dynamicznego ładowania stron */
if($_GET['idp'] == '') $strona = 'html/glowna.html';
if($_GET['idp'] == 'beginner') $strona = 'html/beginner.html';
if($_GET['idp'] == 'grunt') $strona = 'html/grunt.html';
if($_GET['idp'] == 'kontakt') $strona = 'html/kontakt.html';
if($_GET['idp'] == 'spinning') $strona = 'html/spinning.html';
if($_GET['idp'] == 'splawik') $strona = 'html/splawik.html';
if($_GET['idp'] == 'filmy') $strona = 'html/filmy.html';
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
            if(file_exists($strona)){
                include($strona);
            }
        ?>

        <?php
             $nr_indeksu = '164333';
             $nrGrupy = '1';
             echo 'Autor: Patryk Bachanek '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />';
        ?>

    </body>
</html>