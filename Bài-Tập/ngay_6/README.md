# 🧾 Hệ thống Quản lý Thành viên Laravel

## 📋 Mô tả dự án

Hệ thống quản lý thành viên với đầy đủ tính năng Authentication & Authorization được xây dựng bằng Laravel. Người dùng có thể đăng ký, đăng nhập, xác minh email và quản lý bài viết với hai vai trò chính:

-   **User thường**: Đăng bài viết, chỉnh sửa bài của mình
-   **Admin**: Quản lý toàn bộ bài viết và người dùng

## ✨ Tính năng chính

### 🔐 Authentication

-   ✅ Đăng ký tài khoản mới
-   ✅ Đăng nhập/Đăng xuất
-   ✅ Xác minh email (Email Verification)
-   ✅ Quên mật khẩu (Forgot Password)
-   ✅ Đặt lại mật khẩu (Reset Password)
-   ✅ Sử dụng Laravel Breeze

### 🔑 Authorization

-   ✅ **Gates**: Kiểm soát quyền truy cập
-   ✅ **Policies**: PostPolicy với các phương thức update, delete
-   ✅ **Middleware**: Kiểm tra email verification
-   ✅ **Role-based**: Phân quyền theo vai trò (Admin/User)

### 📝 Quản lý bài viết

-   ✅ Tạo bài viết mới
-   ✅ Xem danh sách bài viết
-   ✅ Chỉnh sửa bài viết
-   ✅ Xóa bài viết
-   ✅ Trạng thái bài viết (Draft/Published)
-   ✅ Phân quyền: User chỉ sửa bài của mình, Admin sửa tất cả

### 👥 Quản lý người dùng (Admin)

-   ✅ Dashboard thống kê tổng quan
-   ✅ Quản lý tất cả người dùng
-   ✅ Thay đổi vai trò người dùng
-   ✅ Xóa người dùng

## 🚀 Cài đặt và chạy

### Yêu cầu hệ thống

-   PHP >= 8.2
-   Composer
-   MySQL/SQLite
-   Node.js & NPM

### Bước 1: Clone và cài đặt dependencies

```bash
git clone <repository-url>
cd ngay_6
composer install
npm install
```

### Bước 2: Cấu hình môi trường

```bash
cp .env.example .env
php artisan key:generate
```

Cấu hình database trong file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_auth
DB_USERNAME=root
DB_PASSWORD=
```

### Bước 3: Chạy migration và seeder

```bash
php artisan migrate:fresh --seed
```

### Bước 4: Build assets

```bash
npm run build
```

### Bước 5: Chạy server

```bash
php artisan serve
```

## 👤 Tài khoản mẫu

Sau khi chạy seeder, bạn có thể sử dụng các tài khoản sau:

### Admin

-   **Email**: admin@example.com
-   **Password**: password
-   **Quyền**: Quản lý tất cả bài viết và người dùng

### User thường

-   **Email**: user@example.com
-   **Password**: password
-   **Quyền**: Chỉ quản lý bài viết của mình

## 📁 Cấu trúc dự án

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── PostController.php      # Quản lý bài viết
│   │   └── AdminController.php     # Quản lý admin
│   └── Middleware/
│       └── EnsureEmailIsVerified.php
├── Models/
│   ├── User.php                    # Model User với role
│   └── Post.php                    # Model Post
├── Policies/
│   └── PostPolicy.php              # Policy cho Post
└── Providers/
    └── AppServiceProvider.php

resources/views/
├── posts/                          # Views cho bài viết
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── show.blade.php
│   └── edit.blade.php
└── admin/                          # Views cho admin
    ├── dashboard.blade.php
    ├── posts.blade.php
    └── users.blade.php

database/
├── migrations/
│   ├── create_posts_table.php
│   └── add_role_to_users_table.php
├── seeders/
│   ├── DatabaseSeeder.php
│   └── PostSeeder.php
└── factories/
    ├── UserFactory.php
    └── PostFactory.php
```

## 🔧 Cấu hình Email

Để sử dụng tính năng xác minh email và quên mật khẩu, cấu hình email trong `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 🧪 Testing

### Use Cases đã kiểm thử

1. **Đăng ký tài khoản mới**

    - ✅ Chuyển hướng tới email verification
    - ✅ Không xác minh → không thể truy cập dashboard
    - ✅ Middleware chặn, hiển thị cảnh báo

2. **Đăng nhập**

    - ✅ Thông tin đúng → chuyển hướng dashboard
    - ✅ Thông tin sai → báo lỗi phù hợp
    - ✅ Sử dụng session()->flash('error')

3. **Quên mật khẩu**

    - ✅ Yêu cầu gửi email reset
    - ✅ Kiểm tra email, đường dẫn reset hợp lệ

4. **Quản lý bài viết**

    - ✅ User tạo, sửa, xóa bài viết của mình
    - ✅ Admin quản lý tất cả bài viết
    - ✅ Authorization hoạt động đúng

5. **Quản lý người dùng (Admin)**
    - ✅ Admin truy cập dashboard quản lý
    - ✅ Thay đổi vai trò người dùng
    - ✅ Xóa người dùng (không xóa chính mình)

## 🔒 Bảo mật

-   ✅ Password được hash bằng bcrypt
-   ✅ CSRF protection
-   ✅ SQL injection protection
-   ✅ XSS protection
-   ✅ Authorization checks
-   ✅ Email verification required

## 📝 API Routes

### Authentication Routes

-   `GET /register` - Form đăng ký
-   `POST /register` - Xử lý đăng ký
-   `GET /login` - Form đăng nhập
-   `POST /login` - Xử lý đăng nhập
-   `POST /logout` - Đăng xuất
-   `GET /forgot-password` - Form quên mật khẩu
-   `POST /forgot-password` - Gửi email reset
-   `GET /reset-password/{token}` - Form đặt lại mật khẩu
-   `POST /reset-password` - Xử lý đặt lại mật khẩu

### Post Routes (Yêu cầu auth + verified)

-   `GET /posts` - Danh sách bài viết
-   `GET /posts/create` - Form tạo bài viết
-   `POST /posts` - Tạo bài viết
-   `GET /posts/{post}` - Xem bài viết
-   `GET /posts/{post}/edit` - Form sửa bài viết
-   `PUT /posts/{post}` - Cập nhật bài viết
-   `DELETE /posts/{post}` - Xóa bài viết

### Admin Routes (Yêu cầu auth + verified + admin)

-   `GET /admin/dashboard` - Dashboard admin
-   `GET /admin/posts` - Quản lý tất cả bài viết
-   `GET /admin/users` - Quản lý người dùng
-   `PATCH /admin/users/{user}/role` - Thay đổi vai trò
-   `DELETE /admin/users/{user}` - Xóa người dùng

## 🎯 Mở rộng nâng cao

Các tính năng có thể thêm vào:

-   🔐 **2FA (Two-Factor Authentication)** với Laravel Fortify
-   🌐 **OAuth Login** (Google, Facebook, GitHub)
-   🎭 **Roles & Permissions** với Laravel Permission package
-   📊 **Analytics Dashboard** với thống kê chi tiết
-   📧 **Email Templates** tùy chỉnh
-   🔍 **Search & Filter** bài viết
-   📱 **API endpoints** cho mobile app

## 📞 Hỗ trợ

Nếu có vấn đề gì, vui lòng tạo issue hoặc liên hệ:

-   **Email**: support@example.com
-   **Documentation**: [Link tài liệu]

---

**Laravel Version**: 12.x  
**PHP Version**: 8.2+  
**License**: MIT
