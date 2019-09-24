<?php

namespace Infrastructure\Authentication\Query;

use Authentication\Entity\User;
use Authentication\Query\UserIsRegistered;
use Authentication\Repository\Users;

final class UserIsRegisteredInRepository implements UserIsRegistered
{
    /** @var Users */
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function __invoke(string $emailAddress) : bool
    {
        return $this->users->isRegistered($emailAddress);
    }
}
