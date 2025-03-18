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
                    <a href="#" class="system-bankowy__btn_log btn_animation">Login</a>
                    <a href="#" class="system-bankowy__btn_reg btn_animation">Register</a>
                </div>
            </div>
        </div>
    </section>

    <nav class="services">
        <div class="container">
            <div class="services_button">
                <a href="#" class="services__btn btn_ser-an">Card</a>
                <a href="#" class="services__btn btn_ser-an">Credit</a>
                <a href="#" class="services__btn btn_ser-an">Deposit</a>
                <a href="#" class="services__btn btn_ser-an">Department</a>
                <a href="#Change" class="services__btn btn_ser-an">Conversion</a>
            </div>
        </div>
    </nav>

    <section class="about">
        <div class="container">
            <h2 class="about__title">About bank </h2>
            <h3 class="about__title-bank">FlowBank: A Swiss Digital Banking and Trading Platform</h3>
            <p class="about__text">FlowBank is a Swiss fintech company that operates as both a digital bank and a
                broker, offering a
                comprehensive suite of financial services. Founded in 2020, FlowBank secured a full Swiss banking
                license and launched its operations later that year. The company is headquartered in Geneva and is
                regulated by the Swiss Financial Market Supervisory Authority (FINMA).</p>
            <h3 class="about__title-bank">Key Features of FlowBank:</h3>
            <ul class="about__list">
                <li class="about__list-li">Digital Banking: FlowBank provides online banking services, including
                    multi-currency accounts and
                    credit cards, all accessible through a mobile app. This allows users to manage their finances
                    digitally without the need for physical branches.</li>
                <li class="about__list-li">Trading Platform: FlowBank offers a robust trading platform, FlowBank Pro,
                    which caters to both
                    beginner and advanced investors. The platform supports trading in a wide range of financial
                    instruments, including stocks, bonds, ETFs, options, futures, forex, commodities, and CFDs. Users
                    can access these services via desktop, mobile, or web applications.</li>
                <li class="about__list-li">Low Fees: FlowBank is known for its competitive fee structure, making it an
                    attractive option for
                    traders. It charges a custody fee of 0.10% with a minimum of CHF 40 and a maximum of CHF 200. Broker
                    fees are also relatively low, with a commission of CHF 6.50 on shares or ETFs traded on the Swiss
                    stock exchange.</li>
                <li class="about__list-li">Security and Regulation: FlowBank emphasizes security, with deposits
                    guaranteed up to CHF 100,000.
                    It uses bank-grade security measures and is ISO27001 certified, ensuring high standards of data
                    protection.</li>
            </ul>
        </div>
    </section>

    <section class="conversion">
        <div class="container">
            <h2 id="Change" class="title__services">Conversion</h2>
            <ul class="currency">
                <li class="currency__list"><img src="icons/united-states.png" alt="china" class="currency__icons"></li>
                <li class="currency__list">USD</li>
                <li class="currency__list"><img src="icons/european-union.png" alt="china" class="currency__icons"></li>
                <li class="currency__list">EUR</li>
                <li class="currency__list"><img src="icons/united-kingdom.png" alt="china" class="currency__icons"></li>
                <li class="currency__list">GBP</li>
                <li class="currency__list"><img src="icons/canada.png" alt="china" class="currency__icons"></li>
                <li class="currency__list">CAD</li>
                <li class="currency__list"><img src="icons/china.png" alt="china" class="currency__icons"></li>
                <li class="currency__list">CNY</li>
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