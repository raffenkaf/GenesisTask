<?php

namespace App\Http\Services\DiscountsService;

use App\Order;
use App\Product;
use Carbon\Carbon;

class EightMarchDiscountCalculator extends DiscountCalculator
{
    const DISCOUNT = 8; // In percents

    private $discountStartDate;
    private $discountEndDate;

    public function __construct()
    {
        $this->discountStartDate = Carbon::create(2019, 03, 6);
        $this->discountEndDate = Carbon::create(2019, 03, 9);
    }

    public function calculateDiscount(Order $order)
    {
        $products = $order->products;

        /**
         * @var $product Product
         */
        foreach ($products as $product) {
            $dateOfCreation = $product->created_at ?? Carbon::now();

            if ($dateOfCreation->between($this->discountStartDate, $this->discountEndDate, $dateOfCreation)) {
                $discountSum = $product->price * self::DISCOUNT / 100;
                $discountSum = (int) floor($discountSum);
                $order->result_price_sum -= $discountSum;
            }
        }

        $this->next($order);
    }
}
