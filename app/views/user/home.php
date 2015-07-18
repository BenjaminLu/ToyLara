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