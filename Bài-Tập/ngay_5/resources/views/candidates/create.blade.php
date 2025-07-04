@if(session('success'))
@include('components.alert')
@endif
<style>
    .form-container {
        max-width: 500px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 16px rgba(0, 0, 0, 0.08);
        padding: 32px 28px;
    }

    .form-container label {
        font-weight: 600;
        margin-top: 16px;
        display: block;
        color: #333;
    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container input[type="date"],
    .form-container input[type="file"],
    .form-container textarea {
        width: 100%;
        padding: 10px 12px;
        margin-top: 6px;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-bottom: 10px;
        font-size: 15px;
        background: #f9f9f9;
    }

    .form-container textarea {
        min-height: 80px;
        resize: vertical;
    }

    .form-container button[type="submit"] {
        background: #007bff;
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 12px;
        transition: background 0.2s;
    }

    .form-container button[type="submit"]:hover {
        background: #0056b3;
    }

    .form-container .error {
        color: #e74c3c;
        font-size: 14px;
        margin-bottom: 8px;
    }
</style>
<div class="form-container">
    <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Họ tên</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror
        <label>Ngày sinh</label>
        <input type="date" name="birthday" value="{{ old('birthday') }}">
        @error('birthday') <div class="error">{{ $message }}</div> @enderror
        <label>Ảnh đại diện</label>
        <input type="file" name="avatar" accept="image/*">
        @error('avatar') <div class="error">{{ $message }}</div> @enderror
        <label>CV (PDF)</label>
        <input type="file" name="cv" accept="application/pdf">
        @error('cv') <div class="error">{{ $message }}</div> @enderror
        <label>Mô tả ngắn</label>
        <textarea name="bio">{{ old('bio') }}</textarea>
        @error('bio') <div class="error">{{ $message }}</div> @enderror
        <button type="submit">Gửi hồ sơ</button>
    </form>
</div>