<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container m-3">
        <h2>{{ config('app.name') }}</h2>
        <a href="{{ route('logout') }}">Logout</a>
        <div class="row">
            <div class="text-center">
                <p class="lead">Welcome! {{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>
</body>
</html>