<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Đăng nhập người dùng
     */
    public function login(Request $request): JsonResponse
    {
        try {
            // Validate dữ liệu đầu vào
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Thử đăng nhập
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();

                // Tạo token cho user
                $token = $user->createToken('auth-token')->plainTextToken;

                return response()->json([
                    'success' => true,
                    'message' => 'Đăng nhập thành công',
                    'data' => [
                        'user' => $user,
                        'token' => $token
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Email hoặc mật khẩu không đúng'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi đăng nhập: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Đăng xuất người dùng
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            // Xóa token hiện tại
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Đăng xuất thành công'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi đăng xuất: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lấy thông tin người dùng hiện tại
     */
    public function user(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'message' => 'Lấy thông tin người dùng thành công',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy thông tin người dùng: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Đăng ký người dùng mới (bonus)
     */
    public function register(Request $request): JsonResponse
    {
        try {
            // Validate dữ liệu đầu vào
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Tạo user mới
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // Tạo token cho user mới
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Đăng ký thành công',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi đăng ký: ' . $e->getMessage()
            ], 500);
        }
    }
}
