<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $discount
 * @property integer $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    protected $attributes = [
        'discount' => 0, 'is_active' => false
    ];
}
