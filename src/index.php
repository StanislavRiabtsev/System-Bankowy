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
    <section class="System-Bankowy">
        <div class="container_bank">
            <img src="img/Logobank.png" alt="logo" class="System-Bankowy__logo">
            <h1 class="title">Flow Bank</h1>
            <div class="account">
                <a href="#" class="System-Bankowy__btn_log">Login</a>
                <a href="#" class="System-Bankowy__btn_reg">Register</a>
            </div>
        </div>
    </section>

    <!-- <hr class="System__line"> -->

    <nav class="Services">
        <div class="container">
            <div class="Services_button">
                <a href="#" class="Services__btn">Card</a>
                <a href="#" class="Services__btn">Credit</a>
                <a href="#" class="Services__btn">Deposit</a>
                <a href="#" class="Services__btn">Department</a>
                <a href="#" class="Services__btn">Conversion</a>
            </div>
        </div>
    </nav>

    <?php

    class SystemWymianyWalut
    {
        private $konta = [];
        private $kursyWymiany = [
            'USD' => 4.0,
            'EUR' => 4.5,
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

</body>

</html>