<?php

namespace spec\Money;

use Money\Bank;
use Money\Money;
use PhpSpec\ObjectBehavior;

class SumSpec extends ObjectBehavior
{
    function let(Bank $bank)
    {
        $bank->getRate('USD', 'USD')->willReturn(1);
        $this->beConstructedWith(new Money(5, 'USD'), new Money(5, 'USD'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Sum');
    }

    function it_should_add_to_ten(Bank $bank)
    {
        $this->convert($bank, 'USD')->shouldBeLike(new Money(10, 'USD'));
    }

    function it_should_add_different_currency(Bank $bank)
    {
        $bank->getRate('EUR','USD')->willReturn(0.5);
        $this->beConstructedWith(new Money(5, 'USD'), new Money(5, 'EUR'));

        $this->convert($bank, 'USD')->shouldBeLike(new Money(15, 'USD'));
    }

    function it_should_multiply(Bank $bank)
    {
        $this->multiply(2)->convert($bank, 'USD')->shouldBeLike(new Money(20, 'USD'));
    }

    function it_should_add(Bank $bank)
    {
        $this->add(new Money(5, 'USD'))->convert($bank, 'USD')->shouldBeLike(new Money(15, 'USD'));
    }
}
