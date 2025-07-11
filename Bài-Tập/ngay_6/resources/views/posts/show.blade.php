<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chi tiết bài viết') }}
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

                    <!-- Thông tin bài viết -->
                    <div class="mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
                            <div class="flex space-x-2">
                                @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}"
                                    class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    Sửa bài viết
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
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Xóa bài viết
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>

                        <!-- Meta information -->
                        <div class="flex items-center space-x-4 text-sm text-gray-600 mb-6">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Tác giả: {{ $post->user->name }}</span>
                            </div>

                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Ngày tạo: {{ $post->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                            <div class="flex items-center">
                                @if($post->status === 'published')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Đã xuất bản
                                </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Bản nháp
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Nội dung bài viết -->
                        <div class="prose max-w-none">
                            <div class="bg-gray-50 p-6 rounded-lg">
                                {!! nl2br(e($post->content)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Nút quay lại -->
                    <div class="mt-6">
                        <a href="{{ route('posts.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>