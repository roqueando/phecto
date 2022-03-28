<?php

namespace Phecto;

final class Changeset 
{
    const INSERT = 'insert';
    const UPDATE = 'update';
    const DELETE = 'delete';

    public bool $isValid;
    public ?object $data;
    public array $changes;
    public array $errors;
    public array $required;
    public string $action;

    public function __construct(?object $data, array $params = [], string $action)
    {
        $this->isValid = true;
        $this->data = $data;
        $this->changes = $params;
        $this->errors = [];
        $this->required = [];
        $this->action = $action;
    }

    public function setRequired(array $required): self
    {
        $this->required = $required;
        return $this->validateRequired();
    }

    /**
     * Validate if the changes has the required fields
     * @return Changeset
     */
    private function validateRequired(): self
    {
        foreach($this->required as $value) {
            if(!in_array($value, array_keys($this->changes))) {
                $this->addError($value, "must be required");
            }
        }

        return $this;
    }

    /**
     * Add an error to errors array
     * @param string $key
     * @param string $value
     * @return Changeset
     */
    public function addError(string $key, string $value): self
    {
        $this->errors[$key] = $value;
        $this->isValid = false;
        return $this;
    }
}
