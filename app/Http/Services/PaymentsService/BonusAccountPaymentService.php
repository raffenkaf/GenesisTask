<?php

namespace App\Http\Services\PaymentsService;

use App\Exceptions\PaymentException;
use App\Payment;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 * Class BonusAccountPaymentService
 * @package App\Http\Services\PaymentsService
 * @property User $user
 * @property Payment $payment
 */
class BonusAccountPaymentService implements PaymentService
{
    private $payment;
    private $user;

    public function execute(Payment $payment)
    {
        $this->user = $payment->order->user;
        $this->payment = $payment;

        if (!$this->canUserPay()) {
            throw new PaymentException('User do not have enough bonus balance');
        }

        $this->user->bonus_balance -= $this->payment->payment_sum;

        DB::beginTransaction();
        $this->user->save();
        $this->payment->save();
        DB::commit();
    }

    private function canUserPay()
    {
        return $this->user->bonus_balance >= $this->payment->payment_sum;
    }
}
