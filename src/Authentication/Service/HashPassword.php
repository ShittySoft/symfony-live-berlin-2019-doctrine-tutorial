<?php

namespace Authentication\Service;

interface HashPassword
{
    public function __invoke(string $password) : string;
}
