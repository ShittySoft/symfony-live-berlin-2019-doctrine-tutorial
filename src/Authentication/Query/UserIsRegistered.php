<?php

namespace Authentication\Query;

interface UserIsRegistered
{
    public function __invoke(string $emailAddress) : bool;
}
