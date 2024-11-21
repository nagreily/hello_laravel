{{--使用@条件语句--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h1>
        @if ($records === 1)
            I have one record!
        @elseif ($records > 1)
            I have multiple records!
        @else
            I don't have any records!
        @endif
    </h1>

    <h1>
        @foreach ($users as $user)
            @if ($user->type == 1)
                @continue
            @endif

            <li>{{ $user->name }}</li>

            @if ($user->number == 5)
                @break
            @endif
        @endforeach
    </h1>
</body>
</html>
