<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Portfolio')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('partials.navbar')

    <main>
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 12px 20px; margin: 20px auto; max-width: 900px; border-radius: 4px; border: 1px solid #c3e6cb; font-weight: 500;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>