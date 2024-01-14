<?php
require_once 'cfg.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Koszyk
{
    public function addToCard($produktId, $ilosc, $produktName, $cena)
    {
        $index = $this->getNextIndex();

        $_SESSION['koszyk'][$index] = [
            'id' => $produktId,
            'nazwa' => $produktName,
            'ilosc' => $ilosc,
            'cena' => $cena,
            'time' => time(),
        ];
    }

    public function removeFromCard($index)
    {
        if (isset($_SESSION['koszyk'][$index])) {
            unset($_SESSION['koszyk'][$index]);
        }
    }

    private function getNextIndex()
    {
        if (!isset($_SESSION['count'])) {
            $_SESSION['count'] = 1;
        } else {
            $_SESSION['count']++;
        }

        return $_SESSION['count'];
    }

    public function editQuantity($index, $newIlosc)
    {
        if (isset($_SESSION['koszyk'][$index])) {
            $_SESSION['koszyk'][$index]['ilosc'] = $newIlosc;
        }
    }

    public function calculateTotalValue()
    {
        $totalValue = 0;
        if (!empty($_SESSION['koszyk'])) {
            foreach ($_SESSION['koszyk'] as $item) {
                $totalValue += $item['ilosc'] * $item['cena'];
            }
        }
        return $totalValue;
    }

    public function showCard()
    {
        echo '<h2>Zawartość koszyka</h2>';
        if (empty($_SESSION['koszyk'])) {
            echo '<p>Koszyk jest pusty.</p>';
        } else {
            echo '<table border="1">
                    <tr>
                        <th>Nazwa Produktu</th>
                        <th>Ilość</th>
                        <th>Cena jednostkowa</th>
                        <th>Wartość</th>
                        <th>Akcje</th>
                    </tr>';

            foreach ($_SESSION['koszyk'] as $index => $item) {
                echo '<tr>';
                echo '<td>' . $item['nazwa'] . '</td>';
                echo '<td>' . $item['ilosc'] . '</td>';
                echo '<td>' . $item['cena'] . '</td>';
                echo '<td>' . ($item['ilosc'] * $item['cena']) . '</td>';
                echo '<td>
                        <form action="" method="post" style="display: inline-block;">
                            <input type="hidden" name="indexUsun" value="' . $index . '">
                            <input type="submit" name="UsunZkoszyk" value="Usuń">
                        </form>
                        <form action="" method="post" style="display: inline-block;">
                            <input type="hidden" name="indexEdytuj" value="' . $index . '">
                            <input type="number" name="newIlosc" value="' . $item['ilosc'] . '" min="1">
                            <input type="submit" name="EdytujIlosc" value="Zmień ilość">
                        </form>
                      </td>';
                echo '</tr>';
            }

            echo '<tr>
                    <td colspan="3"><strong>Łączna wartość koszyka:</strong></td>
                    <td>' . $this->calculateTotalValue() . '</td>
                    <td></td>
                  </tr>';
            echo '</table>';
        }
    }

}

$koszyk = new Koszyk();

function ListaProduktow()
{
    $conn = db_connect();
    $query = "SELECT p.id, p.tytul, p.opis, p.cena_netto, p.podatek_vat, p.ilosc_dostepnych_sztuk, gabaryt_produktu, p.zdjecie_url, k.nazwa as nazwa_kategorii FROM produkty p
                  LEFT JOIN kategorie k ON p.kategoria = k.id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id, $tytul, $opis, $cena_netto, $podatek_vat, $ilosc_dostepnych_sztuk, $gabaryt_produktu, $zdjecie_url, $nazwa_kategorii);


    echo '<table border="1">
                <tr>
                    <th>Tytuł</th>
                    <th>Opis</th>
                    <th>Ilość Dostępnych Sztuk</th>
                    <th>Gabaryt Produktu</th>
                    <th>Cena brutto</th>
                    <th>Zdjęcie</th>
                    <th>Nazwa Kategorii</th>
                </tr>';
    while ($stmt->fetch()) {
        $cena_brutto = $cena_netto + ($podatek_vat / 100 * $cena_netto);
        echo '<tr>';
        echo '<td>' . $tytul . '</td>';
        echo '<td>' . $opis . '</td>';
        echo '<td>' . $ilosc_dostepnych_sztuk . '</td>';
        echo '<td>' . $gabaryt_produktu . '</td>';
        echo '<td>' . $cena_brutto . '</td>';
        echo '<td><img style="max-height: 100px; max-width: 100px"src="' . $zdjecie_url . '" alt="Zdjęcie"></td>';
        echo '<td>' . $nazwa_kategorii . '</td>';

        echo '<td>
                <form action="" method="post" style="display: inline-block;">
                    <input type="hidden" name="idDodaj" value="' . $id . '">
                    <input type="hidden" name="tytul_p" value="' . $tytul . '">
                    <input type="hidden" name="cena_b" value="' . $cena_brutto . '">
                    <input type="number" name="iloscProduktow" value="1" min="1">
                    <input type="submit" name="DodajKoszyk" value="Dodaj do koszyka">
                </form>
              </td>';
        echo '</tr>';
    }

    echo '</table>';
}

if (isset($_POST['DodajKoszyk'])) {
    $produktId = $_POST['idDodaj'];
    $produktName = $_POST['tytul_p'];
    $ilosc = $_POST['iloscProduktow'];
    $cena = $_POST['cena_b'];
    $koszyk->addToCard($produktId, $ilosc, $produktName, $cena);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Obsługa usuwania produktu z koszyka
if (isset($_POST['UsunZkoszyk'])) {
    $indexUsun = $_POST['indexUsun'];
    $koszyk->removeFromCard($indexUsun);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Obsługa zmiany ilości produktu w koszyku
if (isset($_POST['EdytujIlosc'])) {
    $indexEdytuj = $_POST['indexEdytuj'];
    $newIlosc = $_POST['newIlosc'];
    $koszyk->editQuantity($indexEdytuj, $newIlosc);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="css/style.css">
    <meta http-equiv="Content-Language" content="pl"/>
    <meta name="Author" content="Patryk Bachanek"/>
    <title>Admin panel</title>
</head>
<body>
<?php
$koszyk->showCard();
echo '<br/><br/>';
ListaProduktow();
?>
</body>
</html>
