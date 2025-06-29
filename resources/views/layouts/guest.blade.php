<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> صفحه ورود| سیستم مدیریت حسابیار</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{asset('assets/css/login-style.css')}}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0  " >
            <div class="text-center mb-5">
                <a href="/">
                    {{-- <img src="{{asset('assets/images/hessabyaar.png')}}" class="w-20  fill-current text-gray-500 mb-3" /> --}}
                    <h1 class="text-lg mb-3">به سیستم مدیریت حسابیار خوش آمدید</h1>

                </a>
            </div>

            {{-- <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg "> --}}
            {{-- <div class="w-full sm:max-w-md mt-6 px-6 py-4  overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div> --}}

            <div class="d-flex justify-content-center align-items-center vh-100">
                <div class="glassmorphism p-4 rounded shadow-lg w-100" style="max-width: 400px;">
                    {{ $slot }}
                </div>
            </div>



        </div>
    </body>
</html>
