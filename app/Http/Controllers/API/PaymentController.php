<?php

namespace App\Http\Controllers\API;

use App\Exceptions\PaymentException;
use App\Http\Requests\StorePayment;
use App\Http\Controllers\Controller;
use App\Http\Services\PaymentsService\PaymentsServiceFactory;
use App\Order;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentsServiceFactory;

    public function __construct(PaymentsServiceFactory $paymentsServiceFactory)
    {
        $this->paymentsServiceFactory = $paymentsServiceFactory;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        /**
         * @var Order $order
         */
        $order = Order::findOrFail($request->get('order_id'));

        $this->authorize('orderUserSameAsCurrentUser', $order);

        return $order->payments->paginate(15);
    }

    /**
     * @param int $id
     * @return Payment
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(int $id): Payment
    {
        $payment = Payment::find($id);

        $this->authorize('orderOfPaymentBelongsToUser', $payment);

        return $payment;
    }

    /**
     * @param StorePayment $request
     * @return Payment
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws PaymentException
     */
    public function store(StorePayment $request): Payment
    {
        $payment = new Payment($request->all());

        $this->authorize('orderOfPaymentBelongsToUser', $payment);

        $paymentService = $this->paymentsServiceFactory->make($payment);

        $paymentService->execute($payment);

        return $payment;
    }
}
