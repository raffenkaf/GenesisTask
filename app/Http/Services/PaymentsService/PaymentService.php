<?php
namespace App\Http\Services\PaymentsService;

use App\Exceptions\PaymentException;
use App\Payment;

interface PaymentService
{
    /**
     * @param Payment $payment
     * @throws PaymentException
     */
    public function execute(Payment $payment);
}
