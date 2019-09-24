<?php

namespace Authentication\Repository;

use Authentication\Aggregate\User;

interface Users
{
    public function isRegistered(string $emailAddress) : bool;
    public function get(string $emailAddress) : User;
    public function store(User $user) : void;
}
