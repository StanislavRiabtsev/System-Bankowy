<?php
session_start();
require 'db.php';
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

        $stmt = $pdo->prepare("INSERT INTO konwersje (kwota, waluta_z, waluta_do, wynik) VALUES (?, ?, ?, ?)");
        $stmt->execute([$kwota, $walutaZ, $walutaDo, number_format($wynik, 2)]);


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
