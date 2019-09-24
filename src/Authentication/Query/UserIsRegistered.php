<?php

namespace Authentication\Query;

use Authentication\Value\EmailAddress;

interface UserIsRegistered
{
    public function __invoke(EmailAddress $emailAddress) : bool;
}
