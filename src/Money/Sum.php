<?php

namespace Money;

class Sum implements MoneyInterface
{
    private $augend;
    private $addend;

    public function __construct(MoneyInterface $augend, MoneyInterface $addend)
    {
        $this->augend = $augend;
        $this->addend = $addend;
    }

    public function convert(Bank $bank, $currency)
    {
        $augendAmount = $this->augend->convert($bank, $currency)->getAmount();
        $addendAmount = $this->addend->convert($bank, $currency)->getAmount();

        return new Money($augendAmount + $addendAmount, $currency);
    }

    /**
     * @param $by
     * @return MoneyInterface
     */
    public function multiply($by)
    {
        return new Sum($this->augend->multiply($by), $this->addend->multiply($by));
    }

    /**
     * @param MoneyInterface $augend
     * @param MoneyInterface $addend
     * @return MoneyInterface
     */
    public function add(MoneyInterface $money)
    {
        return new Sum($money, $this);
    }
}
