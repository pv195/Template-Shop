<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getUsers();
    public function searchUser();
    public function getUserById($userId);
    public function updateUser($userId, array $newDetails);
    public function deleteUser($userId);
    public function createUser(array $attributes);
}
