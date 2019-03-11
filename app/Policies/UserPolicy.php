<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function currentUserSameAsRequestUser(User $user, User $requestUser)
    {
        return $user->id === $requestUser->id;
    }
}
