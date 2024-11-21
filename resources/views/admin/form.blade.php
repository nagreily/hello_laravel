<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FORM</title>
{{-- CSRF域   使用 @csrf Blade 指令来生成一个 token 域--}}
    <form method="POST" action="">
        @csrf
        ...
    </form>
{{--@使用method来创建方法域--}}
    <form action="" method="POST">
        @method('PUT')
        ...
    </form>
</head>
<body>

</body>
</html>
