<?php
class SystemWymianyWalut {
    private $konta = [];
    private $kursyWymiany = [
        'USD' => 4.0, 
        'EUR' => 4.5, 
        'PLN' => 1.0  
    ];
    
    public function utworzKonto($nazwa, $waluta, $saldo) {
        if ($saldo >= 0 && isset($this->kursyWymiany[$waluta])) {
            $this->konta[$nazwa] = ['waluta' => $waluta, 'saldo' => $saldo];
            echo "Konto $nazwa z saldem $saldo $waluta.<br>";
        } else {
            echo "Nieprawidłowe saldo początkowe lub waluta.<br>";
        }
    }
    
    public function wymienWalute($nazwa, $docelowaWaluta) {
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
    
    public function pobierzSaldo($nazwa) {
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