## 1. 1. Laravel Forms

- Laravel bảo vệ tất cả form POST, PUT, PATCH, DELETE khỏi CSRF bằng token.

# CSRF

- Sử dụng @csrf trong form để thêm CSRF token:
<form method="POST" action="/submit">
    @csrf
</form>

# Old Input

- Laravel tự động giữ lại input khi validation thất bại.

- VD: Dùng old('field_name') để hiển thị lại dữ liệu
  <input type="text" name="email" value="{{ old('email') }}">

# File Upload

- Form cần có enctype="multipart/form-data
- VD:
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="avatar">
</form>

## 2. Validation nâng cao

- Sử dụng nhằm mục đích:
  Kiểm soát chặt chẽ dữ liệu từ người dùng
  Tách biệt logic kiểm tra khỏi controller
  Dễ mở rộng, tái sử dụng và kiểm thử
  Tuân thủ nguyên lý Separation of Concerns (SoC)

# Custom Rules

- Là các lớp riêng định nghĩa logic kiểm tra dữ liệu cụ thể, không nằm trong bộ luật chuẩn của Laravel.
- Cấu trúc gồm 2 phương thức chính:
  passes($attribute, $value) → kiểm tra hợp lệ.
  message() → thông báo lỗi.

# Form Request Validation

- Là các lớp kế thừa Illuminate\Foundation\Http\FormRequest, chứa các quy tắc kiểm tra và logic phân quyền cho từng request cụ thể.

- Form Request Validation gồm 2 thành phần:
  authorize() → kiểm tra quyền truy cập.
  rules() → khai báo các luật validation.

## 3. Session

- Session (phiên làm việc) là cách Laravel lưu trữ thông tin tạm thời cho từng người dùng giữa các request
