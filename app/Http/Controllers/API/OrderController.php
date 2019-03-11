<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrder;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('index', $request);

        return Order::select('id', 'price_sum', 'result_price_sum', 'status_id')
            ->paginate(15);
    }

    /**
     * @param StoreOrder $request
     * @return Order
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreOrder $request): Order
    {
        $order = new Order($request->all());
        $this->authorize('orderUserSameAsCurrentUser', $order);

        $order->save();

        return $order;
    }

    /**
     * @param int $id
     * @return Order
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(int $id): Order
    {
        $order = Order::findOrFail($id);

        $this->authorize('orderUserSameAsCurrentUser', $order);

        return $order;
    }

    /**
     * @param UpdateOrder $request
     * @param int $id
     * @return Order
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateOrder $request, int $id): Order
    {
        /**
         * @var $order Order
         */
        $order = Order::findOrFail($id);

        $this->authorize('orderUserSameAsCurrentUser', $order);

        $order->update($request->all());

        return $order;
    }
}
