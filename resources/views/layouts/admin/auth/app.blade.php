
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>管理画面</title>

    <meta name="keywords" content="">
	<meta name="description" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset("/assets/js/app.js") }}"></script>
    <script src="{{ asset("/assets/js/admin/all.min.js") }}"></script>
    <script src="{{ asset("/assets/js/admin/storelist.js") }}"></script>

	<!-- Styles -->
    <link rel="stylesheet" href="{{ asset("/assets/css/admin/OverlayScrollbars.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/assets/css/admin/adminlte.min.css") }}">
</head>
<body class="sidebar-mini">
    <div id="app" class="wrapper">
        @include('layouts.admin.auth.header')

        @include('layouts.admin.auth.sidenav')

        <main class="content-wrapper">
            @if (session('flash_message'))
                <div class="d-flex justify-content-center bg-info text-white p-3">
                    {{ session('flash_message') }}
                </div>
            @endif

            <div class="py-4">
                @yield("content")
            </div>
        </main>

        @include('layouts.admin.auth.footer')
    </div>
    <script src="{{ asset("/assets/js/admin/adminlte.min.js") }}"></script>
</body>
</html>
