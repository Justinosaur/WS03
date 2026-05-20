<?php

class Router {
    protected $routes = [];

    public function registerRoute($method, $uri, $controller) {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    public function get($uri, $controller) {
        $this->registerRoute('GET', $uri, $controller);
    }

    public function post($uri, $controller) {
        $this->registerRoute('POST', $uri, $controller);
    }

    public function put($uri, $controller) {
        $this->registerRoute('PUT', $uri, $controller);
    }

    public function delete($uri, $controller) {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    public function error($httpCode = 404) {
        loadView("error/{$httpCode}");

        exit;
    }

    public function route($uri, $method) {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            // Exact match
            if ($route['uri'] === $uri) {
                require basePath($route['controller']);

                return;
            }

            // Parameterized route support, e.g. /listings/{id}
            if (strpos($route['uri'], '{') !== false) {
                $pattern = preg_replace_callback('/\{(\w+)\}/', function ($m) {
                    return '(?P<' . $m[1] . '>[^/]+)';
                }, $route['uri']);

                $pattern = '#^' . $pattern . '$#';

                if (preg_match($pattern, $uri, $matches)) {
                    // expose named captures as $_GET params for controllers
                    foreach ($matches as $k => $v) {
                        if (!is_int($k)) {
                            $_GET[$k] = $v;
                        }
                    }

                    require basePath($route['controller']);

                    return;
                }
            }
        }

        $this->error(404); // No route matches
    }
}

?>