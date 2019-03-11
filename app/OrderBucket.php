<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderBucket
 * @package App
 * @property integer $id
 * @property integer $product_id
 * @property integer $order_id
 * @property Order $order
 * @property Product $product
 * @property string $created_at
 * @property string $updated_at
 */
class OrderBucket extends Model
{
    protected $table = 'orders_buckets';

    protected $fillable = [
        'product_id',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
