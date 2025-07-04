<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang quản trị')</title>
    <!-- Khu vực push css -->
    @stack('styles')
    <!-- Thêm Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- Header: Thanh điều hướng trên cùng -->
    <header class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin/dashboard">CMS Mini</a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/posts">Bài viết</a></li>
                @auth
                <li class="nav-item"><span class="nav-link">Xin chào, {{ Auth::user()->name }}</span></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link" style="display:inline;">Đăng xuất</button>
                    </form>
                </li>
                @endauth
                @guest
                <li class="nav-item"><a class="nav-link" href="/login">Đăng nhập</a></li>
                @endguest
            </ul>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar: Menu bên trái -->
            <nav class="col-md-2 d-none d-md-block bg-white sidebar border-end min-vh-100">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="/admin/posts">Quản lý bài viết</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/dashboard">Thống kê</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Nội dung chính -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer: Chân trang -->
    <footer class="text-center py-3 bg-white border-top mt-4">
        <small>© {{ date('Y') }} CMS Mini - Quản trị bởi Admin</small>
    </footer>

    <!-- Khu vực push script -->
    @stack('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>