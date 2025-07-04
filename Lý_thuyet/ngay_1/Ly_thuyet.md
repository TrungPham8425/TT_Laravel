<!-- Làm quen với Laravel, môi trường phát triển, cấu trúc và Service Container -->

# 1. Cài đặt Laravel qua Composer và Laravel Sail (Docker)

- Để cài đặt Laravel sử dụng câu lệnh: composer create-project laravel/laravel ten-du-an
- Sau khi cài đặt cd tới thư mục mới tạo
- Sau khi cài đặt chạy migrate bằng câu lệnh: php artisan migrate
- Và chạy câu lệnh "php artisan ser" để chạy dự án

# 2. Cấu trúc thư mục laravel

- /aap: chứa các code chính như controller, model, ...
- /bootstrap: Khởi động framework, load app.php, cache
- /config: Các file cấu hình ứng dụng
- /database: Migration, seeders, factories
- /databa: Web root, chứa index.php, assets
- /resources: Blade, JS, SCSS
- /routes: Web, API, Console, Channels
- /storage: Logs, cache, file upload
- /tests: Unit & Feature test
- /vendor: Package của Composer
- /.env: dùng để cài đặt thông số môi trường

# 3. Cấu hình .env, debug, timezone, locale

- Laravel sử dụng .env để cấu hình tùy theo từng môi trường: local, production, staging...
  VD: file .env cơ bản
  APP_NAME=Laravel
  APP_ENV=local
  APP_KEY=base64:sOMeKeY=
  APP_DEBUG=true
  APP_URL=http://localhost
  LOG_CHANNEL=stack
  LOG_LEVEL=debug
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=laravel_db
  DB_USERNAME=root
  DB_PASSWORD=

* Bật / Tắt Debug (hiển thị lỗi)
  Cách bật trong .env
  APP_DEBUG=true // bật: Laravel hiển thị lỗi chi tiết khi có lỗi (tốt cho lập trình viên).
  APP_DEBUG=false // tắt:Laravel chỉ hiển thị lỗi chung, không để lộ thông tin hệ thống (phù hợp với production).

- Mặc định APP_DEBUG=true trong môi trường phát triển.

* Cấu hình Timezone – Múi giờ

- Để Timezone – Múi giờ hệ thống

Bước 1:
Mở config/app.php
sau đó thêm dòng này
'timezone' => env('APP_TIMEZONE', 'UTC'),

Bước 2: thêm đoạn code này vào file .env
APP_TIMEZONE=Asia/Ho_Chi_Minh

- Locale – Ngôn ngữ mặc định

* Để mở:
  Bước 1: Mở config/app.php
  sau đó thêm đoạn code:
  'locale' => env('APP_LOCALE', 'en'),
  'fallback_locale' => 'en',
  Bước 2: Mở file .env
  APP_LOCALE=vi

# 4. Service Container & Dependency Injection (DI) + Quan trọng"

1. Service Container

- Service Container là một IoC Container dùng để:
  Quản lý phụ thuộc giữa các class
  Tự động khởi tạo và inject dependencies
  Cho phép binding interface vào implementation
  Hỗ trợ singleton và lazy loading

2. Dependency Injection (DI)

- DI là kỹ thuật truyền dependencies vào class thay vì tạo trực tiếp trong class đó.

3. Binding trong Service Container

- Bind thủ công:
  $this->app->bind(
    'App\Services\MyService',
    function ($app) {
  return new \App\Services\MyService('tham so');
  }
  );

- Bind interface:
  $this->app->bind(
  \App\Contracts\PaymentInterface::class,
  \App\Services\PaypalPayment::class
  );

4. Singleton vs Bind
   `bind()`: Tạo instance mới mỗi lần resolve
   `singleton()`: Chỉ tạo duy nhất 1 instance dùng chung

5. Resolve – Lấy service từ Container
   $service = app()->make(MyService::class);
   $service = resolve(MyService::class);
