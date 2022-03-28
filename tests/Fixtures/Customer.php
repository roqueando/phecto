<?php

namespace Tests\Fixtures;

use Phecto\Changeset;
use Phecto\Contracts\Structure;

class Customer implements Structure
{
    public string $id;
    public string $name;
    public string $email;
    public string $document;

    public function __construct()
    {
        $this->id = uniqid();
    }

    public function changeset(array $params, string $action): Changeset
    {
        return new Changeset($this, $params, $action);
    }

    public function validate(Changeset $changeset): Changeset
    {
        $changeset = $this->validateDocument($changeset);
        $changeset = $this->validateEmail($changeset);
        return $changeset;
    }

    private function validateDocument(Changeset $changeset): Changeset
    {
        $document = $changeset->changes['document'];
        if (!is_numeric($document)) {
            $changeset->addError('document', 'must be numbers');
        }

        return $changeset;
    }

    private function validateEmail(Changeset $changeset): Changeset
    {
        $email = $changeset->changes['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $changeset->addError('email', 'must be a valid email address');
        }

        return $changeset;
    }
}
