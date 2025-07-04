# Tài liệu kiến trúc dự án Blog Laravel

## 1. Vai trò các thư mục chính

-   `app/Http`: Chứa controller, middleware, request xử lý HTTP.
-   `app/Providers`: Chứa các service provider để đăng ký service, binding, event...
-   `resources/views`: Chứa các file giao diện Blade.
-   `routes/`: Định nghĩa các route của ứng dụng.
-   `storage/`: Lưu trữ file log, cache, session, file upload tạm thời.
-   `bootstrap/`: Khởi tạo ứng dụng, autoload, cache cấu hình.

## 2. Service Container là gì? Nằm ở đâu?

-   Service Container là "hộp chứa" quản lý dependency, giúp tự động inject các class/service cần thiết.
-   Trong Laravel, Service Container nằm ở `Illuminate\Container\Container` và được sử dụng thông qua các Service Provider trong `app/Providers`.

## 3. Chuẩn đặt tên & kiến trúc

-   Áp dụng chuẩn PSR-4 (autoload), PSR-12 (coding style).
-   Kiến trúc: Domain > Services > Interfaces (Contracts)
    -   `Contracts/`: Định nghĩa interface cho các service.
    -   `Services/`: Cài đặt logic cho các service.
    -   `Providers/`: Đăng ký binding các service vào Service Container.
