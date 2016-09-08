<?php

namespace spec\Money;

use Money\Bank;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoneySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Money\Money');
    }

    function let()
    {
        $this->beConstructedWith(5, 'USD');
    }
    
    function it_can_be_multiplied()
    {
        $money = $this->multiply(2);
        $money->shouldEqualMoney(10);
    }

    function it_can_be_multiplied_multiple_times()
    {
        $this->beConstructedWith(6, 'USD');
        $money = $this->multiply(2);
        $money->shouldEqualMoney(12);
        $money = $this->multiply(3);
        $money->shouldEqualMoney(18);
    }

    function it_equals_another_same_amount()
    {
        $this->equals(new Money(5, 'USD'))->shouldReturn(true);
    }

    function it_does_not_equal_a_different_amount()
    {
        $this->equals(new Money(6, 'USD'))->shouldReturn(false);
    }

    function it_does_not_equal_a_different_currency()
    {
        $this->equals(new Money(5, 'EUR'))->shouldReturn(false);
    }

    function it_has_the_correct_currency()
    {
        $this->getCurrency()->shouldReturn('USD');
    }

    function it_can_add_the_same_currency(Bank $bank)
    {
        $bank->getRate('USD', 'USD')->willReturn(1);
        $this->add($bank, new Money(5, 'USD'))->shouldBeLike(new Money(10, 'USD'));
    }

    function it_can_add_different_currency(Bank $bank)
    {
        $bank->getRate('EUR', 'USD')->willReturn(0.5);
        $this->add($bank, new Money(5, 'EUR'))->shouldBeLike(new Money(15, 'USD'));
    }

    function it_can_convert_to_another_currency(Bank $bank)
    {
        $bank->getRate('USD', 'EUR')->willReturn(2);
        $this->convert($bank, 'EUR')->shouldBeLike(new Money(2.5, 'EUR'));
    }

    function getMatchers()
    {
        return [
            'equalMoney' => function (Money $money, $amount) {
                return $money->equals(new Money($amount, $money->getCurrency()));
            },
        ];
    }
}
