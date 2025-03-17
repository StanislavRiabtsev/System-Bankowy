<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Bank</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/modern-normalize.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="system-bankowy">
        <div class="container">
            <div class="container_bank">
                <img src="img/Logobank.png" alt="logo" class="system-bankowy__logo">
                <h1 class="title">Flow Bank</h1>
                <div class="account">
                    <a href="#" class="system-bankowy__btn_log">Login</a>
                    <a href="#" class="system-bankowy__btn_reg">Register</a>
                </div>
            </div>
        </div>
    </section>

    <nav class="services">
        <div class="container">
            <div class="services_button">
                <a href="#" class="services__btn">Card</a>
                <a href="#" class="services__btn">Credit</a>
                <a href="#" class="services__btn">Deposit</a>
                <a href="#" class="services__btn">Department</a>
                <a href="#" class="services__btn">Conversion</a>
            </div>
        </div>
    </nav>

    <section class="conversion">
        <div class="container">
            <h2 class="title__services">Conversion</h2>
            <ul class="currency">
                <li><img src="icons/united-states.png" alt="china" class="currency__icons"></li>
                <li>USD</li>
                <li><img src="icons/european-union.png" alt="china" class="currency__icons"></li>
                <li>EUR</li>
                <li><img src="icons/united-kingdom.png" alt="china" class="currency__icons"></li>
                <li>GBP</li>
                <li><img src="icons/canada.png" alt="china" class="currency__icons"></li>
                <li>CAD</li>
                <li><img src="icons/china.png" alt="china" class="currency__icons"></li>
                <li>CNY</li>
            </ul>
            <div class="conversion__input">

                <?php
                // Kursy walut względem PLN
                $kursyWalut = [
                    "USD" => 3.84,
                    "EUR" => 4.11,
                    "GBP" => 4.96,
                    "CAD" => 2.67,
                    "CNY" => 0.53
                ];

                $kwota = isset($_POST['kwota']) ? (float)$_POST['kwota'] : 0;
                $walutaZ = isset($_POST['waluta_z']) ? $_POST['waluta_z'] : 'USD';
                $walutaDo = isset($_POST['waluta_do']) ? $_POST['waluta_do'] : 'EUR';
                $wynik = 0;

                if ($kwota > 0 && isset($kursyWalut[$walutaZ]) && isset($kursyWalut[$walutaDo])) {
                    // Konwersja do PLN, a następnie do docelowej waluty
                    $kwotaWPLN = $kwota * $kursyWalut[$walutaZ];
                    $wynik = $kwotaWPLN / $kursyWalut[$walutaDo];
                }
                ?>

                <form method="post" class="conversion__form">
                    <label for="waluta_z" class="conversion__label">Currency you have:</label>
                    <select name="waluta_z" id="waluta_z" class="conversion__select">
                        <?php foreach ($kursyWalut as $waluta => $kurs) { ?>
                        <option value="<?php echo $waluta; ?>" <?php echo $waluta == $walutaZ ? 'selected' : ''; ?>>
                            <?php echo $waluta; ?>
                        </option>
                        <?php } ?>
                    </select>

                    <label for="waluta_do" class="conversion__label">Currency you are exchanging for:</label>
                    <select name="waluta_do" id="waluta_do" class="conversion__select">
                        <?php foreach ($kursyWalut as $waluta => $kurs) { ?>
                        <option value="<?php echo $waluta; ?>" <?php echo $waluta == $walutaZ ? 'selected' : ''; ?>>
                            <?php echo $waluta; ?>
                        </option>
                        <?php } ?>
                    </select>

                    <label for="kwota" class="conversion__label">Currency Quantity:</label>
                    <input type="number" name="kwota" id="kwota" class="conversion__input-do"
                        value="<?php echo $kwota; ?>">


                    <button type="submit" class="conversion__btn">Calculate</button>

                </form>
                <?php if ($kwota > 0) { ?>
                <p class="result">Result: <?php echo number_format($wynik, 2); ?> <?php echo $walutaDo; ?></p>
                <?php } ?>

            </div>
        </div>
    </section>

</body>

</html>