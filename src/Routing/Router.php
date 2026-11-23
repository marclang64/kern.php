<?php

declare(strict_types=1);

namespace Kern\Routing;

final class Router {
    private array $routes = [];

    public function get(string $path, callable $handler): void {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable $handler): void {
        $this->addRoute('POST', $path, $handler);
    }

    public function dispatch(string $method, string $path): string {
        $method = strtoupper($method);
        $handler = $this->routes[$method][$path] ?? null;

        if ($handler === null) {
            throw new \RuntimeException('Route not found');
        }

        return $handler();
    }

    private function addRoute(string $method, string $path, callable $handler): void {
        if (isset($this->routes[$method][$path])) {
            throw new \RuntimeException('Route already exists');
        }

        $this->routes[$method][$path] = $handler;
    }
}
