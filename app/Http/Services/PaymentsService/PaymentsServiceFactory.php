<?php
namespace App\Http\Services\PaymentsService;

use App\Payment;

class PaymentsServiceFactory
{
    public function make(Payment $payment): PaymentService
    {
        switch ($payment->payment_type_id) {
            case Payment::PAYMENT_TYPE_BONUS_ACCOUNT:
                return new BonusAccountPaymentService();
            case Payment::PAYMENT_TYPE_INFINITY_BONUS_ACCOUNT:
                return new InfinityBonusAccountPaymentService();
        }
    }
}
