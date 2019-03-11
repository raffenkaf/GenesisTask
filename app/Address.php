<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * @package App
 * @property integer $id
 * @property string $door_number
 * @property string $house_number
 * @property string $street
 * @property string $order_id
 * @property string $state
 * @property string $city
 * @property string $country
 * @property string $postal_code
 * @property string $created_at
 * @property string $updated_at
 */
class Address extends Model
{
    protected $fillable = [
        'door_number',
        'house_number',
        'street',
        'state',
        'city',
        'country',
        'postal_code'
    ];
}
