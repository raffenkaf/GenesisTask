<?php

namespace App\Http\Services\DiscountsService;

use App\Order;

/**
 * Class DiscountCalculator
 * @package App\Http\Services\DiscountsService
 * @property DiscountCalculator|null $successor
 */
abstract class DiscountCalculator
{
    protected $successor;

    public abstract function calculateDiscount(Order $order);

    public function bind(DiscountCalculator $discountCalculator)
    {
        $this->successor = $discountCalculator;
    }

    public function next(Order $order)
    {
        if (!empty($this->successor)) {
            $this->successor->calculateDiscount($order);
        }
    }
}
