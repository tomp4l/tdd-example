<?php

use Money\Bank;
use Money\Money;

require 'vendor/autoload.php';

$bank = new Bank();

$bank->addRate('USD', 'EUR', 2);

$tenDollars = new Money(10, 'USD');

$fiveEuros = new Money(5, 'EUR');

$sum = $tenDollars->add($fiveEuros);

echo "In USD: " . $bank->convert($sum, 'USD')->getAmount() . PHP_EOL;
echo "In EUR: " . $bank->convert($sum, 'EUR')->getAmount() . PHP_EOL;