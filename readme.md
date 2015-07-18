## Laravel Like Restful Routing

```php
Route::get('/', 'HomeController@index');
Route::get('/user/{id}', 'UserController@show');
```

## Laravel Flavored Controller and Helper Functions
```php
namespace Controllers;

class UserController extends Controller {
    public function index()
    {
        return view('user.home');
    }

    public function show($parameter)
    {
        return view('user.home')->with('id' , $parameter['id']);
    }
}
```

## Show Variables in Views
```php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <div class="message">
        User {{$id}} home
    </div>
</body>
</html>
```