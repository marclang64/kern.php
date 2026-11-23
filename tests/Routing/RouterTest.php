<?php

declare(strict_types=1);

namespace Kern\Tests\Routing;

use Kern\Routing\Router;
use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase
{
    public function testDispatchesRegisteredGetRoute(): void
    {
        $router = new Router();

        $router->get('/', fn(): string => 'Welcome to Kern!');

        self::assertSame(
            'Welcome to Kern!',
            $router->dispatch('GET', '/')
        );
    }
}
