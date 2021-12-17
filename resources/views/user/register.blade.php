<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ 'css/style.css' }}">
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="icon">
    </div>
    <div class="row">
        <div class="form">
            <h2>Register</h2>
            <div class="form-control">
                <form action="{{ route('register_form') }}" method="post">
                    @csrf
                    <div class="input-control">
                        <label>Name</label>
                        <input type="text" name="name" />
                    </div>
                    <div class="input-control">
                        <label>Company</label>
                        <input type="text" name="company" />
                    </div>
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
                    @if (Session::has('success'))
                        <div class="success">
                           {{ Session::get('success') }}
                        </div>
                    @endif
                    <button class="form-submit">register</button>
                </form>
            </div>
            <div class="form-login">
                <a href="{{ url('/') }}">Login</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

