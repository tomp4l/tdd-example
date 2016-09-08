<?php
namespace Money;

interface MoneyInterface
{
    /**
     * @return Money
     */
    public function convert(Bank $bank, $currency);

    /**
     * @param $by
     * @return MoneyInterface
     */
    public function multiply($by);

    /**
     * @param MoneyInterface $augend
     * @param MoneyInterface $addend
     * @return MoneyInterface
     */
    public function add(MoneyInterface $money);
}