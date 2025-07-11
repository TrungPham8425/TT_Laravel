<template>
    <div id="app" class="min-h-screen bg-gray-100">
        <!-- Navigation Header -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-gray-800">
                            Product Management System
                        </h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <router-link
                            v-if="isAuthenticated"
                            to="/products"
                            class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                        >
                            Products
                        </router-link>

                        <router-link
                            v-if="isAuthenticated"
                            to="/products/create"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Add Product
                        </router-link>

                        <button
                            v-if="isAuthenticated"
                            @click="logout"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

export default {
    name: "App",
    setup() {
        const router = useRouter();
        const isAuthenticated = ref(false);

        // Kiểm tra authentication status
        const checkAuth = () => {
            const token = localStorage.getItem("auth_token");
            isAuthenticated.value = !!token;

            // Cấu hình axios headers nếu có token
            if (token) {
                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token}`;
            }
        };

        // Logout function
        const logout = async () => {
            try {
                await axios.post(
                    "/api/logout",
                    {},
                    {
                        withCredentials: true,
                    }
                );
            } catch (error) {
                console.error("Logout error:", error);
            } finally {
                // Xóa token và redirect về login
                localStorage.removeItem("auth_token");
                axios.defaults.headers.common["Authorization"] = "";
                isAuthenticated.value = false;
                router.push("/login");
            }
        };

        onMounted(() => {
            checkAuth();
        });

        return {
            isAuthenticated,
            logout,
        };
    },
};
</script>

<style>
/* Global styles */
body {
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto",
        "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans",
        "Helvetica Neue", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
}
</style>
