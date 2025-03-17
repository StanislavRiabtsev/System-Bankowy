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
                <li>USD = 3.84 PLN</li>
                <li>EUR = 4.11 PLN</li>
                <li>GBP = 4.96 PLN</li>
                <li>CAD = 2.67</li>
                <li>CNY = 0.53</li>
            </ul>
            <div class="converion__input">

                <?php

                class SystemWymianyWalut
                {
                    private $konta = [];
                    private $kursyWymiany = [
                        'USD' => 3.84,
                        'EUR' => 4.11,
                        'GBP' => 4.96,
                        'CAD' => 2.67,
                        'CNY' => 0.53,
                        'PLN' => 1.0
                    ];

                    public function utworzKonto($nazwa, $waluta, $saldo)
                    {
                        if ($saldo >= 0 && isset($this->kursyWymiany[$waluta])) {
                            $this->konta[$nazwa] = ['waluta' => $waluta, 'saldo' => $saldo];
                            echo "Konto $nazwa z saldem $saldo $waluta.<br>";
                        } else {
                            echo "Nieprawidłowe saldo początkowe lub waluta.<br>";
                        }
                    }

                    public function wymienWalute($nazwa, $docelowaWaluta)
                    {
                        if (!isset($this->konta[$nazwa])) {
                            echo "Konto $nazwa nie istnieje.<br>";
                            return;
                        }

                        $aktualnaWaluta = $this->konta[$nazwa]['waluta'];
                        $saldo = $this->konta[$nazwa]['saldo'];

                        if (!isset($this->kursyWymiany[$docelowaWaluta])) {
                            echo "Nieprawidłowa waluta docelowa.<br>";
                            return;
                        }

                        $wartoscPLN = $saldo * $this->kursyWymiany[$aktualnaWaluta];
                        $noweSaldo = $wartoscPLN / $this->kursyWymiany[$docelowaWaluta];

                        $this->konta[$nazwa]['waluta'] = $docelowaWaluta;
                        $this->konta[$nazwa]['saldo'] = round($noweSaldo, 2);

                        echo "$nazwa wymienił środki na $docelowaWaluta. Nowe saldo: {$this->konta[$nazwa]['saldo']} $docelowaWaluta.<br>";
                    }

                    public function pobierzSaldo($nazwa)
                    {
                        if (!isset($this->konta[$nazwa])) {
                            return "Konto nie istnieje";
                        }
                        return "Saldo {$this->konta[$nazwa]['saldo']} {$this->konta[$nazwa]['waluta']}";
                    }
                }

                $bank = new SystemWymianyWalut();
                $bank->utworzKonto("Jan", "PLN", 1000);
                $bank->utworzKonto("Anna", "PLN", 500);
                $bank->wymienWalute("Jan", "EUR");
                $bank->wymienWalute("Anna", "USD");

                ?>

            </div>
        </div>
    </section>

</body>

</html>