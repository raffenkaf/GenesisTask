<?php

namespace App\Http\Services\DiscountsService;

use App\Order;
use App\Product;

class SpecificProductDiscountCalculator extends DiscountCalculator
{
    public function calculateDiscount(Order $order)
    {
        $products = $order->products;

        /**
         * @var $product Product
         */
        foreach ($products as $product) {
            $order->result_price_sum -= $product->discount;
        }

        $this->next($order);
    }
}
