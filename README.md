# php-framework

An implementation of a basic MVC php framework.

## Router

The router class maps the requested HTTP method and path to a controller method. The `addRoute` method takes an instantiated `Route` as an argument.
```php
// public/index.php

$router = new Router();

$router->addRoute(new Route("GET", "/", Homepage::class, "show"));

Router::dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
```

## Route

A Route consists of a method, URI, controller class name and controller method. By including `{my_param}` in the URI, we can use wildcards to match the request. The matched string is then passed to the controller via the `Request` object.

```php
$router->addRoute(new Route("GET", "/user/{username}", User::class, "show"));
```

## Middleware

Middleware can be added to the router which is run before the controller method. Middleware is passed a `Request` and `Response` object. These can then be mutated before being passed onto the next middleware or controller. Multiple routers can instantiated to create groups of middleware.

```php
// App/Middleware/CustomHeader.php

class CustomHeader implements Middleware {
	public function run(Request $req, Response $resp) {
		$resp->headers['X-Custom-Header'] = 'some value';
	}
}

// public/index.php

$router->addMiddleware(new CustomHeader());
```

## Controller

## Request

## Response