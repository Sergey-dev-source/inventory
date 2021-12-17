<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                    <a href="#" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#login">Login</a>
                    <a href="#" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#register">Register</a>
                @endguest
                @auth
                        <a href="{{ route('logout') }}" class="nav-item nav-link">Logout</a>
                @endauth

            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="document.getElementById('loginForm').submit()" class="btn btn-primary">
                    Login
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('register_form') }}" method="post" id="registerForm">
                    @csrf
                    <div class="form-group mb-2">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Company</label>
                        <input type="text" class="form-control" name="company"/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email"/>
                    </div>
                    <div class="form-group mb-2">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('registerForm').submit()">Register</button>
            </div>
        </div>
    </div>
</div>