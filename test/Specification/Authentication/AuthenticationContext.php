<?php

declare(strict_types=1);

namespace Test\Specification\Authentication;

use Authentication\Aggregate\User;
use Authentication\Query\UserIsRegistered;
use Authentication\Service\HashPassword;
use Authentication\Service\VerifyPassword;
use Authentication\Value\EmailAddress;
use Authentication\Value\Password;
use Authentication\Value\PasswordHash;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Infrastructure\Authentication\Query\UserIsRegisteredInRepository;
use Infrastructure\Authentication\Repository\InMemoryUsers;
use Webmozart\Assert\Assert;

final class AuthenticationContext implements Context
{
    /** @var InMemoryUsers */
    private $users;

    /** @var UserIsRegistered */
    private $userExists;

    /** @Given /^there are no registered users$/ */
    public function thereAreNoRegisteredUsers()
    {
        $this->users      = new InMemoryUsers();
        $this->userExists = new UserIsRegisteredInRepository($this->users);
    }

    /** @When /^a user registers with the website$/ */
    public function aUserRegistersWithTheWebsite()
    {
        $this->users->store(User::register(
            $this->userExists,
            new class implements HashPassword {
                public function __invoke(Password $password) : PasswordHash
                {
                    return PasswordHash::fromString('dummy');
                }
            },
            EmailAddress::fromString('bob@example.com'),
            Password::fromString('super$ecret')
        ));
    }

    /** @Then /^the user can log into the website$/ */
    public function theUserCanLogIntoTheWebsite()
    {
        Assert::true(
            $this->users->get(EmailAddress::fromString('bob@example.com'))
            ->logIn(
                new class implements VerifyPassword
                {
                    public function __invoke(Password $password, PasswordHash $hash) : bool
                    {
                        return true;
                    }
                },
                Password::fromString('super$ecret')
            )
        );
    }
}
