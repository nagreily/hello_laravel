<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
    <body>
{{--    在appserviceProvider中使用blade::if 创建了名为cloud的if指令--}}
{{--   使用上有什么问题？？？都没到字典中？？？--}}
        @cloud('digitalocean')
        {{--// 应用使用 digitalocean 云服务商……--}}
        @elsecloud('aws')
        {{--// 应用使用 aws 云服务商……--}}
        @else
            {{--// 应用没有使用 digitalocean 亦没有使用 aws 提供的云服务……--}}
        @endcloud

        @unlesscloud('aws')
        {{--// 应用没有使用 aws 提供的云服务……--}}
        @endcloud


    </body>
</html>
