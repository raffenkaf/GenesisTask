<?php

namespace App\Http\Services\DiscountsService;

use App\Order;

class DiscountService
{
    /**
     * @param Order $order
     */
    public function calculateResultPriceSum(Order $order)
    {
        $order->result_price_sum = $order->price_sum;

        $specificProductDiscount = new SpecificProductDiscountCalculator();
        $eightMarchDiscount = new EightMarchDiscountCalculator();

        $specificProductDiscount->bind($eightMarchDiscount);

        $specificProductDiscount->calculateDiscount($order);

        if ($order->result_price_sum < 0) {
            $order->result_price_sum = 0;
        }
    }
}
