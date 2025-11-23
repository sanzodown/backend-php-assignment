<?php

declare(strict_types=1);

namespace App\Exception;

class KnightNotFoundException extends \RuntimeException
{
    public function __construct(string $id)
    {
        parent::__construct("Knight #{$id} not found.");
    }
}
