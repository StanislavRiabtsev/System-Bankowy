<?php
session_start();
require 'kursyWalut.php';
require 'db.php';

$walutaZ = $_COOKIE['ostatnia_waluta_z'] ?? ($_POST['waluta_z'] ?? 'USD');
$walutaDo = $_COOKIE['ostatnia_waluta_do'] ?? ($_POST['waluta_do'] ?? 'EUR');
$kwota = $_POST['kwota'] ?? '';

$historia = [];
try {
    $stmt = $pdo->query("SELECT * FROM konwersje ORDER BY id DESC LIMIT 10");
    $historia = $stmt->fetchAll();
} catch (Exception $e) {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Flow Bank</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/modern-normalize.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/index-DjRj7FCh.css" />
    <style>
    body {
        font-family: "Inter", sans-serif !important;
    }
    </style>
</head>

<body>
    <section class="system-bankowy">
        <div class="container">
            <div class="container_bank">
                <div class="logo__title">
                    <img src="img/Logobank.png" alt="logo" class="system-bankowy__logo" />
                    <h1 class="title">Flow Bank</h1>
                </div>
                <div class="account">
                    <a href="login.html" class="btn__log">Login</a>
                    <a href="register.html" class="btn__reg">Register</a>
                </div>
            </div>
        </div>
    </section>

    <nav class="services">
        <div class="container">
            <div class="services_button">
                <a href="#" class="services__btn"><span>Card</span></a>
                <a href="#" class="services__btn"><span>Credit</span></a>
                <a href="#" class="services__btn"><span>Deposit</span></a>
                <a href="#" class="services__btn"><span>Department</span></a>
                <a href="#Change" class="services__btn"><span>Conversion</span></a>
            </div>
        </div>
    </nav>

    <section class="about">
        <div class="container">
            <h2 class="about__title">About bank </h2>
            <h3 class="about__title-bank">FlowBank: A Swiss Digital Banking and Trading Platform</h3>
            <p class="about__text">
                FlowBank is a Swiss fintech company that operates as both a digital bank and a broker, offering a
                comprehensive suite of financial services. Founded in 2020, FlowBank secured a full Swiss banking
                license
                and launched its operations later that year. The company is headquartered in Geneva and is regulated by
                the Swiss Financial Market Supervisory Authority (FINMA).
            </p>
            <h3 class="about__title-bank">Key Features of FlowBank:</h3>
            <ul class="about__list">
                <li class="about__list-li">
                    Digital Banking: FlowBank provides online banking services, including multi-currency accounts and
                    credit
                    cards, all accessible through a mobile app. This allows users to manage their finances digitally
                    without
                    the need for physical branches.
                </li>
                <li class="about__list-li">
                    Trading Platform: FlowBank offers a robust trading platform, FlowBank Pro, which caters to both
                    beginner
                    and advanced investors. The platform supports trading in a wide range of financial instruments,
                    including stocks, bonds, ETFs, options, futures, forex, commodities, and CFDs. Users can access
                    these
                    services via desktop, mobile, or web applications.
                </li>
                <li class="about__list-li">
                    Low Fees: FlowBank is known for its competitive fee structure, making it an attractive option for
                    traders.
                    It charges a custody fee of 0.10% with a minimum of CHF 40 and a maximum of CHF 200. Broker fees are
                    also
                    relatively low, with a commission of CHF 6.50 on shares or ETFs traded on the Swiss stock exchange.
                </li>
                <li class="about__list-li">
                    Security and Regulation: FlowBank emphasizes security, with deposits guaranteed up to CHF 100,000.
                    It uses
                    bank-grade security measures and is ISO27001 certified, ensuring high standards of data protection.
                </li>
            </ul>
        </div>
    </section>

    <section class="conversion">
        <div class="container">
            <h2 id="Change" class="title__services">Conversion</h2>
            <ul class="currency">
                <li class="currency__item">
                    <img src="icons/united-states.png" alt="USD" class="currency__icons" />
                    <span>USD</span>
                </li>
                <li class="currency__item">
                    <img src="icons/european-union.png" alt="EUR" class="currency__icons" />
                    <span>EUR</span>
                </li>
                <li class="currency__item">
                    <img src="icons/united-kingdom.png" alt="GBP" class="currency__icons" />
                    <span>GBP</span>
                </li>
                <li class="currency__item">
                    <img src="icons/canada.png" alt="CAD" class="currency__icons" />
                    <span>CAD</span>
                </li>
                <li class="currency__item">
                    <img src="icons/china.png" alt="CNY" class="currency__icons" />
                    <span>CNY</span>
                </li>
            </ul>

            <form id="conversionForm" class="conversion__form" method="POST" action="konwert.php">
                <label for="waluta_z" class="conversion__label">Currency you have:</label>
                <select name="waluta_z" id="waluta_z" class="conversion__select">
                    <?php foreach ($kursyWalut as $waluta => $kurs) : ?>
                    <option value="<?= htmlspecialchars($waluta) ?>" <?= $waluta == $walutaZ ? 'selected' : '' ?>>
                        <?= htmlspecialchars($waluta) ?>
                    </option>
                    <?php endforeach; ?>
                </select>

                <label for="waluta_do" class="conversion__label">Currency you are exchanging for:</label>
                <select name="waluta_do" id="waluta_do" class="conversion__select">
                    <?php foreach ($kursyWalut as $waluta => $kurs) : ?>
                    <option value="<?= htmlspecialchars($waluta) ?>" <?= $waluta == $walutaDo ? 'selected' : '' ?>>
                        <?= htmlspecialchars($waluta) ?>
                    </option>
                    <?php endforeach; ?>
                </select>

                <label for="kwota" class="conversion__label">Currency Quantity:</label>
                <input type="number" step="any" min="0" name="kwota" id="kwota" class="conversion__input-do"
                    value="<?= htmlspecialchars($kwota) ?>" required />

                <button type="submit" class="conversion__btn">Calculate</button>
            </form>

            <div id="resultBox" class="mt-3">
                <?php
                if (isset($_SESSION['conversion_result'])) {
                    echo '<strong>Result: </strong>' . htmlspecialchars($_SESSION['conversion_result']) . ' ' . htmlspecialchars($_SESSION['conversion_currency']);
                    unset($_SESSION['conversion_result'], $_SESSION['conversion_currency']);
                }
                ?>
            </div>

            <?php if (!empty($historia)) : ?>
            <div class="conversion__history mt-4">
                <h3>Conversion History</h3>
                <ul class="list-group">
                    <?php foreach ($historia as $item) : ?>
                    <li class="list-group-item">
                        <?= htmlspecialchars($item['kwota']) ?> <?= htmlspecialchars($item['waluta_z']) ?> →
                        <?= htmlspecialchars($item['wynik']) ?> <?= htmlspecialchars($item['waluta_do']) ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <footer class="bg-dark text-light text-center p-4">
        <p>&copy; 2025 Twoja Firma. Wszelkie права zastrzeżone.</p>
    </footer>

    <div id="root"></div>

    <script type="module" src="index-DeWhnzFy.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>