## Laravel Like Restful Routing

```php
Route::get('/', 'HomeController@index');
Route::get('/user/{id}', 'UserController@show');
Route::post('/user/{id}', 'UserController@store');
```

## Laravel Flavored Controller
```php
namespace Controllers;

use Foundation\Component\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function show(Request $request)
    {
        $params = $request->getParameters();
        return view('user.home')->with('params', $params);
    }

    public function store(Request $request)
    {
        $postParameters = $request->postParameters();
        return view('user.home')->with('params', $postParameters);
    }
    
    public function redirectAnyway()
    {
        return redirect('/user/7');
    }
    
    public function errorAnyway()
    {
        return abort(401);
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
<ul>
    <?php foreach ($params as $key => $value) { ?>
        <li>{{$key}}</li>
        <li>{{$value}}</li>
    <?php } ?>
</ul>
</body>
</html>
```

## Logging
message will be written in `/app/log/datetime.txt`
```php
Log::info('message');
Log::warning('message');
Log::error('message');
```

##  Helper Functions
```php
<img src="{{url('/img/banner.jpg')}}" alt="banner"/>
```