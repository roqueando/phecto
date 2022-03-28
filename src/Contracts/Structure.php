<?php

namespace Phecto\Contracts;

use Phecto\Changeset;

interface Structure
{
    public function changeset(array $params, string $action): Changeset;
}
