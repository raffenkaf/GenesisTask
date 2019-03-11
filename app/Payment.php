<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * @package App
 * @property integer $payment_sum
 * @property integer $payment_type_id
 * @property integer $order_id
 * @property Order $order
 * @property string $created_at
 * @property string $updated_at
 */
class Payment extends Model
{
    const PAYMENT_TYPE_BONUS_ACCOUNT = 0;
    const PAYMENT_TYPE_CASH_ON_DELIVERY = 1;
    const PAYMENT_TYPE_CREDIT_CARD = 2;
    const PAYMENT_TYPE_INFINITY_BONUS_ACCOUNT = 3;

    protected $fillable = [
        'payment_sum',
        'payment_type_id',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
