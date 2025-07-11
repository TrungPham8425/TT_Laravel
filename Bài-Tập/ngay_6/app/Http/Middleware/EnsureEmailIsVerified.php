<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu user đã đăng nhập nhưng chưa xác minh email
        if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
            // Flash message cảnh báo
            session()->flash('warning', 'Vui lòng xác minh email của bạn trước khi tiếp tục!');

            // Chuyển hướng đến trang thông báo xác minh email
            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
