
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Admin</title>

    <!-- Scripts -->
    <script src="{{ asset('/assets/js/app.js') }}" defer></script>
    <script src="{{ asset('/assets/js/all.min.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/customize.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="d-flex flex-column" style="min-height: 100vh;">
        @include('layouts.admin.guest.header')

        <main>
            @if (session('flash_message'))
                <div class="d-flex justify-content-center bg-info text-white p-3">
                    {{ session('flash_message') }}
                </div>
            @endif

            <div class="py-4">
                @yield("content")
            </div>
        </main>

        @include('layouts.admin.guest.footer')
    </div>
    <script src="{{ asset("/assets/js/admin/adminlte.min.js") }}"></script>
</body>
</html>
