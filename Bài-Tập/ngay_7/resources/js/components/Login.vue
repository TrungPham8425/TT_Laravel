<template>
    <div
        class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8"
    >
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2
                    class="mt-6 text-center text-3xl font-extrabold text-gray-900"
                >
                    Đăng nhập vào hệ thống
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Quản lý sản phẩm của bạn
                </p>
            </div>

            <form class="mt-8 space-y-6" @submit.prevent="handleLogin">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input
                            id="email"
                            v-model="form.email"
                            name="email"
                            type="email"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            placeholder="Email address"
                        />
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input
                            id="password"
                            v-model="form.password"
                            name="password"
                            type="password"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            placeholder="Password"
                        />
                    </div>
                </div>

                <!-- Error Message -->
                <div
                    v-if="error"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
                >
                    {{ error }}
                </div>

                <!-- Success Message -->
                <div
                    v-if="success"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
                >
                    {{ success }}
                </div>

                <div>
                    <button
                        type="submit"
                        :disabled="loading"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50"
                    >
                        <span
                            v-if="loading"
                            class="absolute left-0 inset-y-0 flex items-center pl-3"
                        >
                            <!-- Loading spinner -->
                            <svg
                                class="animate-spin h-5 w-5 text-white"
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
                        </span>
                        {{ loading ? "Đang đăng nhập..." : "Đăng nhập" }}
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Chưa có tài khoản?
                        <button
                            type="button"
                            @click="showRegister = !showRegister"
                            class="font-medium text-blue-600 hover:text-blue-500"
                        >
                            {{ showRegister ? "Đăng nhập" : "Đăng ký" }}
                        </button>
                    </p>
                </div>
            </form>

            <!-- Register Form -->
            <form
                v-if="showRegister"
                class="mt-8 space-y-6"
                @submit.prevent="handleRegister"
            >
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="reg-name" class="sr-only">Name</label>
                        <input
                            id="reg-name"
                            v-model="registerForm.name"
                            name="name"
                            type="text"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            placeholder="Full name"
                        />
                    </div>
                    <div>
                        <label for="reg-email" class="sr-only">Email</label>
                        <input
                            id="reg-email"
                            v-model="registerForm.email"
                            name="email"
                            type="email"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            placeholder="Email address"
                        />
                    </div>
                    <div>
                        <label for="reg-password" class="sr-only"
                            >Password</label
                        >
                        <input
                            id="reg-password"
                            v-model="registerForm.password"
                            name="password"
                            type="password"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            placeholder="Password"
                        />
                    </div>
                    <div>
                        <label for="reg-password-confirm" class="sr-only"
                            >Confirm Password</label
                        >
                        <input
                            id="reg-password-confirm"
                            v-model="registerForm.password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            placeholder="Confirm password"
                        />
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        :disabled="registerLoading"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50"
                    >
                        {{ registerLoading ? "Đang đăng ký..." : "Đăng ký" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

export default {
    name: "Login",
    setup() {
        const router = useRouter();
        const loading = ref(false);
        const registerLoading = ref(false);
        const error = ref("");
        const success = ref("");
        const showRegister = ref(false);

        // Form data cho login
        const form = reactive({
            email: "",
            password: "",
        });

        // Form data cho register
        const registerForm = reactive({
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
        });

        // Xử lý đăng nhập
        const handleLogin = async () => {
            loading.value = true;
            error.value = "";
            success.value = "";

            try {
                // Lấy CSRF token trước
                await axios.get("/sanctum/csrf-cookie", {
                    withCredentials: true,
                });

                const response = await axios.post("/api/login", form, {
                    withCredentials: true,
                });

                if (response.data.success) {
                    // Lưu token vào localStorage
                    localStorage.setItem(
                        "auth_token",
                        response.data.data.token
                    );

                    // Cấu hình axios headers
                    axios.defaults.headers.common[
                        "Authorization"
                    ] = `Bearer ${response.data.data.token}`;

                    success.value = "Đăng nhập thành công!";

                    // Redirect sau 1 giây
                    setTimeout(() => {
                        router.push("/products");
                    }, 1000);
                }
            } catch (err) {
                if (err.response?.data?.message) {
                    error.value = err.response.data.message;
                } else {
                    error.value = "Có lỗi xảy ra khi đăng nhập";
                }
            } finally {
                loading.value = false;
            }
        };

        // Xử lý đăng ký
        const handleRegister = async () => {
            registerLoading.value = true;
            error.value = "";
            success.value = "";

            try {
                // Lấy CSRF token trước
                await axios.get("/sanctum/csrf-cookie", {
                    withCredentials: true,
                });

                const response = await axios.post(
                    "/api/register",
                    registerForm,
                    {
                        withCredentials: true,
                    }
                );

                if (response.data.success) {
                    // Lưu token vào localStorage
                    localStorage.setItem(
                        "auth_token",
                        response.data.data.token
                    );

                    // Cấu hình axios headers
                    axios.defaults.headers.common[
                        "Authorization"
                    ] = `Bearer ${response.data.data.token}`;

                    success.value = "Đăng ký thành công!";

                    // Reset form
                    Object.assign(registerForm, {
                        name: "",
                        email: "",
                        password: "",
                        password_confirmation: "",
                    });

                    // Redirect sau 1 giây
                    setTimeout(() => {
                        router.push("/products");
                    }, 1000);
                }
            } catch (err) {
                if (err.response?.data?.message) {
                    error.value = err.response.data.message;
                } else if (err.response?.data?.errors) {
                    // Hiển thị validation errors
                    const errors = err.response.data.errors;
                    error.value = Object.values(errors).flat().join(", ");
                } else {
                    error.value = "Có lỗi xảy ra khi đăng ký";
                }
            } finally {
                registerLoading.value = false;
            }
        };

        return {
            form,
            registerForm,
            loading,
            registerLoading,
            error,
            success,
            showRegister,
            handleLogin,
            handleRegister,
        };
    },
};
</script>
