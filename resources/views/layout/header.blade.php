<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <title>@yield('title')</title>
</head>
<body>
<div class="slidebar">
    <div class="logo_content">
        <div class="logo">
            <i class='bx bx-target-lock'></i>
            <div class="logo_name">Inventory control</div>
        </div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav_list">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="{{ route('product') }}">
                <i class='bx bx-paperclip'></i>
                <span class="links_name">Product</span>
            </a>
            <span class="tooltip">Product</span>
        </li>
        <li>
            <a href="{{ route('inventory.index') }}">
                <i class='bx bx-target-lock'></i>
                <span class="links_name">Inventory</span>
            </a>
            <span class="tooltip">Inventory</span>
        </li>
        <li>
            <a href="#">
                <i class='bx bx-cart'></i>
                <span class="links_name">Orders</span>
            </a>
            <span class="tooltip">Orders</span>
        </li>
        @if(Auth::user()->role_id == 1)
            <li>
                <a href="#">
                    <i class='bx bx-bar-chart-alt'></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Network</span>
                </a>
                <span class="tooltip">Network</span>
            </li>
        @endif
        <li>
            <a href="#">
                <i class='bx bx-spreadsheet'></i>
                <span class="links_name">More...</span>
            </a>
            <span class="tooltip">More...</span>
        </li>
        <li>
            <a href="{{ route('users.settings') }}">
                <i class='bx bx-cog'></i>
                <span class="links_name">Settings</span>
            </a>
            <span class="tooltip">Settings</span>
        </li>
    </ul>
    <div class="profile_content">
        <div class="profile">
            <div class="profile_detail">
                <div class="name">
                    {{ Auth::user()->name }}
                </div>
            </div>
            <a href="{{ route('logout') }}" style="color: #fff">
                <i class='bx bx-log-out' id="log_out"></i>
            </a>
        </div>
    </div>
</div>
@yield('abs')
<div class="home_content">
    <div class="container-fluid">
        @yield('content')
    </div>
</div>


@yield('scripts')
<script>
    let btn = document.querySelector('#btn');
    let slidebar = document.querySelector('.slidebar');
    btn.onclick = function () {
        slidebar.classList.toggle('active')
    }
</script>
</body>
</html>
