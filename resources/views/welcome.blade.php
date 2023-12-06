<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ИдёмВКино</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('admin/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/styles.css') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url("{{ asset('admin/i/background.jpg') }}");
            background-color: rgba(0, 0, 0, 0.5);
            background-blend-mode: multiply;
            background-size: cover;
            background-attachment: fixed;
            counter-reset: num;
        }

        button {
            margin: 10px;
            width: 200px;
            height: 50px;
            border-radius: 0.5rem;
            font-size: 2rem;
            cursor: pointer;
            background-color: rgba(92, 92, 97, 0.95);
        }

        .button-user {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.95);
        }

        .center {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .header {
            display: flex;
            font-size: 3rem;
            margin: 20px;
            color: rgba(255, 255, 255, 0.95);
        }
    </style>

</head>

<body>
    <h1 class="header center">ИдёмВКино</h1>
    <div class="center">
        <button><a class=" button-user" href="/admin/login">Администратор</a></button>
        <button><a class="button-user" href="/client/index">Посетитель</a></button>
    </div>
</body>

</html>
