<?php

namespace Core;

class Router
{
    private static array $routes = [];
    private static Request $request;
    private static Response $response;

    public static function init(Request $request, Response $response)
    {
        self::$request = $request;
        self::$response = $response;
    }

    public static function get($path, $callback): Route
    {
        $route = new Route('get', $path, $callback);
        self::$routes['get'][$path] = $route;
        return $route;
    }

    public static function post($path, $callback): Route
    {
        $route = new Route('post', $path, $callback);
        self::$routes['post'][$path] = $route;
        return $route;
    }

    public static function put($path, $callback): Route
    {
        $route = new Route('put', $path, $callback);
        self::$routes['put'][$path] = $route;
        return $route;
    }

    public static function delete($path, $callback): Route
    {
        $route = new Route('delete', $path, $callback);
        self::$routes['delete'][$path] = $route;
        return $route;
    }

    public static function resolve()
    {
        $method = $_POST['_method'] ?? self::$request->getMethod();
        $path = self::$request->getPath();

        $route = null;
        $params = [];

        foreach (self::$routes[$method] ?? [] as $routePath => $registeredRoute) {

            $pattern = preg_replace(
                '#\{([^}]+)\}#',
                '([^/]+)',
                $routePath
            );

            if (preg_match("#^{$pattern}$#", $path, $matches)) {

                $route = $registeredRoute;

                array_shift($matches);

                preg_match_all(
                    '#\{([^}]+)\}#',
                    $routePath,
                    $paramNames
                );

                foreach ($paramNames[1] as $index => $name) {
                    $params[$name] = $matches[$index];
                }

                break;
            }
        }

        if (!$route) {
            self::$response->setStatusCode(404);
            abort();
        }

        if ($middleware = $route->getMiddleware()) {
            $middlewareClass = "App\\Middleware\\" . ucfirst($middleware) . "Middleware";

            if (class_exists($middlewareClass)) {
                $instance = new $middlewareClass();
                $instance->handle();
            }
        }

        $callback = $route->getCallback();

        if (is_array($callback)) {
            [$controllerClass, $methodName] = $callback;

            $controller = new $controllerClass();

            return call_user_func_array(
                [$controller, $methodName],
                array_values($params)
            );
        }

        return call_user_func_array($callback, array_values($params));
    }
}
