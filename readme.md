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

## Returning Other Format
```php
namespace Controllers;

use Foundation\Component\Request;

class HomeController extends Controller
{
    public function showXml(Request $request)
    {
        $array = [
            'Good guy' => [
                'name' => 'Luke Skywalker',
                'weapon' => 'Lightsaber'
            ],
            'Bad guy' => [
                'name' => 'Sauron',
                'weapon' => 'Evil Eye'
            ]
        ];
        return response()->xml($array);
    }

    public function showJson()
    {
        $data = array(
            'para1' => 'data1',
            'para2' => 'data2',
            'para3' => 'data3',
            'para4' => 'data4',
            'para5' => array(
                'innerPara' => array(
                    '1', '2', '3'
                )
            ),
        );
        return response()->json($data);
    }
}
```