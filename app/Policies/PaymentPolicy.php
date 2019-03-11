<?php

namespace App\Policies;

use App\User;
use App\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function orderOfPaymentBelongsToUser(User $user, Payment $payment)
    {
        return $payment->order->user_id === $user->id;
    }
}
