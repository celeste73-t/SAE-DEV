<?php
namespace interfaces\user;

require_once 'model/User.php';

use model\User;

interface IUserReader {
    public function findByEmail(string $email): ?User;

}