<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    /**
     * @param int $id
     * @return User
     * @throws AuthorizationException
     */
    public function show(int $id): User
    {
        $user = User::findOrFail($id);

        $this->authorize('currentUserSameAsRequestUser', $user);

        return $user;
    }

    public function store(StoreUser $request): User
    {
        return User::create($request->all());
    }

    /**
     * @param StoreUser $request
     * @param int $id
     * @return User
     * @throws AuthorizationException
     */
    public function update(StoreUser $request, int $id): User
    {
        /**
         * @var $user User
         */
        $user = User::findOrFail($id);

        $this->authorize('currentUserSameAsRequestUser', $user);

        $user->update($request->all());

        return $user;
    }
}
