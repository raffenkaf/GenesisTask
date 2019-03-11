<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreOrderBucket;
use App\Http\Controllers\Controller;
use App\Http\Services\DiscountsService\DiscountService;
use App\Order;
use App\OrderBucket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderBucketController extends Controller
{
    private $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
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

        return $order->products->paginate(15);
    }

    /**
     * @param StoreOrderBucket $request
     * @return OrderBucket
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreOrderBucket $request): OrderBucket
    {
        $orderBucket = new OrderBucket($request->all());

        $this->authorize('orderOfOrderBucketBelongsToUser', $orderBucket);

        $order = $orderBucket->order;
        $product = $orderBucket->product;

        $order->price_sum += $product->price;
        $this->discountService->calculateResultPriceSum($order);

        DB::beginTransaction();
        $order->save();
        $orderBucket->save();
        DB::commit();

        return $orderBucket;
    }

    /**
     * @param int $id
     * @return OrderBucket
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(int $id): OrderBucket
    {
        $orderBucket = OrderBucket::findOrFail($id);

        $this->authorize('orderOfOrderBucketBelongsToUser', $orderBucket);

        return $orderBucket;
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        /**
         * @var $orderBucket OrderBucket
         */
        $orderBucket = OrderBucket::findOrFail($id);

        $this->authorize('orderOfOrderBucketBelongsToUser', $orderBucket);

        $order = $orderBucket->order;
        $product = $orderBucket->product;

        $order->price_sum -= $product->price;
        $this->discountService->calculateResultPriceSum($order);

        DB::beginTransaction();
        $order->save();
        $orderBucket->delete();
        DB::commit();

        return response()->json();
    }
}
