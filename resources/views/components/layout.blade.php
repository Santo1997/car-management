<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
    <title>Car Rental</title>

    <style>
        .flatpickr-calendar {
            z-index: 9999 !important;
        }
    </style>
</head>
<body class="relative">
<header class="sticky top-0 z-50">
    <div class="navbar bg-slate-800 text-white">
        <div class="navbar-start">
            <a class="btn btn-ghost text-xl">Car Rental</a>
        </div>
        <div class="navbar-end hidden lg:flex">
            <ul class="menu menu-horizontal px-1 gap-2">
                <li><a href="{{url('/')}}"
                       class="btn btn-outline text-white border-slate-800 hover:text-info hover:border-info">Home</a>
                </li>
                <li><a class="btn btn-outline text-white border-slate-800 hover:text-info hover:border-info">About</a>
                </li>

                @if(Auth::user())
                    <li><a href="{{url('/rentals')}}"
                           class="btn btn-outline text-white border-slate-800 hover:text-info hover:border-info">Rentals</a>
                    </li>
                @endif
                
                <li><a class="btn btn-outline text-white border-slate-800 hover:text-info hover:border-info">Contact</a>
                </li>

                @if(Auth::user())
                    <li>
                        <a href="{{url('/logout')}}"
                           class="btn btn-outline text-white border-slate-800 hover:text-info hover:border-info">Logout</a>
                    </li>
                @else
                    <li>
                        <a href="{{url('/login')}}"
                           class="btn btn-outline text-white border-slate-800 hover:text-info hover:border-info">Login</a>
                    </li>
                    <li>
                        <a href="{{url('/register')}}"
                           class="btn btn-outline text-white border-slate-800 hover:text-info hover:border-info">Singup</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</header>

@include('helper.notify')

<main class="relative">
    {{ $slot }}
</main>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@yield('script')

</body>
</html>
