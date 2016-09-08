<?php

namespace Money;

class Bank
{
    private $rates = [];

    public function addRate($from, $to, $rate)
    {
        $this->rates[$from][$to] = $rate;
        $this->rates[$to][$from] =  1 / $rate;
    }

    public function getRate($from, $to)
    {
        if($from == $to) {
            return 1;
        }
        return $this->rates[$from][$to];
    }


}
