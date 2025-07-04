<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    // Xác định quyền truy cập (cho phép tất cả user đã đăng nhập)
    public function authorize(): bool
    {
        return true;
    }

    // Quy tắc validate dữ liệu gửi lên
    public function rules(): array
    {
        return [
            'title' => 'required|unique:posts,title', // Tiêu đề bắt buộc, không trùng
            'content' => 'required|min:50', // Nội dung tối thiểu 50 ký tự
        ];
    }

    // Thông báo lỗi tuỳ chỉnh (tiếng Việt)
    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.unique' => 'Tiêu đề đã tồn tại.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'content.min' => 'Nội dung phải có ít nhất 50 ký tự.',
        ];
    }
}
