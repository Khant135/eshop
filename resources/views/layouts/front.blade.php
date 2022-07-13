<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- CSS Files -->

    <link href="{{asset('frontend/css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <style>
        a {
            text-decoration: none !important;
        }
    </style>

</head>

<body>
    @include('layouts.inc.frontendnav')
    <div class="content">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        var availableTags = [];
        $.ajax({
            method: "GET",
            url: "/searchproduct",
            success: function(response) {
                autogetsearch(response);
            }
        });

        function autogetsearch(availableTags) {
            $("#search_product").autocomplete({
                source: availableTags
            });
        }
    </script>
    @if(session()->has('message'))
    <script>
        swal("{{session('message')}}")
    </script>
    @endif
    @if(session()->has('status'))
    <script>
        swal("{{session('status')}}")
    </script>
    @endif
    @yield('scripts')
</body>

</html>