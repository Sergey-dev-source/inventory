<nav class="navbar navbar-expand-lg navbar-light bg-light" id="menu">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">Brand</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <a href="#" class="nav-item nav-link active">Home</a>
                <a href="#" class="nav-item nav-link">Profile</a>
                <a href="#" class="nav-item nav-link">Messages</a>
                <a href="#" class="nav-item nav-link disabled" tabindex="-1">Reports</a>
            </div>
            <div class="navbar-nav ms-auto">
                @guest()
                    <span class="nav-item nav-link" ref="logins">Login</span>
                    <span class="nav-item nav-link" ref="registers">Register</span>
                @endguest
                @auth
                    <h5>{{ Auth::user()->name }}</h5>
                     <a href="{{ route('logout') }}" ref="logout" class="nav-item nav-link">Logout</a>
                @endauth

            </div>
        </div>
    </div>
</nav>
@include('user.component.register')
@include('user.component.login')
