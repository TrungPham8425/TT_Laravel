<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý bài viết') }}
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

                    <!-- Header với nút tạo bài viết mới -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Danh sách bài viết</h3>
                        <a href="{{ route('posts.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            Tạo bài viết mới
                        </a>
                    </div>

                    <!-- Danh sách bài viết -->
                    @if($posts->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Tiêu đề
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Trạng thái
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Tác giả
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Ngày tạo
                                    </th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                        Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{ $post->title }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        @if($post->status === 'published')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Đã xuất bản
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Bản nháp
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $post->user->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $post->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('posts.show', $post) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                Xem
                                            </a>

                                            @can('update', $post)
                                            <a href="{{ route('posts.edit', $post) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                Sửa
                                            </a>
                                            @endcan

                                            @can('delete', $post)
                                            <form action="{{ route('posts.destroy', $post) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900">
                                                    Xóa
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                    @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 text-lg">Chưa có bài viết nào.</p>
                        <a href="{{ route('posts.create') }}"
                            class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            Tạo bài viết đầu tiên
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>