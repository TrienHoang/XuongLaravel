# Tổng hợp kiến thức chính trong xưởng 

## 1. Eloquent ORM

### CRUD cơ bản

```php
User::all(); // Lấy tất cả
User::find(1); // Lấy theo ID
User::first(); // Lấy bản ghi đầu tiên
User::where('status', 'active')->get(); // Lấy có điều kiện
User::create([...]); // Thêm mới
User::where('id', 1)->update([...]); // Cập nhật
User::find(1)->delete(); // Xoá
```

### Một số hàm phổ biến

```php
User::orderBy('name')->take(10)->get();
User::paginate(15);
User::count();
User::avg('age');
```

### Quan hệ giữa các Model

- One to One: `hasOne()` / `belongsTo()`
- One to Many: `hasMany()` / `belongsTo()`
- Many to Many: `belongsToMany()`
- Morph: `morphTo()`, `morphMany()`

## 2. Migration, Factory, Seeder

### Migration

Tạo và quản lý bảng bằng Laravel:

```bash
php artisan make:migration create_users_table
```

Trong file migration:

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});
```

### Factory

Tạo dữ liệu mẫu tự động:

```bash
php artisan make:factory UserFactory --model=User
```

Ví dụ trong `UserFactory.php`:

```php
return [
    'name' => fake()->name(),
    'email' => fake()->unique()->safeEmail(),
];
```

### Seeder

Tạo và chạy dữ liệu mẫu:

```bash
php artisan make:seeder UserSeeder
```

Trong file seeder:

```php
User::factory()->count(10)->create();
```

Chạy seeder:

```bash
php artisan db:seed --class=UserSeeder
```

## 3. Repository & Service Pattern

### Repository Pattern

T**ách logic truy vấn DB ra khỏi controller, dễ bảo trì:**

```php
interface UserRepositoryInterface {
    public function all();
}

class UserRepository implements UserRepositoryInterface {
    public function all() {
        return User::all();
    }
}
```

Inject vào controller:

```php
public function __construct(UserRepositoryInterface $userRepo) {
    $this->userRepo = $userRepo;
}
```

### Service Pattern

Tách logic xử lý phức tạp khỏi controller:

```php
class OrderService {
    public function createOrder($data) {
        // handle logic
    }
}
```

Gọi trong controller:

```php
$this->orderService->createOrder($request->all());
```

## 4. Tối ưu hóa cơ sở dữ liệu

### Kỹ thuật

- Tránh N+1: `with()`, `load()`
- Chỉ số (index), unique
- Dùng cache: `remember()`
- Pagination thay vì `get()`
- Dùng Raw query khi cần
- Transactions: đảm bảo dữ liệu an toàn

### Kiểm tra truy vấn

```php
DB::select(DB::raw('EXPLAIN SELECT * FROM users'));
```

### Bảo mật

- Policy, Gate
- Tránh SQL injection bằng Query Builder
- Dùng Middleware & Laravel Spatie Permissions
- Ẩn field nhạy cảm với `$hidden`

## 5. Query Builder nâng cao

### Xử lý dữ liệu lớn

```php
DB::table('users')->chunk(100, fn($users) => ...);
DB::table('users')->lazy()->each(fn($user) => ...);
```

### Raw Expression

```php
DB::table('users')->select(DB::raw('COUNT(*) as total'))->groupBy('status')->get();
```

### Advanced Join

```php
DB::table('users')->join('contacts', function ($join) {
  $join->on('users.id', '=', 'contacts.user_id')
       ->where('contacts.user_id', '>', 5);
});
```

### Subquery Join

```php
$sub = DB::table('posts')->select(...)->groupBy(...);
DB::table('users')->joinSub($sub, 'alias', fn($join) => ...);
```

### Lateral Join

```php
DB::table('users')->joinLateral($subQuery, 'alias')->get();
```

### Unions

```php
DB::table('users')->where(...)->union($other)->get();
```

### Điều kiện nâng cao

```php
->orWhere(fn($q) => $q->where(...)->where(...))
->whereNot(fn($q) => $q->orWhere(...))
->whereAny([...], 'like', 'text%')
->whereAll([...], 'like', '%text%')
->whereNone([...], 'like', '%badword%')
->when($cond, fn($q) => ..., fn($q) => ...)
```

---

