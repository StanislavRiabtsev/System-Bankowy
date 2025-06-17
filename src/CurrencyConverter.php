<?php
interface CurrencyConverterInterface
{
    public function convert(float $amount, string $from, string $to): float;
}

class CurrencyConverter implements CurrencyConverterInterface
{
    private array $rates;

    public function __construct(array $rates) //przekazywana jest tablica kursów walutowych
    {
        $this->rates = $rates;
    }

    public function convert(float $amount, string $from, string $to): float
    {
        if (!isset($this->rates[$from]) || !isset($this->rates[$to])) {
            throw new InvalidArgumentException("Invalid currency.");
        }

        return ($amount / $this->rates[$from]) * $this->rates[$to];
    }
}