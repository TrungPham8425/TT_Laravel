# Clean Code & Best Practices

## 1. Nguyên tắc Clean Code

- Đặt tên rõ nghĩa: Biến, hàm, class nên mô tả rõ mục đích.
  - Ví dụ: `getUserById()` thay vì `gub()`
- Hàm ngắn gọn: Mỗi hàm nên làm một việc duy nhất, không quá dài (5–20 dòng là tối ưu).
- Tránh lặp code (DRY - Don't Repeat Yourself): Tái sử dụng logic bằng hàm, trait, service hoặc class dùng chung.
- Comment hợp lý: Chỉ nên dùng để giải thích ý định, không lạm dụng mô tả cái đã hiển nhiên.
- Tách biệt logic: Controller chỉ nên gọi service hoặc repository, không xử lý logic trực tiếp.
- Chuẩn hóa đặt tên & format code: Tuân theo coding convention (ví dụ: PSR-12 trong PHP/Laravel).

## 2. Best Practices trong Laravel

- Validation:
  - Dùng `Form Request` để tách logic validate khỏi controller.
- Service Layer / Repository Pattern:
  - Tách biệt xử lý logic nghiệp vụ (Service) và xử lý dữ liệu (Repository).
- Resource classes:
  - Sử dụng `JsonResource` để chuẩn hóa output dữ liệu API.
- Middleware:
  - Dùng cho kiểm tra xác thực, logging, rate limiting,...
- Authorization:
  - Sử dụng `Gate`, `Policy`, `@can`, `@cannot`, middleware `can:` để phân quyền.
- Testing:
  - Sử dụng PHPUnit hoặc Pest để viết Unit test, Feature test cho Controller, Model, Service.

---

# Performance & Bảo mật

## 1. Tối ưu hiệu năng (Performance Optimization)

### Cache

- View cache: `php artisan view:cache`
- Route cache: `php artisan route:cache`
- Config cache: `php artisan config:cache`
- Query cache: Dùng `remember()` hoặc Redis cache cho truy vấn lặp lại.

### Database

- Index cột tìm kiếm hoặc join.
- Dùng eager loading (`with()`) thay vì lazy loading (`$post->user`) trong vòng lặp.
- Phân trang (`paginate()`) thay vì lấy tất cả (`get()`).

### Queues

- Dùng hàng đợi (`Queue`) để xử lý chậm như gửi email, xử lý file lớn.
- Cài đặt worker bằng `php artisan queue:work`.

### Optimize command

- Gộp lệnh:
  ```bash
  php artisan optimize
  php artisan optimize:clear
  ```

## 2. 2. Bảo mật (Security)

# Input & XSS

- Tất cả form nên có token CSRF: @csrf
- Escape dữ liệu đầu ra: {{ $data }} thay vì {!! $data !!}

# SQL Injection

- Sử dụng Eloquent ORM hoặc Query Builder, không dùng raw query có gắn biến trực tiếp.

# Auth & Token

- Dùng Laravel Sanctum hoặc Passport để bảo vệ API.
- Lưu token ở HttpOnly cookies hoặc Authorization header.

# Bảo mật tài khoản

- Mã hóa mật khẩu bằng bcrypt(), Laravel tự dùng Hash::make()
- Giới hạn đăng nhập sai (ThrottleRequests middleware)
- Thêm xác thực 2 bước (2FA) nếu cần.

# File Upload

- Kiểm tra định dạng và dung lượng trước khi upload.
- Lưu tên file ngẫu nhiên để tránh overwrite hoặc lộ file cũ.
