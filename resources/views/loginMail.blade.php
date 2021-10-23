<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login by clicking the link</title>
    <style type="text/css">
        .container {
            text-align: center;
            margin: 50px;
        }
        .btn {
            background-color: #ccc;
            padding: 10px 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{{ config('app.name') }}</h2>
        <div class="text-center">
            <a class="btn" href="{{ route('loginVerify', ['token' => $token]) }}">Click to Login</a>
        </div>
    </div>
</body>
</html>