<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>

    <link rel="stylesheet" href="/dist/assets/css/main/app.css">
    <link rel="stylesheet" href="/dist/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="/dist/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="/dist/assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="/dist/assets/css/shared/iconly.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css
        " rel="stylesheet">
    @stack('addStyle')
</head>

<body>
<div id="app">
    @include('includes.sidebar')
<div id="main">
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
<h3>@yield('title', 'Admin')</h3>
</div>
<div class="page-content" style="min-height: 100vh">
    @yield('content')
</div>

<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>{{\Carbon\Carbon::now()->parse("Y")}} &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                    href="https://saugi.me">Saugi</a></p>
        </div>
    </div>
</footer>
</div>
</div>
<script src="/dist/assets/js/bootstrap.js"></script>
<script src="/dist/assets/js/app.js"></script>

<!-- Need: Apexcharts -->
{{-- <script src="/dist/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="/dist/assets/js/pages/dashboard.js"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>

@if (Session::has('success'))
    <script>
        Swal.fire({
                text: "{{Session::get('success')}}",
                icon: 'success',
            })
    </script>
@endif

<script>
    $("body").removeClass("theme-dark")
    $("body").addClass("theme-light")
</script>

@stack('addScript')

</body>

</html>
