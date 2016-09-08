<?php

namespace spec\Money;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BankSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Bank');
    }

    function it_can_add_a_rate()
    {
        $this->addRate('USD', 'EUR', 2);
        $this->getRate('USD', 'EUR')->shouldReturn(2);
        $this->getRate('EUR', 'USD')->shouldReturn(0.5);
    }

    function it_returns_one_for_the_same_rate()
    {
        $this->getRate('USD', 'USD')->shouldReturn(1);
    }
}
