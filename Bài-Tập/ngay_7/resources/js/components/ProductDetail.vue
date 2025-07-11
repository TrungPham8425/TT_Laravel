<template>
    <div class="container mx-auto px-4">
        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center py-12">
            <div
                class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"
            ></div>
        </div>

        <!-- Error State -->
        <div
            v-else-if="error"
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6"
        >
            {{ error }}
        </div>

        <!-- Product Detail -->
        <div v-else-if="product" class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <router-link
                    to="/products"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800"
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
            </div>

            <!-- Product Content -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="md:flex">
                    <!-- Product Image -->
                    <div class="md:w-1/2">
                        <div
                            class="h-96 md:h-full bg-gray-200 flex items-center justify-center"
                        >
                            <img
                                v-if="product.image_url"
                                :src="product.image_url"
                                :alt="product.name"
                                class="w-full h-full object-cover"
                            />
                            <div v-else class="text-gray-500 text-center">
                                <svg
                                    class="w-24 h-24 mx-auto mb-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <p class="text-lg">Không có hình ảnh</p>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="md:w-1/2 p-8">
                        <div class="mb-6">
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                                {{ product.name }}
                            </h1>

                            <div class="mb-6">
                                <span class="text-3xl font-bold text-blue-600">
                                    {{ formatPrice(product.price) }}
                                </span>
                            </div>

                            <div class="mb-6">
                                <h3
                                    class="text-lg font-semibold text-gray-900 mb-2"
                                >
                                    Mô tả
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{
                                        product.description ||
                                        "Không có mô tả cho sản phẩm này."
                                    }}
                                </p>
                            </div>

                            <div class="mb-6">
                                <h3
                                    class="text-lg font-semibold text-gray-900 mb-2"
                                >
                                    Thông tin sản phẩm
                                </h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">ID:</span>
                                        <span class="font-medium">{{
                                            product.id
                                        }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600"
                                            >Ngày tạo:</span
                                        >
                                        <span class="font-medium">{{
                                            formatDate(product.created_at)
                                        }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600"
                                            >Cập nhật lần cuối:</span
                                        >
                                        <span class="font-medium">{{
                                            formatDate(product.updated_at)
                                        }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4">
                            <router-link
                                :to="`/products/${product.id}/edit`"
                                class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-center transition-colors duration-200"
                            >
                                <svg
                                    class="w-5 h-5 inline mr-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                    />
                                </svg>
                                Chỉnh sửa
                            </router-link>

                            <button
                                @click="deleteProduct"
                                class="flex-1 bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200"
                            >
                                <svg
                                    class="w-5 h-5 inline mr-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    />
                                </svg>
                                Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Not Found State -->
        <div v-else class="text-center py-12">
            <svg
                class="w-16 h-16 mx-auto text-gray-400 mb-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">
                Không tìm thấy sản phẩm
            </h3>
            <p class="text-gray-500 mb-4">
                Sản phẩm bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.
            </p>
            <router-link
                to="/products"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Quay lại danh sách
            </router-link>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";

export default {
    name: "ProductDetail",
    setup() {
        const route = useRoute();
        const router = useRouter();
        const product = ref(null);
        const loading = ref(false);
        const error = ref("");

        // Lấy thông tin chi tiết sản phẩm
        const fetchProduct = async () => {
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
                    product.value = response.data.data;
                }
            } catch (err) {
                if (err.response?.status === 404) {
                    error.value = "Không tìm thấy sản phẩm";
                } else if (err.response?.data?.message) {
                    error.value = err.response.data.message;
                } else {
                    error.value = "Có lỗi xảy ra khi tải thông tin sản phẩm";
                }
            } finally {
                loading.value = false;
            }
        };

        // Xóa sản phẩm
        const deleteProduct = async () => {
            if (!confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                return;
            }

            try {
                const response = await axios.delete(
                    `/api/products/${route.params.id}`,
                    {
                        withCredentials: true,
                    }
                );

                if (response.data.success) {
                    alert("Xóa sản phẩm thành công!");
                    router.push("/products");
                }
            } catch (err) {
                if (err.response?.data?.message) {
                    alert(err.response.data.message);
                } else {
                    alert("Có lỗi xảy ra khi xóa sản phẩm");
                }
            }
        };

        // Format giá tiền
        const formatPrice = (price) => {
            return new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format(price);
        };

        // Format ngày tháng
        const formatDate = (dateString) => {
            if (!dateString) return "N/A";
            return new Date(dateString).toLocaleDateString("vi-VN", {
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit",
            });
        };

        onMounted(() => {
            fetchProduct();
        });

        return {
            product,
            loading,
            error,
            fetchProduct,
            deleteProduct,
            formatPrice,
            formatDate,
        };
    },
};
</script>
