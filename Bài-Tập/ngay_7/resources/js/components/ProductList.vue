<template>
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Danh sách sản phẩm</h1>
            <router-link
                to="/products/create"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Thêm sản phẩm mới
            </router-link>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Tìm kiếm theo tên sản phẩm..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        @input="handleSearch"
                    />
                </div>
                <div class="flex gap-2">
                    <select
                        v-model="priceFilter"
                        @change="handleFilter"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">Tất cả giá</option>
                        <option value="0-100">Dưới 100k</option>
                        <option value="100-500">100k - 500k</option>
                        <option value="500-1000">500k - 1M</option>
                        <option value="1000+">Trên 1M</option>
                    </select>
                    <button
                        @click="clearFilters"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded-md"
                    >
                        Xóa bộ lọc
                    </button>
                </div>
            </div>
        </div>

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

        <!-- Products Grid -->
        <div
            v-else-if="filteredProducts.length > 0"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
        >
            <div
                v-for="product in filteredProducts"
                :key="product.id"
                class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300"
            >
                <!-- Product Image -->
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <img
                        v-if="product.image_url"
                        :src="product.image_url"
                        :alt="product.name"
                        class="w-full h-full object-cover"
                    />
                    <div v-else class="text-gray-500 text-center">
                        <svg
                            class="w-16 h-16 mx-auto mb-2"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <p>Không có hình ảnh</p>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        {{ product.name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                        {{ product.description || "Không có mô tả" }}
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-blue-600">
                            {{ formatPrice(product.price) }}
                        </span>
                        <div class="flex space-x-2">
                            <router-link
                                :to="`/products/${product.id}`"
                                class="text-blue-500 hover:text-blue-700 text-sm font-medium"
                            >
                                Chi tiết
                            </router-link>
                            <router-link
                                :to="`/products/${product.id}/edit`"
                                class="text-green-500 hover:text-green-700 text-sm font-medium"
                            >
                                Sửa
                            </router-link>
                            <button
                                @click="deleteProduct(product.id)"
                                class="text-red-500 hover:text-red-700 text-sm font-medium"
                            >
                                Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
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
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">
                Không có sản phẩm nào
            </h3>
            <p class="text-gray-500 mb-4">
                {{
                    searchQuery || priceFilter
                        ? "Không tìm thấy sản phẩm phù hợp với bộ lọc."
                        : "Bắt đầu thêm sản phẩm đầu tiên của bạn."
                }}
            </p>
            <router-link
                to="/products/create"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Thêm sản phẩm
            </router-link>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted } from "vue";
import axios from "axios";

export default {
    name: "ProductList",
    setup() {
        const products = ref([]);
        const loading = ref(false);
        const error = ref("");
        const searchQuery = ref("");
        const priceFilter = ref("");

        // Lấy danh sách sản phẩm từ API
        const fetchProducts = async () => {
            loading.value = true;
            error.value = "";

            try {
                const response = await axios.get("/api/products", {
                    withCredentials: true,
                });

                if (response.data.success) {
                    products.value = response.data.data;
                }
            } catch (err) {
                if (err.response?.data?.message) {
                    error.value = err.response.data.message;
                } else {
                    error.value = "Có lỗi xảy ra khi tải danh sách sản phẩm";
                }
            } finally {
                loading.value = false;
            }
        };

        // Xóa sản phẩm
        const deleteProduct = async (productId) => {
            if (!confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                return;
            }

            try {
                const response = await axios.delete(
                    `/api/products/${productId}`,
                    {
                        withCredentials: true,
                    }
                );

                if (response.data.success) {
                    // Xóa sản phẩm khỏi danh sách
                    products.value = products.value.filter(
                        (p) => p.id !== productId
                    );
                }
            } catch (err) {
                if (err.response?.data?.message) {
                    alert(err.response.data.message);
                } else {
                    alert("Có lỗi xảy ra khi xóa sản phẩm");
                }
            }
        };

        // Tìm kiếm sản phẩm
        const handleSearch = () => {
            // Debounce search
            clearTimeout(searchQuery.timeout);
            searchQuery.timeout = setTimeout(() => {
                // Search logic sẽ được xử lý trong computed
            }, 300);
        };

        // Lọc theo giá
        const handleFilter = () => {
            // Filter logic sẽ được xử lý trong computed
        };

        // Xóa bộ lọc
        const clearFilters = () => {
            searchQuery.value = "";
            priceFilter.value = "";
        };

        // Format giá tiền
        const formatPrice = (price) => {
            return new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format(price);
        };

        // Computed: Lọc sản phẩm theo search và filter
        const filteredProducts = computed(() => {
            let filtered = products.value;

            // Lọc theo tìm kiếm
            if (searchQuery.value) {
                filtered = filtered.filter((product) =>
                    product.name
                        .toLowerCase()
                        .includes(searchQuery.value.toLowerCase())
                );
            }

            // Lọc theo giá
            if (priceFilter.value) {
                filtered = filtered.filter((product) => {
                    const price = parseFloat(product.price);
                    switch (priceFilter.value) {
                        case "0-100":
                            return price < 100000;
                        case "100-500":
                            return price >= 100000 && price < 500000;
                        case "500-1000":
                            return price >= 500000 && price < 1000000;
                        case "1000+":
                            return price >= 1000000;
                        default:
                            return true;
                    }
                });
            }

            return filtered;
        });

        onMounted(() => {
            fetchProducts();
        });

        return {
            products,
            loading,
            error,
            searchQuery,
            priceFilter,
            filteredProducts,
            fetchProducts,
            deleteProduct,
            handleSearch,
            handleFilter,
            clearFilters,
            formatPrice,
        };
    },
};
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
