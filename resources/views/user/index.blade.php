<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="icon">
            <img src="{{ asset('images/icons.png') }}" alt="">
        </div>
        <div class="row">
            <div class="form">
                <h2>login</h2>
                <div class="form-control">
                    <form action="{{ route('login') }}"  method="post">
                        @csrf
                        <div class="input-control">
                            <label>Email</label>
                            <input type="text" name="email" />
                        </div>
                        <div class="input-control">
                            <label>Password</label>
                            <input type="password" name="password" />
                        </div>
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="error">{{ $error }}</div>
                            @endforeach
                        @endif
                        <button class="form-submit">Login</button>
                    </form>
                </div>
                <div class="form-register">
                    <a href="{{ route('register') }}">Create Account</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
