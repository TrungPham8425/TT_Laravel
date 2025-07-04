<!-- Database, Migrations & Eloquent -->

## 1. Cấu hình database (MySQL hoặc SQLite), seeder, factory

- Laravel sử dụng file .env để cấu hình kết nối đến cơ sở dữ liệu.
  MySQL là hệ quản trị cơ sở dữ liệu phổ biến.
  SQLite là cơ sở dữ liệu nhẹ, không cần cài đặt server.

- Cấu hình gồm các thành phần
  DB_CONNECTION: Loại cơ sở dữ liệu (`mysql`, `sqlite`)
  DB_HOST: Địa chỉ host DB (thường là `127.0.0.1`)
  DB_PORT: Cổng kết nối DB (MySQL: `3306`)
  DB_DATABASE: Tên cơ sở dữ liệu
  DB_USERNAME: Tên đăng nhập
  DB_PASSWORD: Mật khẩu đăng nhập

## 2. MIGRATIONS – TẠO / QUẢN LÝ BẢNG

- Migration là file PHP chứa code tạo hoặc sửa bảng
- Migration giúp định nghĩa và quản lý cấu trúc bảng CSDL bằng code PHP
- Cấu thúc gồm 2 hàm

* Hàm up(): Dùng để tạo hoặc thay đổi bảng
* Hàm down(): Dùng để hoàn tác(rollback)

## 3. SEEDERS

- Seeder được tạo nhằm tạo ra các dữ liệu mẫu phục vụ thử nghiệm
- Seeder được đặt trong thư mục database/seeders/
- Để tạo một seeder dùng câu lệnh: php artisan make:seeder TenSeeder

## 4. FACTORIES

- Factory là các class giúp tạo mẫu giữ liệu giả(fake data) nhanh chóng, thường dùng để seed hoặc test

## 5. ELOQUENT ORM

- Eloquent là ORM (Object-Relational Mapping) tích hợp sẵn trong Laravel giúp làm việc với DB dễ dàng bằng cú pháp PHP hướng đối tượng.
- Các điểm chính bao gồm

* model:đại diện ccho bảng
* Mỗi bản ghi bằng một đối tượng
* Tự động ánh xạ tên bảng

## 6. SCOPE

- SCOPE giúp tái sử dụng đoặn truy vấn logic trong model

VD: Sử dụng User::active()->get();
public function scopeActive($query)
{
return $query->where('active', 1);
}

## 7. ACCESSORS & MUTATORS

- Accessors: Chỉnh dữ liệu trước khi trả về.
- Mutators: Chỉnh dữ liệu trước khi lưu vào DB.
