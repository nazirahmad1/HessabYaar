<!DOCTYPE html>
<html lang="fa" dir="rtl" data-menu-size="sm-hover">
<head>

<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    {{-- <meta name="csrf-token" content="{{csrf-token()}}"> --}}

    <title> @yield('page_title') | سیستم مدیریت حسابیار</title>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description"
          {{-- content="حسابیار: An advanced, fully responsive admin finance dashboard " /> --}}
     <meta name="author" content="Finance" />
     <meta name="keywords"
          content="حسابیار, admin dashboard, responsive " />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="robots" content="index, follow" />
    

     <!-- App favicon -->
     <link rel="shortcut icon" href="/assets/images/favicon.png">

     {{-- <link rel="shortcut icon" href="{{asset('assets/images/favicon.html')}}"> --}}

     <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
     <link rel="stylesheet" href="{{asset('assets/css/icons.css')}}">
     <link rel="stylesheet" href="{{asset('assets/css/fontiran.min.css')}}">
     <script src="{{asset('assets/js/config.js')}}"></script>


    <!-- Define a stack for CSS Files -->
    @stack('styles')



</head>

<body>

    <div class="wrapper">
        {{-- header  --}}
            <x-header></x-header>
        {{-- header --}}

        <!-- Activity Timeline -->
        {{-- navbar --}}
            <x-navbar></x-navbar>
        {{-- navbar --}}

        {{-- sidebar --}}
            <x-sidebar></x-sidebar>
        {{-- sidebar --}}
            
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>

            <!-- ========== Footer Start ========== -->
                <x-footer></x-footer>
            <!-- ========== Footer End ========== -->

        </div>
    </div>

    {{-- <x-themesettings></themesettings> --}}




      <script src="{{asset('assets/js/jquery.js')}}"></script>
<!-- Toastr CSS -->
 <link rel="stylesheet" href="{{asset('assets/js/toast/toastr.min.css')}}">
<!-- Toastr JS -->
<script src="{{asset('assets/js/toast/toastr.min.js')}}"></script>
<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: "5000"
    };
</script> 


<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/layout.js')}}"></script>

  @stack('scripts')

</body>

</html>
