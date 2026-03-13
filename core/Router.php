<?php

class Router
{
    private array $routes = [];

    public function add(string $page, string $action, callable $handler): void
    {
        $this->routes[$page][$action] = $handler;
    }

    public function dispatch(): void
    {
        $page   = $_GET['page']   ?? 'login';
        $action = $_GET['action'] ?? '';

        if (isset($this->routes[$page][$action])) {
            call_user_func($this->routes[$page][$action]);
            return;
        }

        if (isset($this->routes[$page][''])) {
            call_user_func($this->routes[$page]['']);
            return;
        }

        http_response_code(404);
        echo '<h1>404 — Page not found</h1>';
    }
}
