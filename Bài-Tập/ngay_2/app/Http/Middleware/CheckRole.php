<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Xử lý request, chỉ cho phép user có role admin truy cập
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra user đã đăng nhập và có role là admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        // Nếu không phải admin, chuyển hướng về trang chủ hoặc báo lỗi
        abort(403, 'Bạn không có quyền truy cập khu vực này.');
    }
}
