<!-- API & Tích hợp Frontend -->

## 1. API Routes: api.php, Resource Controllers

# api.php

- Laravel cung cấp file riêng api.php để định nghĩa các route phục vụ API.

- Mặc định, các route trong api.php sẽ được prefix là /api và middleware api sẽ được áp dụng.

# Resource Controllers

- Sử dụng để tạo các endpoint chuẩn RÉTful như: index, show, sotre, update, destroy

- Để tạo sử dụng câu lệnh: php artisan make:controller TenController --api

- Resource Controllers giúp tự động ánh xạ các route đến phương thức controller

## 2. Laravel Sanctum

- Mục đích sử dụng:

* Cung cấp bảo mật API đơn giản cho SPA hoặc ứng dụng mobile
* Thay thế cho Passport trong nhiều trường hợp không cần OAuth

- Cách hoạt động:

* Laravel sanctump sử dụng côkie-based session để xác thực SPA

* Hỗ trợ API token nếu cần gọi từ ứng dụng khác như mobile

- Quy trình xác thực

* Bước 1: SPA gửi yêu cầu đăng nhập qua axios/fetch.
* Bước 2: Server xác thực và gửi lại cookie bảo mật.
* Bước 3: SPA sử dụng cookie đó cho các request tiếp theo

## 3. HTTP Client, Vue.js/React tích hợp với Vite

- Laravel HTTP Client
  Sử dụng Http::get(), Http::post()... để gọi đến API bên ngoài.
  Dựa trên Guzzle, tích hợp fluent interface dễ dùng.

- Tích hợp Vue.js/React
  Laravel dùng Vite để build frontend (thay thế Webpack Mix).
  Có thể chọn Vue hoặc React khi cài Breeze hoặc Jetstream.

Ví dụ:
php artisan breeze:install vue
npm install && npm run dev

- Giao tiếp giữa frontend và backend
  Frontend gọi API qua axios hoặc fetch.
  Backend Laravel phản hồi JSON.
  Thường dùng middleware api cho các route này.

## 4. CRUD Product by Vue.js/React on Laravel

- Cấu trúc thường dùng
  Laravel backend cung cấp API (/api/products).
  Vue.js/React frontend gọi các API đó để thực hiện:
  Tạo sản phẩm (Create).
  Hiển thị danh sách (Read).
  Sửa thông tin sản phẩm (Update).
  Xóa sản phẩm (Delete).

- Quy trình tương tác
  Vue/React gửi request qua axios.
  Laravel nhận request tại Controller/API Route.
  Xử lý logic (validate, thao tác DB).
  Trả response JSON về cho frontend.
  Vue/React cập nhật UI theo response nhận được.
