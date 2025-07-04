<x-mail::message>
    {{-- Header --}}
    <div style="background: #007bff; color: #fff; padding: 18px 0; border-radius: 8px 8px 0 0; text-align: center; font-size: 22px; font-weight: bold; letter-spacing: 1px;">
        HỒ SƠ ỨNG VIÊN MỚI
    </div>

    {{-- Thông tin ứng viên --}}
    <table style="width:100%; background: #f8fafd; border-radius: 0 0 8px 8px; margin-bottom: 24px; padding: 18px; border-collapse: separate; border-spacing: 0 8px;">
        <tr>
            <td style="font-weight:600; color:#333; width:120px;">Họ tên:</td>
            <td>{{ $candidate->name }}</td>
        </tr>
        <tr>
            <td style="font-weight:600; color:#333;">Email:</td>
            <td>{{ $candidate->email }}</td>
        </tr>
        <tr>
            <td style="font-weight:600; color:#333;">Ngày sinh:</td>
            <td>{{ $candidate->birthday }}</td>
        </tr>
        <tr>
            <td style="font-weight:600; color:#333;">Mô tả ngắn:</td>
            <td>{{ $candidate->bio }}</td>
        </tr>
        @isset($candidate->avatar_path)
        <tr>
            <td style="font-weight:600; color:#333;">Ảnh đại diện:</td>
            <td><a href="{{ asset('storage/' . $candidate->avatar_path) }}" style="color:#007bff; text-decoration:underline;" target="_blank">Xem ảnh</a></td>
        </tr>
        @endisset
    </table>

    {{-- Nút xem CV --}}
    <x-mail::button :url="asset('storage/' . $candidate->cv_path)" color="success">
        Xem CV Ứng Viên
    </x-mail::button>

    <div style="margin-top:32px; color:#555; font-size:15px; text-align:center;">
        Cảm ơn bạn đã sử dụng hệ thống tuyển dụng của chúng tôi!<br>
        <span style="font-size:18px;">🎉</span>
    </div>
</x-mail::message>