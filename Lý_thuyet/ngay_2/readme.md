<!-- Routing, Views & Blade nâng cao -->

## 1. Routing: Prefix groups, Middleware groups, Named routes, Route Model Binding, Fallback

# Prefix Groups (Tiền tố nhóm)

- Dùng để gộp nhiều route chung 1 tiền tố URL và ránh lặp lại tiền tố trong từng route
  VD:
  Route::prefix('admin')->group(function () {
  Route::get('/dashboard', [AdminController::class, 'dashboard']);
  Route::get('/users', [AdminController::class, 'users']);
  });

# Middleware Groups

- Dùng để bảo vệ nhóm route bằng một hoặc nhiều middleware
- Thực thi logic như: xác thực (auth), phân quyền (role:admin), giới hạn truy cập (throttle)

VD:
Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/settings', [SettingsController::class, 'index']);
});

# NAMED ROUTES

Mục đích:

- Tránh hardcode URL trong ứng dụng
- Dễ dàng thay đổi URL mà không ảnh hưởng đến nơi khác
- Hữu ích cho route(), redirect()->route(), @route() trong Blade

Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

VD:
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

# ROUTE MODEL BINDING

ROUTE MODEL BINDING dùng để:

- Tự động ánh xạ tham số URL với model tương ứng
- Tránh viết thủ công Model::find($id)
- Giảm code + bảo mật hơn (trả về 404 nếu không tìm thấy)

# Fallback Route

- Dùng để xử lý 404 Not Found thân thiện và hướng dẫn người dùng khi ỦL không tồn tại

VD:
Route::fallback(function () {
return response()->view('errors.404', [], 404);
});

## 2. Blade Template: Layouts, Sections, Slots, Components, Blade Directives (e.g. @auth, @error)

# Layouts (Bố cục giao diện)

- Blade cho phép tạo bố cục chính (layout) và các view con có thể kế thừa lại.

# Sections và @yield

- Dùng để định nghĩa nội dung cho các phần của layout
- Cấu trúc :
  @section('ten'): Bắt đầu một section
  @endsection hoặc @show: Kết thúc section
  @yield('ten'): Hiển thị nội dung section trong layout

# Blade Components

- Cho phép tách phần HTML thành các component tái sử dụng

# Slots

- Slots là phần nội dung nằm giữa thẻ mở và đóng của component

# Blade Directives

- Các directive được Blade cung cấp sẵn, giúp viết điều kiện, vòng lặp, và xử lý logic ngắn gọn hơn.

## 3. CSRF Protection

- CSRF (Cross-Site Request Forgery) là một hình thức tấn công mà kẻ xấu lợi dụng phiên đăng nhập của người dùng để thực hiện các hành động trái phép thay mặt họ.
- Laravel cung cấp cơ chế bảo vệ CSRF mặc định cho các form gửi dữ liệu POST, PUT, PATCH, DELETE.
- Laravel tự động kiểm tra CSRF token trên mỗi request có thay đổi trạng thái (POST, PUT, DELETE...).

<!-- Controllers, Middleware & Request -->

## 1. Resource Controllers & Single Action Controllers

# Resource Controllers

- Resource Controller giúp bạn nhanh chóng tạo ra một controller có đầy đủ các phương thức CRUD (Create, Read, Update, Delete) cho một tài nguyên
- Để tạo Resource Controllers dùng câu lệnh: php artisan make:controller Ten-Controller --resource

# Single Action Controllers

- Dùng cho các controller chỉ cần xử lý một hành động duy nhất (không cần đủ CRUD), giúp đơn giản hóa controller.
- Để tạo sử dụng câu lệnh: php artisan make:controller Ten-Controller --invokable

# Sự khác biệt giữa Resource Controllers & Single Action Controllers

- Về số lượng hành động thì Resource Controller có nhiều CRUD còn Single Action Controllers chỉ có một

- Các phương thức định nghĩa phương thức thì Resource Controller có nhiều phương thức như index, show... còn Single Action Controllers chỉ có duy nhất \_\_invoke()

- Resource Controller dùng khi thoa tác đầy đủ CRUD còn Single Action Controllers dùng khi cần một hành động duy nhất

## 2. Tạo Middleware: Check điều kiện truy cập

- Middleware trong Laravel là lớp trung gian xử lý các request trước khi chúng đến Controller, dùng để:
  Kiểm tra quyền truy cập
  Xác thực (Auth)
  Ghi log, xử lý session, CORS, throttle, v.v.

- Để tạo middleware dùng câu lệnh:
  php artisan make:middleware Ten-middleware

## 3. Custom Form Request: Tách validation vào class riêng"

- Dùng để tách logic kiểm tra dữ liệu đầu vào (validation) ra khỏi controller, giúp code rõ ràng và dễ bảo trì hơn.
- Để tạo form request class dung câu lệnh: php artisan make:request Ten-request
