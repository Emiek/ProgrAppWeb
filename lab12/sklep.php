<?php
require_once 'cfg.php';


class Koszyk
{
    public function addToCard($produktId, $ilosc)
    {
        $nr = $this->getNextIndex();

        $_SESSION[$nr . '_0'] = $nr;
        $_SESSION[$nr . '_1'] = $produktId;
        $_SESSION[$nr . '_2'] = $ilosc;
        $_SESSION[$nr . '_3'] = time();
    }

    public function removeFromCard($index)
    {
        unset($_SESSION[$index . '_0']);
        unset($_SESSION[$index . '_1']);
        unset($_SESSION[$index . '_2']);
        unset($_SESSION[$index . '_3']);
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
}

session_start();

$koszyk = new Koszyk();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $produktId = $_POST['produkt_id'];
        $ilosc = $_POST['ilosc'];

        if ($_POST['action'] === 'add') {
            $koszyk->addToCard($produktId, $ilosc);
        } elseif ($_POST['action'] === 'remove') {
            $index = $_GET['index'];
            $koszyk->removeFromCard($index);
        }
    }
}

