<?php

namespace Authentication\Service;

use Authentication\Value\Password;
use Authentication\Value\PasswordHash;

interface VerifyPassword
{
    public function __invoke(Password $password, PasswordHash $hash) : bool;
}
