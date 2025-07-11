<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý người dùng') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Flash Messages -->
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                    @endif

                    <!-- Header -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Danh sách người dùng</h3>
                    </div>

                    <!-- Danh sách người dùng -->
                    @if($users->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Tên
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Vai trò
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Số bài viết
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Ngày tham gia
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $user->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        @if($user->role === 'admin')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Admin
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            User
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $user->posts_count }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $user->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <!-- Form thay đổi role -->
                                            <form action="{{ route('admin.users.change-role', $user) }}"
                                                method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role"
                                                    onchange="this.form.submit()"
                                                    class="text-xs border border-gray-300 rounded px-2 py-1">
                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                                        User
                                                    </option>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                </select>
                                            </form>

                                            <!-- Nút xóa user -->
                                            @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.delete', $user) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 text-xs">
                                                    Xóa
                                                </button>
                                            </form>
                                            @else
                                            <span class="text-gray-400 text-xs">Bạn</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                    @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 text-lg">Chưa có người dùng nào.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>