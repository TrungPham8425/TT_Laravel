<!-- Tối ưu hóa & Công cụ hỗ trợ -->

## 1. Cache: View cache, Route cache, Query cache, Optimize, Clear

# View cache

- dùng để biên dịch trước các file Blade thành PHP để tăng tốc độ render
- Để tạo dùng lệnh: php artisan view:cache

# Route Cache

- Dùng để tạo các bản sao cache cho toàn bộ định tuyến nhằm giảm thời gian phân tích file route
- Để tạo sử dụng câu lệnh: php artisan route:cache

# Config cache

- Dùng để lưu lại toàn bộ tuyến ở dạng biên dịch sẵn để tăng tốc xử lý.
- Để tạo sử dụng câu lệnh: php artisan route:cache

# Query Cache

- Sử dụng Redis/File/Database để lưu kết quả truy vấn

# Optimize & Clear

- Tổng hợp nhiều bước tối ưu:
  php artisan optimize
  php artisan optimize:clear

## 2. Queue (Hàng đợi)

- Laravel Queue giúp xử lý các tác vụ chạy nền không chặn quy trình chính.
- Cấu trúc:
  Jobs: Lớp mô tả công việc.
  Workers: Tiến trình xử lý hàng đợi.
  Failed Jobs: Lưu lỗi job nếu thực thi thất bại.
  Retry: Gửi lại job lỗi.

## 3. 3. Events & Listeners

- Event: Một hành động đã xảy ra
- Listener: Xử lý khi event xảy ra
- Mục đích
  Tách logic xử lý khỏi controller.
  Dễ bảo trì, mở rộng.

## 4. Notifications

- Laravel Notification gửi thông báo qua nhiều kênh
- Để tạo Notifications dùng câu lệnh: php artisan make:notification InvoicePaid

## 5. Task Scheduling

- Thay thế Cron jobs truyền thống bằng Laravel command.
