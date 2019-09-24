<?php

namespace Infrastructure\Authentication\Repository;

use Authentication\Aggregate\User;
use Authentication\Repository\Users;
use Authentication\Value\EmailAddress;

final class InMemoryUsers implements Users
{
    /** @var array<string, User> */
    private $users = [];

    public function isRegistered(EmailAddress $emailAddress) : bool
    {
        return \array_key_exists($emailAddress->toString(), $this->users);
    }

    public function get(EmailAddress $emailAddress) : User
    {
        return $this->users[$emailAddress->toString()];
    }

    public function store(User $user) : void
    {
        $emailReflection = new \ReflectionProperty(User::class, 'emailAddress');

        $emailReflection->setAccessible(true);

        $this->users[$emailReflection->getValue($user)->toString()] = $user;
    }
}
