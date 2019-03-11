<?php

namespace App\Policies;

use App\User;
use App\OrderBucket;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderBucketPolicy
{
    use HandlesAuthorization;

    public function orderOfOrderBucketBelongsToUser(User $user, OrderBucket $orderBucket)
    {
        return $user->id === $orderBucket->order->user_id;
    }
}
