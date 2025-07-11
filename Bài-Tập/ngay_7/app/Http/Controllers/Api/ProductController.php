<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách tất cả sản phẩm
     */
    public function index(): JsonResponse
    {
        try {
            // Lấy tất cả sản phẩm từ database
            $products = Product::all();

            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách sản phẩm thành công',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy danh sách sản phẩm: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lưu sản phẩm mới vào database
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate dữ liệu đầu vào
            $validator = Validator::make($request->all(), Product::$rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Tạo sản phẩm mới
            $product = Product::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Tạo sản phẩm thành công',
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi tạo sản phẩm: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hiển thị chi tiết sản phẩm theo ID
     */
    public function show(string $id): JsonResponse
    {
        try {
            // Tìm sản phẩm theo ID
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Lấy thông tin sản phẩm thành công',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lấy thông tin sản phẩm: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cập nhật thông tin sản phẩm
     */
    public function update(Request $request, string $id): JsonResponse
    {
        try {
            // Tìm sản phẩm theo ID
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm'
                ], 404);
            }

            // Validate dữ liệu đầu vào với rules cho update
            $validator = Validator::make($request->all(), Product::getUpdateRules($id));

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Cập nhật sản phẩm
            $product->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật sản phẩm thành công',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi cập nhật sản phẩm: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xóa sản phẩm khỏi database
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            // Tìm sản phẩm theo ID
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm'
                ], 404);
            }

            // Xóa sản phẩm
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Xóa sản phẩm thành công'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi xóa sản phẩm: ' . $e->getMessage()
            ], 500);
        }
    }
}
