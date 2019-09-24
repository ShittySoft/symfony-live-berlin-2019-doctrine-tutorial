<?php

namespace Infrastructure\Authentication\Repository;

use Authentication\Aggregate\User;
use Authentication\Repository\Users;
use Authentication\Value\EmailAddress;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

final class DoctrineRepositoryUsers implements Users
{
    /** @var ObjectRepository */
    private $repository;

    /** @var ObjectManager */
    private $objectManager;

    public function __construct(
        ObjectRepository $repository,
        ObjectManager $objectManager
    ) {
        $this->repository    = $repository;
        $this->objectManager = $objectManager;
    }

    public function isRegistered(EmailAddress $emailAddress) : bool
    {
        return (bool) $this->repository->find($emailAddress);
    }

    public function get(EmailAddress $emailAddress) : User
    {
        /** @var User|null $instance */
        $instance = $this->repository->find($emailAddress);

        if ($instance === null) {
            throw new \RuntimeException('User not found');
        }

        return $instance;
    }

    public function store(User $user) : void
    {
        $this->objectManager->persist($user);
        $this->objectManager->flush();
    }
}
