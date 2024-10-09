<nav class="navbar navbar-expand navbar-light navbar-white border-bottom shadow-sm">
    <div class="container">
        <a href="{{ route('index') }}" class="navbar-brand">
            <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="img-circle elevation-3" style="max-width: 60px;">
        </a>
        <ul class="navbar-nav">
            {{-- <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link px-2"><strong><i class="fa-duotone fa-user-plus fa-beat fa-lg"></i>สมัครสมาชิก</strong></a>
            </li> --}}
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link px-2"><strong><i class="fa-duotone fa-arrow-right-to-arc fa-lg"></i> เข้าสู่ระบบ</strong></a>
            </li>
        </ul>
    </div>
</nav>
