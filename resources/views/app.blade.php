<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product CRUD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('styles')
</head>
<body>
<div class="p-5 text-dark text-center">
    <h1>Product Management System</h1>
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="/">Home</a>
            </li>
        </ul>
    </div>
</nav>
@yield('content')
<div class="mt-5 p-4 bg-dark text-white text-center">
    <p>Footer</p>
</div>
@yield('script')
</body>
</html>
