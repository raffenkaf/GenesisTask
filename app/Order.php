<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 * @property integer $id
 * @property integer $price_sum
 * @property integer $result_price_sum
 * @property integer $status_id
 * @property integer $user_id
 * @property integer $shipment_address_id
 * @property Collection $products
 * @property Collection $payments
 * @property User $user
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends Model
{
    const STATUS_DRAFT = 0;
    const STATUS_ORDERED = 1;
    const STATUS_SENT = 2;

    protected $fillable = [
        'user_id',
        'shipment_address_id'
    ];

    protected $attributes = [
        'price_sum' => 0,
        'status_id' => 0,
        'result_price_sum' => 0
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'orders_buckets', 'order_id', 'product_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payments');
    }
}
