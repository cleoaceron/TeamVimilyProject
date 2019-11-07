<?php

namespace App\Services\User;

interface UserInterface {

    public function addUser($item);

    public function updateUser($uuid);

    public function deleteUser($uuid);

    public function viewUser($uuid);

    public function getUserList($request, $page);

}
