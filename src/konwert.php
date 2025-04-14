<?php
require 'kursyWalut.php';
header('Content-Type: application/json');

$kwota = isset($_POST['kwota']) ? (float)$_POST['kwota'] : 0;
$walutaZ = $_POST['waluta_z'] ?? 'USD';
$walutaDo = $_POST['waluta_do'] ?? 'EUR';
$wynik = 0;

if ($kwota > 0 && isset($kursyWalut[$walutaZ]) && isset($kursyWalut[$walutaDo])) {
    $wynik = ($kwota / $kursyWalut[$walutaZ]) * $kursyWalut[$walutaDo];
}

echo json_encode([
    'result' => number_format($wynik, 2),
    'waluta_do' => $walutaDo
]);
