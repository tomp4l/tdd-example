<?php
namespace Money;

class Money implements MoneyInterface
{
    protected $currency;

    /** @var int */
    protected $amount;

    public function __construct($amount, $currency)
    {
        $this->amount   = $amount;
        $this->currency = $currency;
    }

    public function multiply($by)
    {
        return new Money($this->amount * $by, $this->currency);
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function equals(Money $money)
    {
        return $money->getAmount() == $this->amount && $money->getCurrency() == $this->getCurrency();
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function convert(Bank $bank, $currency)
    {
        $rate = $bank->getRate($this->currency, $currency);

        return new Money($this->amount / $rate, $currency);
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
