<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hệ thống Quản lý Thành viên</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900">
                            🧾 Hệ thống Quản lý Thành viên
                        </h1>
                    </div>
                    <nav class="flex items-center space-x-4">
                        @auth
                        <a href="{{ url('/dashboard') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Dashboard
                        </a>
                        @else
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            Đăng nhập
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Đăng ký
                        </a>
                        @endif
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <!-- Hero Section -->
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">
                        Chào mừng đến với Hệ thống Quản lý Thành viên
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Hệ thống được xây dựng với Laravel, tích hợp đầy đủ tính năng Authentication & Authorization
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    <!-- Authentication -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">🔐 Authentication</h3>
                        </div>
                        <ul class="text-gray-600 space-y-2">
                            <li>• Đăng ký tài khoản mới</li>
                            <li>• Đăng nhập/Đăng xuất</li>
                            <li>• Xác minh email</li>
                            <li>• Quên mật khẩu</li>
                            <li>• Sử dụng Laravel Breeze</li>
                        </ul>
                    </div>

                    <!-- Authorization -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">🔑 Authorization</h3>
                        </div>
                        <ul class="text-gray-600 space-y-2">
                            <li>• Gates & Policies</li>
                            <li>• Role-based access</li>
                            <li>• Admin/User phân quyền</li>
                            <li>• Middleware bảo vệ</li>
                            <li>• Email verification required</li>
                        </ul>
                    </div>

                    <!-- Post Management -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">📝 Quản lý bài viết</h3>
                        </div>
                        <ul class="text-gray-600 space-y-2">
                            <li>• Tạo bài viết mới</li>
                            <li>• Chỉnh sửa bài viết</li>
                            <li>• Xóa bài viết</li>
                            <li>• Trạng thái Draft/Published</li>
                            <li>• Phân quyền theo chủ sở hữu</li>
                        </ul>
                    </div>

                    <!-- Admin Features -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">👥 Quản lý Admin</h3>
                        </div>
                        <ul class="text-gray-600 space-y-2">
                            <li>• Dashboard thống kê</li>
                            <li>• Quản lý tất cả bài viết</li>
                            <li>• Quản lý người dùng</li>
                            <li>• Thay đổi vai trò</li>
                            <li>• Xóa người dùng</li>
                        </ul>
                    </div>

                    <!-- Security -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">🔒 Bảo mật</h3>
                        </div>
                        <ul class="text-gray-600 space-y-2">
                            <li>• Password hashing</li>
                            <li>• CSRF protection</li>
                            <li>• SQL injection protection</li>
                            <li>• XSS protection</li>
                            <li>• Authorization checks</li>
                        </ul>
                    </div>

                    <!-- Technology -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">⚡ Công nghệ</h3>
                        </div>
                        <ul class="text-gray-600 space-y-2">
                            <li>• Laravel 12.x</li>
                            <li>• PHP 8.2+</li>
                            <li>• Tailwind CSS</li>
                            <li>• MySQL/SQLite</li>
                            <li>• Laravel Breeze</li>
                        </ul>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="text-center">
                    @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Vào Dashboard
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-blue-100 hover:bg-blue-200">
                            Đăng nhập
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Đăng ký ngay
                        </a>
                        @endif
                    </div>
                    @endauth
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-gray-300">
                        © 2024 Hệ thống Quản lý Thành viên. Được xây dựng với ❤️ bằng Laravel.
                    </p>
                    <p class="text-gray-400 text-sm mt-2">
                        Laravel Version: 12.x | PHP Version: 8.2+
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>