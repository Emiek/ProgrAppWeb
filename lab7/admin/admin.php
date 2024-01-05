<?php
include_once '../cfg.php';

function FormularzLogowania()
{
    $wynik = '
    <div class="logowanie" xmlns="http://www.w3.org/1999/html">
     <h1 class="heading">Panel CMS:</h1>
      <div class="logowanie">
       <form method="post" name="LoginForm" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '"
        <table class="logowanie"
         <tr><td class="log4_t">[email]</td><td><input type="text" name="login_email" class="logowanie"/></td></tr>
         <tr><td class="log4_t">[haslo]</td><td><input type="password" name="login_pass" class="logowanie"/></td></tr>
         <tr><td>&nbsp</td><td><input type="submit" name="x1_submit" class="logowanie" value="zaloguj"/></td></tr>
        </table>
       </form>
      </div>
    </div>
    ';
    return $wynik;
}

function ListaPodstron()
{
    $conn = db_connect();
    $query = "SELECT id, page_title, page_content, status FROM page_list ORDER BY id ASC LIMIT 100";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id, $page_title, $page_content, $status);
    while ($stmt->fetch()) {
        echo '<div class="page-entry" style="display: flex;align-items: center;">
            <p>' . $id . ' ' . $page_title . '        
            <form action="" method="post" style="margin-left: 10px">
                <input type="hidden" name="id_to_update" value="' . $id . '">
                <input type=submit name=update value=edytuj> 
                <input type=submit name=delete value=usuń>
            </form>
            </p></div>';
    }
    $conn->close();

}

function EdytujPodstrone($id)
{
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT page_title, page_content, status FROM page_list WHERE id = ? LIMIT 1");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($page_title, $page_content, $status);
    $stmt->fetch();
    $conn->close();
    echo '<form action="" method="post" style="text-align: center">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" value="' . htmlspecialchars($page_title) . '"
               required>
        <p></p>
        <label for="content">Treść:</label>
        <p></p>
        <textarea id="content" name="content" rows="20" cols="100"
                  required>' . htmlspecialchars($page_content).'</textarea>
        <p></p>
        <label>
            <input type="checkbox" name="status" ' . ($status ? 'checked' : '') . ' >
            Aktywna
        </label>
        <p></p>
        <input type="submit" name="save"value="Zapisz zmiany">
        <input type="hidden" name="id_to_update" value="' . $id . '">
    </form>';

}

function DodajNowaPodstrone()
{

    echo '<form action="" method="post" style="text-align: center">
            <label for="nowyTytul">Nowy Tytuł:</label>
            <input type="text" id="nowyTytul" name="nowyTytul" required>
            <p></p>
            <label for="nowaZawartosc">Nowa Treść:</label>
            <p></p>
            <textarea id="nowaZawartosc" name="nowaZawartosc" rows="20" cols="100" required></textarea>
            <p></p>
            <input type="submit" name="DodajNowaPodstrone" value="Dodaj nową podstronę">
        </form>';
}

function UsunPodstrone($id)
{
    $conn = db_connect();
    $stmt = $conn->prepare("DELETE FROM page_list WHERE id = ? LIMIT 1");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'Podstrona została usunięta.';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo 'Błąd podczas usuwania podstrony.';
    }

    $conn->close();
}

global $login, $pass;
session_start();
if (!isset($_SESSION['zalogowany'])) {
    $_SESSION['zalogowany'] = false;
}
if ($_SESSION['zalogowany'] !== true) {
    if (isset($_POST['login_email'])) {
        if ($_POST['login_email'] == $login && $_POST['login_pass'] == $pass) {
            $_SESSION['zalogowany'] = true;
        } else {
            echo FormularzLogowania();
        }
    } else {
        echo FormularzLogowania();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="../css/style.css">
    <meta http-equiv="Content-Language" content="pl"/>
    <meta name="Author" content="Patryk Bachanek"/>
    <title>Admin panel</title>
</head>
<body>
<?php

if ($_SESSION['zalogowany'] === true) {
    ListaPodstron();
    echo '<form method="post"><input type="submit" name="Dodaj" value="Dodaj"></form>';
    if (isset($_POST['Dodaj'])) {
        DodajNowaPodstrone();
    }
    if (isset($_POST['update'])) {
        $id = $_POST['id_to_update'];
        EdytujPodstrone($id);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
        $id = $_POST['id_to_update'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = isset($_POST["status"]) ? 1 : 0;
        $conn = db_connect();
        $stmt = $conn->prepare("UPDATE page_list SET page_title = ?, page_content = ?, status = ? WHERE id = ? LIMIT 1");

        $stmt->bind_param('ssii', $title, $content, $status, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo 'Zmiany zostały wprowadzone';
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo 'Brak zmian do zapisania';
        }
        $conn->close();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['DodajNowaPodstrone'])) {
        $nowyTytul = $_POST["nowyTytul"];
        $nowaZawartosc = $_POST["nowaZawartosc"];

        $conn = db_connect();
        $stmt = $conn->prepare("INSERT INTO page_list (page_title, page_content, status) VALUES (?, ?, ?)");

        $statusNowejPodstrony = 1; // Domyślnie ustaw na aktywną, możesz dostosować według potrzeb

        $stmt->bind_param('ssi', $nowyTytul, $nowaZawartosc, $statusNowejPodstrony);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo 'Nowa podstrona została dodana.';
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo 'Błąd podczas dodawania nowej podstrony.';
        }
        $conn->close();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        $idToDelete = $_POST['id_to_update'];
        UsunPodstrone($idToDelete);
    }
}

?>
</body>
</html>

