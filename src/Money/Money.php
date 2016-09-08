<?php
namespace Money;

class Money
{
    protected $currency;

    /** @var int */
    protected $amount;

    public function __construct($amount, $currency)
    {
        $this->amount   = $amount;
        $this->currency = $currency;
    }

    /**
     * @param $by
     * @return static
     */
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

    public function add(Bank $bank, Money $money)
    {
        $converted = $money->convert($bank, $this->currency);

        return new Money($this->amount + $converted->getAmount(), $this->currency);
    }
}
