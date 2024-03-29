<?php
include_once '../cfg.php';

// ----------------------------//
//    FormularzLogowania       //
// metoda ta tworzy formularz  //
// logowania html i zwaraca go //
//-----------------------------//
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

// ----------------------------//
//       ListaPodstron          //
// metoda ta wyświetla listę   //
// stron z opcjami edycji lub   //
// usunięcia każdej strony.     //
// Pobiera dane z bazy danych   //
// i generuje kod HTML.         //
// ----------------------------//
function ListaPodstron()
{
    $conn = db_connect();
    $query = "SELECT id, page_title, page_content, status FROM page_list ORDER BY id ASC LIMIT 100";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id, $page_title, $page_content, $status);
    echo '<div style="width: 100%">';
    while ($stmt->fetch()) {
        echo '<div class="page-entry" style="margin: 0 auto; display: flex;align-items: center; width: 300px;">
            <p>' . htmlspecialchars($id) . ' ' . htmlspecialchars($page_title) . '        
            <form action="" method="post" style="margin-left: 10px">
                <input type="hidden" name="id_to_update" value="' . htmlspecialchars($id) . '">
                <input type=submit name=update value=edytuj> 
                <input type=submit name=delete value=usuń>
            </form>
            </p></div>';
    }
    echo '</div>';
    $conn->close();

}

// ----------------------------//
//     EdytujPodstrone          //
// metoda ta wyświetla formularz//
// do edycji istniejącej strony.//
// Pobiera dane strony z bazy   //
// danych na podstawie podanego //
// ID.                          //
// parametr int $id ID strony do  //
// edycji.                      //
// ----------------------------//
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
                  required>' . htmlspecialchars_decode($page_content) . '</textarea>
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

// ----------------------------//
//    DodajNowaPodstrone        //
// metoda ta wyświetla formularz//
// do dodawania nowej strony.    //
// Zapewnia pola do wprowadzenia //
// tytułu i treści nowej strony. //
// ----------------------------//
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

// ----------------------------//
//      UsunPodstrone           //
// metoda ta usuwa stronę na   //
// podstawie podanego ID.       //
// parametr int $id ID strony do  //
// usunięcia.                   //
// ----------------------------//
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
$login = htmlspecialchars($login);
$pass = htmlspecialchars($pass);
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


class ZarzadzajKategoriami
{
    private $conn;

    public function __construct()
    {
        // Utwórz połączenie z bazą danych
        $this->conn = db_connect();
    }

    public function __destruct()
    {
        // Zamknij połączenie z bazą danych po zakończeniu działania skryptu
        if ($this->conn) {
            $this->conn->close();
        }
    }

    // Dodaj nową kategorię
    public function DodajKategorie($matka, $nazwa)
    {
        $query = "INSERT INTO kategorie (matka, nazwa) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('is', $matka, $nazwa);
        $stmt->execute();
        $stmt->close();
    }

    // Usuń kategorię
    public function UsunKategorie($kategoriaId)
    {
        $query = "DELETE FROM kategorie WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $kategoriaId);
        $stmt->execute();
        $stmt->close();
    }

    // Edytuj kategorię
    public function EdytujKategorie($kategoriaId, $nazwa)
    {
        $query = "UPDATE kategorie SET nazwa = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('si', $nazwa, $kategoriaId);
        $stmt->execute();
        $stmt->close();
    }

    // Pokaż kategorie (generuj drzewo kategorii)
    public function PokazKategorie()
    {
        $this->GenerujDrzewoKategorii();
    }

    // Prywatna funkcja do generowania drzewa kategorii
    private function GenerujDrzewoKategorii($matka = 0)
    {
        $query = "SELECT id, nazwa, matka FROM kategorie WHERE matka = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $matka);
        $stmt->execute();
        $stmt->bind_result($id, $nazwa, $matka);
        $stmt->store_result();
        echo '<div style="width: 500px; margin: 0 auto;">';
        echo '<ul>';
        while ($stmt->fetch()) {
            echo '<li>' . $nazwa . ' (id: ' . $id . '), (matka: ' . $matka . ')';
            $this->GenerujDrzewoKategorii($id);
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';

        $stmt->close();
    }
}


$zarzadzajKategoriami = new ZarzadzajKategoriami();


if (isset($_POST['DodajKategorie'])) {
    $matka = $_POST['matkaId'];
    $nazwa = $_POST['nazwaKategorii'];
    $zarzadzajKategoriami->DodajKategorie($matka, $nazwa);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Obsługa formularza usuwania kategorii
if (isset($_POST['UsunKategorie'])) {
    $kategoriaId = $_POST['kategoriaId'];
    $zarzadzajKategoriami->UsunKategorie($kategoriaId);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


if (isset($_POST['EdytujKategorie'])) {
    $kategoriaId = $_POST['kategoriaIdEdytuj'];
    $nowaNazwa = $_POST['nowaNazwa'];
    $zarzadzajKategoriami->EdytujKategorie($kategoriaId, $nowaNazwa);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


class ZarzadzajProduktami
{
    private $conn;

    public function __construct()
    {

        $this->conn = db_connect();
    }

    public function __destruct()
    {

        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function DodajProdukt($tytul, $opis, $dataWygasniecia, $cenaNetto, $podatekVat, $iloscSztuk, $kategoria, $gabarytProduktu, $SciezkaZdjecia)
    {

        $query = "INSERT INTO produkty (tytul, opis, data_wygasniecia, cena_netto, podatek_vat, ilosc_dostepnych_sztuk, kategoria, gabaryt_produktu, zdjecie_url) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssdidiss', $tytul, $opis, $dataWygasniecia, $cenaNetto, $podatekVat, $iloscSztuk, $kategoria, $gabarytProduktu, $SciezkaZdjecia);
        $stmt->execute();
        $stmt->close();

    }

    public function UsunProdukt($produktId)
    {
        $query = "DELETE FROM produkty WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $produktId);
        $stmt->execute();
        $stmt->close();
    }

    public function EdytujProdukt($produktId, $tytul, $opis, $dataWygasniecia, $cenaNetto, $podatekVat, $iloscSztuk, $kategoria, $gabarytProduktu, $zdjecieUrl)
    {
        $query = "UPDATE produkty SET tytul = ?, opis = ?, data_wygasniecia = ?, cena_netto = ?, podatek_vat = ?, 
                  ilosc_dostepnych_sztuk = ?, kategoria = ?, gabaryt_produktu = ?, zdjecie_url = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssdidissi', $tytul, $opis, $dataWygasniecia, $cenaNetto, $podatekVat, $iloscSztuk, $kategoria, $gabarytProduktu, $zdjecieUrl, $produktId);
        $stmt->execute();
        $stmt->close();
    }

    public function PobierzDaneProduktu($produktId)
    {
        $query = "SELECT * FROM produkty WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $produktId);
        $stmt->execute();
        $result = $stmt->get_result();
        $produkt = $result->fetch_assoc();
        $stmt->close();

        return $produkt;
    }

    public function PokazProdukty()
    {
        $query = "SELECT p.*, k.nazwa as nazwa_kategorii FROM produkty p
                  LEFT JOIN kategorie k ON p.kategoria = k.id";
        $result = $this->conn->query($query);
        echo '<div style="width: 90%; margin: 0 auto;">';
        echo '<table border="1">
                <tr>
                    <th>ID</th>
                    <th>Tytuł</th>
                    <th>Opis</th>
                    <th>Data Utworzenia</th>
                    <th>Data Modyfikacji</th>
                    <th>Data Wygaśnięcia</th>
                    <th>Cena Netto</th>
                    <th>Podatek VAT</th>
                    <th>Ilość Dostępnych Sztuk</th>
                    <th>Status Dostępności</th>
                    <th>Kategoria</th>
                    <th>Gabaryt Produktu</th>
                    <th>Zdjęcie</th>
                    <th>Nazwa Kategorii</th>
                </tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            foreach ($row as $key => $value) {
                if ($key === 'zdjecie_url') {
                    echo '<td><img style="max-height: 100px; max-width: 100px"src="' . $value . '" alt="Zdjęcie"></td>';
                } else {
                    echo '<td>' . $value . '</td>';
                }
            }
            echo '<td>
                <form action="" method="post" style="display: inline-block;">
                    <input type="hidden" name="idEdytuj" value="' . $row['id'] . '">
                    <input type="submit" name="edytujProdukt" value="Edytuj">
                </form>
                <form action="" method="post" style="display: inline-block;">
                    <input type="hidden" name="idUsun" value="' . $row['id'] . '">
                    <input type="submit" name="usunProdukt" value="Usuń">
                </form>
              </td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
    }
}

$zarzadzajProduktami = new ZarzadzajProduktami();

if (isset($_POST['dodajProdukt'])) {
    $tytul = $_POST['tytul'];
    $opis = $_POST['opis'];
    $dataWygasniecia = $_POST['dataWygasniecia'];
    $cenaNetto = $_POST['cenaNetto'];
    $podatekVat = $_POST['podatekVat'];
    $iloscSztuk = $_POST['iloscSztuk'];
    $kategoria = $_POST['kategoria'];
    $gabarytProduktu = $_POST['gabarytProduktu'];
    $zdjecieTmpPath = $_FILES['zdjecieUrl']['tmp_name'];
    $zdjecieName = $_FILES['zdjecieUrl']['name'];

    // Nowa ścieżka do zapisania zdjęcia
    $nowaSciezkaZdjecia = 'uploads/' . $zdjecieName;

    // Przenieś plik do docelowej lokalizacji
    if (move_uploaded_file($zdjecieTmpPath, $nowaSciezkaZdjecia)) {
        // Dodaj nowy produkt do bazy danych, uwzględniając nową ścieżkę do zdjęcia
        $zarzadzajProduktami->DodajProdukt($tytul, $opis, $dataWygasniecia, $cenaNetto, $podatekVat, $iloscSztuk, $kategoria, $gabarytProduktu, $nowaSciezkaZdjecia);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo 'Błąd podczas przesyłania zdjęcia.';
    }
}


if (isset($_POST['usunProdukt'])) {
    $idUsun = $_POST['idUsun'];

    $zarzadzajProduktami->UsunProdukt($idUsun);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="../css/style_admin.css">
    <meta http-equiv="Content-Language" content="pl"/>
    <meta name="Author" content="Patryk Bachanek"/>
    <title>Admin panel</title>
</head>
<body>
<?php

if ($_SESSION['zalogowany'] === true) {
    echo '<h2 style="text-align: center">Zarządzanie stronami</h2>';
    ListaPodstron();
    echo '<form style="width: 300px; margin: 0 auto; display: block;" method="post"><input type="submit" name="Dodaj" value="Dodaj"></form>';
    echo '<br/><br/>';
    if (isset($_POST['Dodaj'])) {
        DodajNowaPodstrone();
    }
    if (isset($_POST['update'])) {
        $id = $_POST['id_to_update'];
        EdytujPodstrone($id);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
        $id = htmlspecialchars($_POST['id_to_update']);
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars_decode($_POST['content']);
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

        $statusNowejPodstrony = 1;

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

    if (isset($_POST['zapiszEdycje'])) {
        $idEdytuj = $_POST['idEdytuj'];
        $nowyTytul = $_POST['tytul'];
        $nowyOpis = $_POST['opis'];
        $nowaDataWygasniecia = $_POST['dataWygasniecia'];
        $nowaCenaNetto = $_POST['cenaNetto'];
        $nowyPodatekVat = $_POST['podatekVat'];
        $nowaIloscSztuk = $_POST['iloscSztuk'];
        $nowaKategoria = $_POST['kategoria'];
        $nowyGabarytProduktu = $_POST['gabarytProduktu'];
        $zdjecieTmpPath = $_FILES['zdjecieUrl']['tmp_name'];
        $zdjecieName = $_FILES['zdjecieUrl']['name'];

        $nowaSciezkaZdjecia = 'uploads/' . $zdjecieName;

        if (move_uploaded_file($zdjecieTmpPath, $nowaSciezkaZdjecia)) {
            $zarzadzajProduktami->EdytujProdukt($idEdytuj, $nowyTytul, $nowyOpis, $nowaDataWygasniecia, $nowaCenaNetto, $nowyPodatekVat, $nowaIloscSztuk, $nowaKategoria, $nowyGabarytProduktu,  $nowaSciezkaZdjecia);
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo 'Błąd podczas przesyłania zdjęcia.';
        }

    }

    echo '<h2 style="text-align: center">Lista kategorii</h2>';

    $zarzadzajKategoriami->PokazKategorie();

    echo '
        <div style="margin: 0 auto; width: 900px;">
            <!-- Formularz dodawania kategorii -->
            <form method="post">
                <label for="matkaId">Kategoria nadrzędna (0 dla głównej): </label>
                <input type="number" name="matkaId" id="matkaId" required>
                <label for="nazwaKategorii">Nazwa kategorii: </label>
                <input type="text" name="nazwaKategorii" id="nazwaKategorii" required>
                <input type="submit" name="DodajKategorie" value="Dodaj kategorię">
            </form>
            
            <!-- Formularz usuwania kategorii -->
            <form method="post">
                <label for="kategoriaId">ID kategorii do usunięcia: </label>
                <input type="number" name="kategoriaId" id="kategoriaId" required>
                <input type="submit" name="UsunKategorie" value="Usuń kategorię">
            </form>
            
            <!-- Formularz edycji kategorii -->
            <form method="post">
                <label for="kategoriaIdEdytuj">ID kategorii do edycji: </label>
                <input type="number" name="kategoriaIdEdytuj" id="kategoriaIdEdytuj" required>
                <label for="nowaNazwa">Nowa nazwa kategorii: </label>
                <input type="text" name="nowaNazwa" id="nowaNazwa" required>
                <input type="submit" name="EdytujKategorie" value="Edytuj kategorię">
            </form>
        </div>';
    echo '
       <div style="margin: 0 auto; width: 300px;">
        <h2 style="text-align: center">Panel Zarządzania Produktami</h2>
        
        <!-- Dodawanie nowego produktu -->
        <form method="post" enctype="multipart/form-data" style="text-align: center" >
            <h3>Dodaj nowy produkt</h3>
            
            <label for="tytul">Tytuł:</label>
            <input type="text" id="tytul" name="tytul" required>
            <br>
            <label for="opis">Opis:</label>
            <textarea id="opis" name="opis" rows="4" required></textarea>
            <br>
            <label for="dataWygasniecia">Data Wygaśnięcia:</label>
            <input type="date" id="dataWygasniecia" name="dataWygasniecia">
            <br>
            <label for="cenaNetto">Cena Netto:</label>
            <input type="number" id="cenaNetto" name="cenaNetto" step="0.01" required>
            <br>
            <label for="podatekVat">Podatek VAT:</label>
            <input type="number" id="podatekVat" name="podatekVat" step="0.01" required>
            <br>
            <label for="iloscSztuk">Ilość Sztuk:</label>
            <input type="number" id="iloscSztuk" name="iloscSztuk" required>
            <br>
            <label for="kategoria">Kategoria:</label>
            <input type="number" id="kategoria" name="kategoria" required>
            <br>
            <label for="gabarytProduktu">Gabaryt Produktu:</label>
            <input type="text" id="gabarytProduktu" name="gabarytProduktu" required>
            <br>
            <label for="zdjecieUrl">Zdjęcie URL:</label>
            <input type="file" id="zdjecieUrl" name="zdjecieUrl" accept="image/*" required>
            <br>
            <input type="submit" name="dodajProdukt" value="Dodaj Produkt">
        </form>
        </div>
        
        <h2 style="text-align: center;">Lista Produktów</h2>';

    $zarzadzajProduktami->PokazProdukty();
    if (isset($_POST['edytujProdukt'])) {
        $idEdytuj = $_POST['idEdytuj'];

        $produktDoEdycji = $zarzadzajProduktami->PobierzDaneProduktu($idEdytuj);
        // formularz edycji z danymi produktu
        echo'<div style="margin: 0 auto; width: 300px;">';
        echo '<h2 style="text-align: center">Edytuj produkt o ID: ' . $idEdytuj . '</h2>';
        echo '<form method="post" enctype="multipart/form-data" style="text-align: center">';
        echo '<label for="tytul">Tytuł:</label>';
        echo '<input type="hidden" name="idEdytuj" value="' . $idEdytuj . '">';
        echo '<input type="text" id="tytul" name="tytul" value="' . htmlspecialchars($produktDoEdycji['tytul']) . '" required>';
        echo '<br>';
        echo '<label for="opis">Opis:</label>';
        echo '<textarea id="opis" name="opis" rows="4" required>' . htmlspecialchars($produktDoEdycji['opis']) . '</textarea>';
        echo '<br>';
        echo '<label for="dataWygasniecia">Data Wygaśnięcia:</label>';
        echo '<input type="text" id="dataWygasniecia" name="dataWygasniecia" value="' . htmlspecialchars($produktDoEdycji['data_wygasniecia']) . '" required>';
        echo '<br>';
        echo '<label for="cenaNetto">Cena Netto:</label>';
        echo '<input type="number" id="cenaNetto" name="cenaNetto" value="' . htmlspecialchars($produktDoEdycji['cena_netto']) . '" required>';
        echo '<br>';
        echo '<label for="podatekVat">Podatek VAT:</label>';
        echo '<input type="number" id="podatekVat" name="podatekVat" value="' . htmlspecialchars($produktDoEdycji['podatek_vat']) . '" required>';
        echo '<br>';
        echo '<label for="iloscSztuk">Ilość Dostępnych Sztuk:</label>';
        echo '<input type="number" id="iloscSztuk" name="iloscSztuk" value="' . htmlspecialchars($produktDoEdycji['ilosc_dostepnych_sztuk']) . '" required>';
        echo '<br>';
        echo '<label for="kategoria">Kategoria:</label>';
        echo '<input type="number" id="kategoria" name="kategoria" value="' . htmlspecialchars($produktDoEdycji['kategoria']) . '" required>';
        echo '<br>';
        echo '<label for="gabarytProduktu">Gabaryt Produktu:</label>';
        echo '<input type="text" id="gabarytProduktu" name="gabarytProduktu" value="' . htmlspecialchars($produktDoEdycji['gabaryt_produktu']) . '" required>';
        echo '<br>';
        echo 'Akutalne zdjecie:';
        echo '<br>';
        echo '<img style="max-height: 100px; max-width: 100px" src="' . $produktDoEdycji['zdjecie_url'] . '" alt="Obecne Zdjęcie">';
        echo '<br>';
        echo '<label for="zdjecieUrl">Zdjęcie URL:</label>';
        echo '<input type="file" id="zdjecieUrl" name="zdjecieUrl" accept="image/*" required>';
        echo '<br>';
        echo '<input type="submit" name="zapiszEdycje" value="Zapisz Edycję">';
        echo '</form>';
        echo '</div>';
    }

}

?>
</body>
</html>
