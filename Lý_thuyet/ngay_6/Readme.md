<!-- Authentication & Authorization -->

## 1. Authen tự viết thủ công: Đăng nhập, Đăng xuất, đăng ký, xác minh email

# Đăng ký

- Tạo form đăng nhập
- Validation đầu vào
- Hash mật khẩu bằng Hash::make()
- Lưu người dùng vào bảng users

# Đăng nhập

- Tìm người dùng theo email
- Kiểm tra mật khẩu bằng Hash::check()
- Nếu thông tin hợp lệ dùng Auth::login($user) hoặc session để lưu trạng thái đăng nhập

# Đăng xuất

- Dùng Auth::logout() hoặc session()->forget('user')

# Xác minh email

- Gửi email chứa token
- Khi ngươi dùng nhấn link, kiểm tra token và cập nhật cột email_verified_at trong bảng users

## 2. Authen với Breeze: Đăng nhập, Đăng xuất, đăng ký, xác minh email

- Để cài đặt Breeze dùng tổ hợp câu lệnh:
  composer require laravel/breeze --dev
  php artisan breeze:install
  npm install && npm run dev
  php artisan migrate

- Các tính năng được tích hợp sẵn
  Đăng ký, đăng nhập, đăng xuất
  Xác minh email
  Quên mật khẩu và đặt lại
  Xử lý validation và error message
  Giao diện sẵn

## 3. Authorization: Gates & Policies

# Gate

- Dùng để định nghĩa quyền theo logic thủ công, không gần với model cụ thể

VD:
Gate::define('edit-settings', function (User $user) {
return $user->isAdmin();
});

# b. Policy

- Gần với model cụ thể, giúp tổ chức quyền theo nhóm
- Để tạo dùng câu lệnh: php artisan make:policy PostPolicy --model=Post

## 4. Forgot/Reset Password

- Gửi link quên mật khẩu bằng Password::sendResetLink()
  VD: Password::sendResetLink(['email' => $request->email]);

- Đặt lại mật khẩu
  Xác thực mật khẩu
  Dùng Password::reset() để cập nhật mật khẩu
  VD:
  Password::reset(
  [code ...],
  function ($user, $password) {
        $user->password = Hash::make($password);
  $user->save();
  }
  );
