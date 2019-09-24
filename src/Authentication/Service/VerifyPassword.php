<?php

namespace Authentication\Service;

interface VerifyPassword
{
    public function __invoke(string $password, string $hash) : bool;
}
