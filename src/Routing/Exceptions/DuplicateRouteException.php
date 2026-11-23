<?php

declare(strict_types=1);

namespace Kern\Routing\Exceptions;

final class DuplicateRouteException extends \LogicException
{
    public function __construct(string $path)
    {
        parent::__construct("Route '{$path}' already exists.");
    }
}
