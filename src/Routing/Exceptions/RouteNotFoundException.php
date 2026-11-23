<?php

declare(strict_types=1);

namespace Kern\Routing\Exceptions;

final class RouteNotFoundException extends \RuntimeException
{
    public function __construct(string $path)
    {
        parent::__construct("Route '{$path}' not found.");
    }
}
