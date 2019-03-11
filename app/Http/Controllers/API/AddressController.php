<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Address;
use App\Http\Requests\StoreAddress;

class AddressController extends Controller
{
    public function store(StoreAddress $request): Address
    {
        return Address::create($request->all());
    }
}
