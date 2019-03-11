<?php

namespace App\Policies;

use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class OrderPolicy
{
    use HandlesAuthorization;

    public function index(User $user, Request $request)
    {
        return $request->get('user_id') == $user->id;
    }

    public function orderUserSameAsCurrentUser(User $user, Order $order)
    {
        return $user->id === (int)$order->user_id;
    }
}
