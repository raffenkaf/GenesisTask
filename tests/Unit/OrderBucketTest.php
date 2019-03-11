<?php

namespace Tests\Unit;

use App\Order;
use App\OrderBucket;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderBucketTest extends TestCase
{
    use RefreshDatabase;

    private $product;
    private $user;
    private $order;

    public function testPositiveChangePriceSum()
    {
        $product = factory(Product::class)->create([
            'price' => 1000,
            'discount' => 100,
        ]);
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $priceSum = $order->price_sum + $product->price;

        $response = $this->withHeaders(['User-Id' => $user->id])
            ->json('POST', '/api/orders-buckets', [
                'order_id' => $order->id,
                'product_id' => $product->id
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'order_id' => $order->id,
                'product_id' => $product->id
            ]);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'price_sum' => $priceSum
        ]);
    }

    /**
     * @depends testPositiveChangePriceSum
     */
    public function testPositiveDeleteOrderBucket()
    {
        $product = factory(Product::class)->create([
            'price' => 1000,
            'discount' => 100,
        ]);
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create(['user_id' => $user->id, 'price_sum' => 1000, 'result_price_sum' => 900]);
        $orderBucket = factory(OrderBucket::class)->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'price_sum' => 1000
        ]);

        $response = $this
            ->withHeaders(['User-Id' => $user->id])
            ->json('DELETE', '/api/orders-buckets/' . $orderBucket->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('orders_buckets', [
            'id' => $orderBucket->id
        ]);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'price_sum' => 0
        ]);
    }

    public function testNegativeAuthRestrict()
    {
        $product = factory(Product::class)->create([
            'price' => 1000,
            'discount' => 100,
        ]);
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create(['user_id' => $user->id, 'price_sum' => 1000, 'result_price_sum' => 900]);
        $orderBucket = factory(OrderBucket::class)->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
        ]);

        $showResponse = $this->json('GET', '/api/orders-buckets/' . $orderBucket->id);
        $showResponse->assertStatus(401);
    }
}
