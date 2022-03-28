<?php

namespace Tests\Fixtures;

class Customer
{
    public string $id;
    public function __construct(
        public string $name,
        public string $email
    )
    {
        $this->id = uniqid();
    }
}
