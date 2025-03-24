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
                <div class="logo__title">
                    <img src="img/Logobank.png" alt="logo" class="system-bankowy__logo">
                    <h1 class="title">Flow Bank</h1>
                </div>
                <div class="account">
                    <a href="#" class="btn__log">Login</a>
                    <a href="#" class="btn__reg">Register</a>
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
                <li class="currency__item">
                    <img src="icons/united-states.png" alt="USD" class="currency__icons">
                    <span>USD</span>
                </li>
                <li class="currency__item">
                    <img src="icons/european-union.png" alt="EUR" class="currency__icons">
                    <span>EUR</span>
                </li>
                <li class="currency__item">
                    <img src="icons/united-kingdom.png" alt="GBP" class="currency__icons">
                    <span>GBP</span>
                </li>
                <li class="currency__item">
                    <img src="icons/canada.png" alt="CAD" class="currency__icons">
                    <span>CAD</span>
                </li>
                <li class="currency__item">
                    <img src="icons/china.png" alt="CNY" class="currency__icons">
                    <span>CNY</span>
                </li>
            </ul>
            <div class="conversion__input">
            </div>
            <div class="conversion__input">

                <?php
                $kursyWalut = [
                    "USD" => [
                        "EUR" => 0.93,
                        "GBP" => 0.81,
                        "CAD" => 1.39,
                        "CNY" => 7.24
                    ],
                    "EUR" => [
                        "USD" => 1.07,
                        "GBP" => 0.87,
                        "CAD" => 1.49,
                        "CNY" => 7.76
                    ],
                    "GBP" => [
                        "USD" => 1.23,
                        "EUR" => 1.15,
                        "CAD" => 1.71,
                        "CNY" => 8.93
                    ],
                    "CAD" => [
                        "USD" => 0.72,
                        "EUR" => 0.67,
                        "GBP" => 0.58,
                        "CNY" => 5.21
                    ],
                    "CNY" => [
                        "USD" => 0.14,
                        "EUR" => 0.13,
                        "GBP" => 0.11,
                        "CAD" => 0.19
                    ]
                ];

                $kwota = isset($_POST['kwota']) ? (float)$_POST['kwota'] : 0;
                $walutaZ = isset($_POST['waluta_z']) ? $_POST['waluta_z'] : 'USD';
                $walutaDo = isset($_POST['waluta_do']) ? $_POST['waluta_do'] : 'EUR';
                $wynik = 0;

                if ($kwota > 0 && isset($kursyWalut[$walutaZ][$walutaDo])) {
                    $wynik = $kwota * $kursyWalut[$walutaZ][$walutaDo];
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