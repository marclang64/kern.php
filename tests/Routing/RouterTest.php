<?php

declare(strict_types=1);

namespace Kern\Tests\Routing;

use Kern\Routing\Router;
use Kern\Routing\Exceptions\RouteNotFoundException;
use Kern\Routing\Exceptions\DuplicateRouteException;
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

    public function testDispatchesRegisteredPostRoute(): void
    {
        $router = new Router();

        $router->post('/', fn(): string => 'Welcome to Kern!');

        self::assertSame(
            'Welcome to Kern!',
            $router->dispatch('POST', '/')
        );
    }

    public function testSamePathWithDifferentHttpMethods(): void
    {
        $router = new Router();
        $router->get('/', fn(): string => 'GET Response');
        $router->post('/', fn(): string => 'POST Response');

        self::assertSame(
            'GET Response',
            $router->dispatch('GET', '/')
        );

        self::assertSame(
            'POST Response',
            $router->dispatch('POST', '/')
        );
    }

    public function testDispatchIsCaseInsensitive(): void
    {
        $router = new Router();

        $router->get('/', fn(): string => 'Welcome to Kern!');

        self::assertSame(
            'Welcome to Kern!',
            $router->dispatch('get', '/')
        );
    }

    public function testUnknownRouteThrowsException(): void
    {
        $router = new Router();

        $this->expectException(RouteNotFoundException::class);
        $this->expectExceptionMessageIsOrContains("Route '/404' not found.");

        $router->dispatch('GET', '/404');
    }

    public function testDifferentHttpMethodThrowsException(): void
    {
        $router = new Router();

        $router->get('/about', fn(): string => 'About Kern');

        $this->expectException(RouteNotFoundException::class);
        $this->expectExceptionMessageIsOrContains("Route '/about' not found.");

        $router->dispatch('POST', '/about');
    }

    public function testDuplicateRouteRegistrationThrowsException(): void
    {
        $router = new Router();

        $router->get('/about', fn(): string => 'About Kern');

        $this->expectException(DuplicateRouteException::class);
        $this->expectExceptionMessageIsOrContains("Route '/about' already exists.");

        $router->get('/about', fn(): string => 'About Kern');
    }
}
