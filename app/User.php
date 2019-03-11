<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Foundation\Auth\User as LaravelUser;
/**
 * Class User
 * @package App
 * @property string $id
 * @property string $name
 * @property integer $bonus_balance
 * @property Collection $orders
 * @property string $created_at
 * @property string $updated_at
 */
class User extends LaravelUser
{
    protected $fillable = [
        'name',
        'bonus_balance'
    ];

    protected $attributes = [
        'bonus_balance' => 0
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
