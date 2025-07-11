# DỰ Án TỔng HỢp & TRIỂN KHAI TRONG LARAVEL

---

## 1. Xây dựng Blog hoàn chỉnh

### Chức năng chính:

#### CRUD (Create, Read, Update, Delete)

- Sử dụng Resource Controller để quản lý bài viết.
- Model: `Post`, Migration: `posts`
- Route:

```php
Route::resource('posts', PostController::class);
```

#### Auth (Xác thực)

- Sử dụng Laravel Breeze, Jetstream hoặc Laravel UI:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```

#### Comment

- Quan hệ one-to-many: Bài viết có nhiều bình luận.
- Model: `Comment`, Migration: `comments` với `post_id`, `user_id`
- Trong model Post:

```php
public function comments() {
    return $this->hasMany(Comment::class);
}
```

#### API

- Tạo API cho bài viết, bình luận phục vụ frontend hoặc mobile.
- Route trong api.php:

```php
Route::apiResource('posts', PostApiController::class);
```

---

## 2. Testing trong Laravel

### Mục tiêu:

- Đảm bảo ứng dụng hoạt động đúng khi cập nhật, triển khai.

### Unit Test

- Kiểm thử logic của model, service...
- Tạo test:

```bash
php artisan make:test PostTest
```

- Ví dụ:

```php
public function test_post_title_is_required()
{
    $response = $this->post('/posts', []);
    $response->assertSessionHasErrors('title');
}
```

### HTTP Test (Feature Test)

- Kiểm thử tuyến đường và phản hồi HTTP.
- Ví dụ:

```php
public function test_user_can_create_post()
{
    $response = $this->actingAs(User::factory()->create())
                     ->post('/posts', ['title' => 'Test', 'body' => 'Content']);
    $response->assertRedirect('/posts');
}
```

- Chạy toàn bộ test:

```bash
php artisan test
```

---

## 3. Triển khai lên Laravel Cloud
