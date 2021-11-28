<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="bg-gray-600 p-4 text-white">
        <div class="flex w-full justify-between">
            <a href="" class="font-semibold">PMS</a>

            <ul class="flex">
                <li>
                    <a href="{{ url('/') }}" @class(['nav-menu', 'active' => Request::is('/')])>Home</a>
                </li>
                <li>
                    <a href="{{ url('/project') }}" @class([
                        'nav-menu',
                        'active' => Request::is('project'),
                    ])>Project</a>
                </li>
                <li>
                    <a href="{{ url('/user') }}" @class(['nav-menu', 'active' => Request::is('user')])>User</a>
                </li>
                <li>
                    <a href="{{ url('/auth/logout') }}" @class(['nav-menu', 'active' => Request::is('auth')])>Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <main class="py-4 px-4">
        <div class="md:container mx-auto">
            @yield('content')
        </div>
    </main>
</body>

</html>
