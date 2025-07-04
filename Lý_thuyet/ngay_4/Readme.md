## 1. ELOQUENT RELATIONSHIPS

- Eloquent hỗ trợ ánh xạ các mối quan hệ giữa các bảng một cách tự nhiên theo hướng đối tượng

# 1.1 One to One

- Quan hệ One-to-One (1-1) là khi một bản ghi trong bảng A chỉ liên kết với một bản ghi duy nhất trong bảng B, và ngược lại.
- Trong laravel để tạo mối quan hệ 1-1 dùng hasOne()-beLongTo()
- VD: Một User chỉ có một Profile.

# 1.2. One to Many

- Quan hệ One to Many (1-n) là khi một bản ghi trong bảng A có thể liên kết với nhiều bản ghi trong bảng B, nhưng mỗi bản ghi trong bảng B chỉ liên kết với một bản ghi trong bảng A.

- Để tạo mối qua hệ một nhiều sử dụng: hasMany()-beLongTo()

- VD: Một Post có nhiều Comment.

# 1.3. Many to Many

- Quan hệ Many to Many (n-n) xảy ra khi nhiều bản ghi trong bảng A có thể liên kết với nhiều bản ghi trong bảng B, và ngược lại.

- Để tạo mối quan hệ n-n dùng: belongsToMany()-belongsToMany()

- VD: Một User có nhiều Role, và một Role có nhiều User.

# 1.4. Morph

- là mối quan hệ cho phép một model có thể thuộc về nhiều model khác
- Để tạo mối quan hệ sử dụng:morphTo()-morphMany()
- VD: Comment có thể thuộc về Post hoặc Video.

## 2. Query Builder nâng cao: Joins, Subqueries

# 1. Join

- join(): Dùng để kết hợp 2 bảng có dữ liệu khớp
- leftJoin(): Lấy tất cả từ bảng bên trái, kể cả khi bảng phải không khớp
- rightJoin(): Lấy tất cả từ bảng bên phải (ít dùng)
- crossJoin(): Kết hợp tất cả các bản ghi từ 2 bảng

# 2. Subqueries

- SELECT: Lồng truy vấn vào cột
- WHERE: Lọc theo điều kiện từ truy vấn con
- FROM: Dùng truy vấn con làm bảng
- JOIN: JOIN với truy vấn con

## 3. Eager Loading (with(), load())

- Eager Loading là kỹ thuật tải trước các quan hệ Eloquent liên quan trong một truy vấn duy nhất, giúp tránh lỗi N+1 query và tăng hiệu năng.

- with(): Eager load khi truy vấn
- load(): Eager load sau khi đã có model
