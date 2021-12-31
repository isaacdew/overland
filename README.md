# Overland
WordPress plugin API framework that mimics Laravel's APIs. Allows you to add routes to the WordPress REST API using a Laravel style.

## Features

- [Authentication](https://github.com/isaacdew/overland/wiki/Authentication)
- [Authorization](https://github.com/isaacdew/overland/wiki/Controllers#authorization)
- [Caching](https://github.com/isaacdew/overland/wiki/Caching)
- [Middleware](https://github.com/isaacdew/overland/wiki/Middleware)
- [Easy to add Routes](https://github.com/isaacdew/overland/wiki/Routes)
- [Validation](https://github.com/isaacdew/overland/wiki/Controllers#validation)

## Getting Started

To get setup you'll need to do the following:
```
git git@github.com:isaacdew/overland.git wordpress/wp-contents/plugins/your-plugin

cd wordpress/wp-contents/plugins/your-plugin

composer install
```

## Basic Usage
You'll find it's pretty similar to writing Laravel code! There are examples in the code as well.

### Creating a Route
Inside of the `routes.php` file simply register your route using the Facade:
```php
Route::get('my-path', function() {
    // route code
});
```

### Creating a Controller
Inside the Controllers directory, create a new file with the name following the psr-4 standard and create a class that extends `Overland\Core\Controller`. For example, `YourController.php` might look like this:

```php
namespace Overland\App\Controllers;

use Overland\Core\Controller;

class YourController extends Controller
{
    public function yourMethod()
    {
        // Stuff!!
    }
}

```

Then in your `routes.php` file:

```php
Route::get('your-path', 'YourContoller@myourMethod');
```

### Creating Middleware
Inside the Controllers directory, create a new file with the name following the psr-4 standard and create a class that extends `Overland\Core\Interfaces\Middleware`. For example, `YourMiddleware.php` might look like this:

```php
namespace Overland\App\Middleware;

use Overland\Core\Interfaces\Middleware;

class YourMiddleware implements Middleware
{
    public function handle()
    {
        // Work your magic here!
    }
}
```

Then inside your `config.php`, you'll want to add your middleware to the list:
```php
...
'middleware' => [
    'your-middleware' => \Overland\App\Middleware\YourMiddleware::class,
    ...
]
...
```

And now you can use it with a route inside your `routes.php`:
```php
Route::middleware(['your-middleware'])->post('/uri', 'YourController@yourMethod');
```

For more information check out the wiki.
