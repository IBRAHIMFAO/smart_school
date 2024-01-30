<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/timetable.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
        {{-- <link rel="stylesheet" href="{{ url('css/attendance.css') }}"> --}}
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @stack("css")
    <title>@yield('title')</title>
</head>
    <body>
            @include('dashboard.public.navbar')


            @yield('content')
            @yield('content2')

            <script src="{{ url('jquery.min.js') }}"></script>
            <script src="{{ url('bootstrap.min.js') }}"></script>
            <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
           <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
            <script>
                $(document).ready( function () {
                    $('#tableindex').DataTable();
                } );
            </script>
<script src="{{ mix('/js/app.js') }}"></script>

@stack('js')
</body>
</html>
