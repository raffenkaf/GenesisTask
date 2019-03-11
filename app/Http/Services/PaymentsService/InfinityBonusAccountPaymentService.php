<?php
namespace App\Http\Services\PaymentsService;

use App\Payment;

class InfinityBonusAccountPaymentService implements PaymentService
{
    public function execute(Payment $payment)
    {
        $payment->save();
    }
}
