<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Get all users 
     * 
     * @return mixed
     */
    public function getUsers()
    {
        return User::orderBy('id', 'desc')->simplePaginate(10);
    }

    /**
     * get,search,sort user
     * @return mixed
     */
    public function searchUser()
    {
        $users = User::query();
        $users->when(request('search'), function($query) {
            $search = trim(request('search'));
            return $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%');
        });
        $users->when(request('sort'), function($query) {
            return $query->orderBy('name', request('sort'));
        });

        return $users->paginate(config('paginate.user'));
    }

    /**
     * Create user 
     *
     * @param array $attributes
     * @return mixed
     */
    public function createUser(array $attributes)
    {
        return User::create($attributes);
    }

    /**
     * Get user by id 
     *
     * @param int
     * @return mixed
     */
    public function getUserById($userId)
    {
        return User::findOrFail($userId);
    }

    /**
     * Update user by id
     *
     * @param int $userId
     * @param array $newDetails
     * @return mixed
     */
    public function updateUser($userId, array $newDetails)
    {
        return User::whereId($userId)->update($newDetails);
    }

    /**
     * Delete user by id
     *
     * @param int $userId
     * 
     */
    public function deleteUser($userId)
    {
        return User::destroy($userId);
    }
}
