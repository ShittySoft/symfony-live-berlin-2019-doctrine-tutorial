<?php

namespace Infrastructure\Authentication\Repository;

use Authentication\Aggregate\User;
use Authentication\Repository\Users;

final class JsonFileUsers implements Users
{
    /** @var string */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function isRegistered(string $emailAddress) : bool
    {
        try {
            $this->get($emailAddress);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function get(string $emailAddress) : User
    {
        $users = \json_decode(@\file_get_contents($this->path), true) ?: [];

        if (! \array_key_exists($emailAddress, $users)) {
            throw new \Exception(\sprintf('User "%s" is not registered', $emailAddress));
        }

        return User::unserializeFrom($emailAddress, $users[$emailAddress]);
    }

    public function store(User $user) : void
    {
        $users = \json_decode(@\file_get_contents($this->path), true) ?: [];

        $reflectionAddress = new \ReflectionProperty(User::class, 'emailAddress');
        $reflectionPasswordHash = new \ReflectionProperty(User::class, 'passwordHash');

        $reflectionAddress->setAccessible(true);
        $reflectionPasswordHash->setAccessible(true);

        $users[$reflectionAddress->getValue($user)] = $reflectionPasswordHash->getValue($user);

        \file_put_contents($this->path, \json_encode($users));
    }
}
