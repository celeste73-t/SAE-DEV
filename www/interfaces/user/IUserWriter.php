<?php
namespace interfaces\user;

require_once 'model/User.php';

use model\User;

interface IUserWriter {
    public function newUser(User $user): bool;
}