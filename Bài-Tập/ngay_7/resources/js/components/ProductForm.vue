<template>
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <router-link
                    to="/products"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4"
                >
                    <svg
                        class="w-5 h-5 mr-2"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                    Quay lại danh sách
                </router-link>
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ isEditing ? "Chỉnh sửa sản phẩm" : "Thêm sản phẩm mới" }}
                </h1>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <form @submit.prevent="handleSubmit">
                    <!-- Product Name -->
                    <div class="mb-6">
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Tên sản phẩm <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': errors.name }"
                            placeholder="Nhập tên sản phẩm"
                        />
                        <p v-if="errors.name" class="mt-1 text-sm text-red-600">
                            {{ errors.name }}
                        </p>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-6">
                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Mô tả
                        </label>
                        <textarea
                            id="description"
                            v-model="form.description"
                            rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': errors.description }"
                            placeholder="Nhập mô tả sản phẩm (tùy chọn)"
                        ></textarea>
                        <p
                            v-if="errors.description"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ errors.description }}
                        </p>
                    </div>

                    <!-- Product Price -->
                    <div class="mb-6">
                        <label
                            for="price"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Giá <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500"
                            >
                                ₫
                            </span>
                            <input
                                id="price"
                                v-model="form.price"
                                type="number"
                                step="0.01"
                                min="0"
                                required
                                class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                :class="{ 'border-red-500': errors.price }"
                                placeholder="0.00"
                            />
                        </div>
                        <p
                            v-if="errors.price"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ errors.price }}
                        </p>
                    </div>

                    <!-- Product Image URL -->
                    <div class="mb-6">
                        <label
                            for="image_url"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            URL hình ảnh
                        </label>
                        <input
                            id="image_url"
                            v-model="form.image_url"
                            type="url"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            :class="{ 'border-red-500': errors.image_url }"
                            placeholder="https://example.com/image.jpg"
                        />
                        <p
                            v-if="errors.image_url"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ errors.image_url }}
                        </p>

                        <!-- Image Preview -->
                        <div v-if="form.image_url" class="mt-4">
                            <label
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Xem trước hình ảnh:</label
                            >
                            <div
                                class="w-32 h-32 bg-gray-200 rounded-lg overflow-hidden"
                            >
                                <img
                                    :src="form.image_url"
                                    :alt="form.name"
                                    class="w-full h-full object-cover"
                                    @error="handleImageError"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- File Upload (Optional) -->
                    <div class="mb-6">
                        <label
                            for="image_file"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Tải lên hình ảnh (tùy chọn)
                        </label>
                        <input
                            id="image_file"
                            type="file"
                            accept="image/*"
                            @change="handleFileUpload"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                        <p class="mt-1 text-sm text-gray-500">
                            Hỗ trợ: JPG, PNG, GIF. Kích thước tối đa: 2MB
                        </p>
                    </div>

                    <!-- Error Message -->
                    <div
                        v-if="error"
                        class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
                    >
                        {{ error }}
                    </div>

                    <!-- Success Message -->
                    <div
                        v-if="success"
                        class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
                    >
                        {{ success }}
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <router-link
                            to="/products"
                            class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            Hủy
                        </router-link>
                        <button
                            type="submit"
                            :disabled="loading"
                            class="px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                        >
                            <span
                                v-if="loading"
                                class="inline-flex items-center"
                            >
                                <svg
                                    class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    ></circle>
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    ></path>
                                </svg>
                                {{
                                    isEditing
                                        ? "Đang cập nhật..."
                                        : "Đang tạo..."
                                }}
                            </span>
                            <span v-else>
                                {{
                                    isEditing
                                        ? "Cập nhật sản phẩm"
                                        : "Tạo sản phẩm"
                                }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";

export default {
    name: "ProductForm",
    setup() {
        const route = useRoute();
        const router = useRouter();
        const loading = ref(false);
        const error = ref("");
        const success = ref("");
        const errors = ref({});

        // Form data
        const form = reactive({
            name: "",
            description: "",
            price: "",
            image_url: "",
        });

        // Kiểm tra có phải đang edit không
        const isEditing = computed(() => {
            return route.params.id !== undefined;
        });

        // Lấy thông tin sản phẩm để edit
        const fetchProduct = async () => {
            if (!isEditing.value) return;

            loading.value = true;
            error.value = "";

            try {
                const response = await axios.get(
                    `/api/products/${route.params.id}`,
                    {
                        withCredentials: true,
                    }
                );

                if (response.data.success) {
                    const product = response.data.data;
                    Object.assign(form, {
                        name: product.name,
                        description: product.description || "",
                        price: product.price,
                        image_url: product.image_url || "",
                    });
                }
            } catch (err) {
                if (err.response?.data?.message) {
                    error.value = err.response.data.message;
                } else {
                    error.value = "Có lỗi xảy ra khi tải thông tin sản phẩm";
                }
            } finally {
                loading.value = false;
            }
        };

        // Xử lý submit form
        const handleSubmit = async () => {
            loading.value = true;
            error.value = "";
            success.value = "";
            errors.value = {};

            try {
                // Validate form
                if (!form.name.trim()) {
                    errors.value.name = "Tên sản phẩm là bắt buộc";
                    return;
                }

                if (!form.price || parseFloat(form.price) < 0) {
                    errors.value.price = "Giá phải lớn hơn hoặc bằng 0";
                    return;
                }

                let response;
                if (isEditing.value) {
                    // Update product
                    response = await axios.put(
                        `/api/products/${route.params.id}`,
                        form,
                        {
                            withCredentials: true,
                        }
                    );
                } else {
                    // Create product
                    response = await axios.post("/api/products", form, {
                        withCredentials: true,
                    });
                }

                if (response.data.success) {
                    success.value = isEditing.value
                        ? "Cập nhật sản phẩm thành công!"
                        : "Tạo sản phẩm thành công!";

                    // Redirect sau 1 giây
                    setTimeout(() => {
                        router.push("/products");
                    }, 1000);
                }
            } catch (err) {
                if (err.response?.data?.errors) {
                    errors.value = err.response.data.errors;
                } else if (err.response?.data?.message) {
                    error.value = err.response.data.message;
                } else {
                    error.value = "Có lỗi xảy ra khi lưu sản phẩm";
                }
            } finally {
                loading.value = false;
            }
        };

        // Xử lý upload file
        const handleFileUpload = (event) => {
            const file = event.target.files[0];
            if (!file) return;

            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert("File quá lớn. Kích thước tối đa là 2MB.");
                return;
            }

            // Validate file type
            if (!file.type.startsWith("image/")) {
                alert("Chỉ chấp nhận file hình ảnh.");
                return;
            }

            // Convert to base64 (for demo purposes)
            const reader = new FileReader();
            reader.onload = (e) => {
                form.image_url = e.target.result;
            };
            reader.readAsDataURL(file);
        };

        // Xử lý lỗi hình ảnh
        const handleImageError = () => {
            form.image_url = "";
            alert("Không thể tải hình ảnh. Vui lòng kiểm tra lại URL.");
        };

        onMounted(() => {
            fetchProduct();
        });

        return {
            form,
            loading,
            error,
            success,
            errors,
            isEditing,
            handleSubmit,
            handleFileUpload,
            handleImageError,
        };
    },
};
</script>
