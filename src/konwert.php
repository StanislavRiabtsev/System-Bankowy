<?php
session_start();
require 'kursyWalut.php';
require 'CurrencyConverter.php';

header('Content-Type: application/json');

$kwota = isset($_POST['kwota']) ? (float)$_POST['kwota'] : 0;
$walutaZ = $_POST['waluta_z'] ?? 'USD';
$walutaDo = $_POST['waluta_do'] ?? 'EUR';

$converter = new CurrencyConverter($kursyWalut);

$wynik = 0;

if ($kwota > 0) {
    try {
        $wynik = $converter->convert($kwota, $walutaZ, $walutaDo);

        $_SESSION['historia'][] = [
            'z' => $walutaZ,
            'do' => $walutaDo,
            'kwota' => $kwota,
            'wynik' => number_format($wynik, 2)
        ];

        setcookie('ostatnia_waluta_z', $walutaZ, time() + (86400 * 30), "/");
        setcookie('ostatnia_waluta_do', $walutaDo, time() + (86400 * 30), "/");
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}

echo json_encode([
    'result' => number_format($wynik, 2),
    'waluta_do' => $walutaDo
]);
