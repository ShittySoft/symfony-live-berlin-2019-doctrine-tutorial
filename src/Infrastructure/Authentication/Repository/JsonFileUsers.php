<?php

namespace Infrastructure\Authentication\Repository;

use Authentication\Aggregate\User;
use Authentication\Repository\Users;
use Authentication\Value\EmailAddress;
use Authentication\Value\PasswordHash;

final class JsonFileUsers implements Users
{
    /** @var string */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function isRegistered(EmailAddress $emailAddress) : bool
    {
        try {
            $this->get($emailAddress);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function get(EmailAddress $emailAddress) : User
    {
        $users = \json_decode(@\file_get_contents($this->path), true) ?: [];

        if (! \array_key_exists($emailAddress->toString(), $users)) {
            throw new \Exception(\sprintf('User "%s" is not registered', $emailAddress->toString()));
        }

        return User::unserializeFrom($emailAddress, PasswordHash::fromString($users[$emailAddress->toString()]));
    }

    public function store(User $user) : void
    {
        $users = \json_decode(@\file_get_contents($this->path), true) ?: [];

        $reflectionAddress = new \ReflectionProperty(User::class, 'emailAddress');
        $reflectionPasswordHash = new \ReflectionProperty(User::class, 'passwordHash');

        $reflectionAddress->setAccessible(true);
        $reflectionPasswordHash->setAccessible(true);

        $users[$reflectionAddress->getValue($user)->toString()] = $reflectionPasswordHash->getValue($user);

        \file_put_contents($this->path, \json_encode($users));
    }
}
