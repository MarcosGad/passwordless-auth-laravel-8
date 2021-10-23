<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Please register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="m-3">
                <h2>{{ config('app.name') }}</h2>
                @if(\Session::has('error'))
                    <div class="alert alert-danger my-1 w-50">{{ \Session::get('error') }}</div>
                    {{ \Session::forget('error') }}
                @endif
                @if(\Session::has('success'))
                    <div class="alert alert-success my-1 w-50">{{ \Session::get('success') }}</div>
                    {{ \Session::forget('success') }}
                @endif
                <p class="lead">Please register</p>
                <form action="{{ route('register') }}" method="post" class="w-50">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        @error('name')
                            <div class="alert alert-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                        @error('email')
                            <div class="alert alert-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>
</html>