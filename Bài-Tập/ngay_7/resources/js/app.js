import "./bootstrap";
import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./components/App.vue";

// Import các components
import Login from "./components/Login.vue";
import ProductList from "./components/ProductList.vue";
import ProductDetail from "./components/ProductDetail.vue";
import ProductForm from "./components/ProductForm.vue";

// Định nghĩa routes
const routes = [
    {
        path: "/",
        redirect: "/products",
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: { requiresGuest: true },
    },
    {
        path: "/products",
        name: "products",
        component: ProductList,
        meta: { requiresAuth: true },
    },
    {
        path: "/products/:id",
        name: "product-detail",
        component: ProductDetail,
        meta: { requiresAuth: true },
    },
    {
        path: "/products/create",
        name: "product-create",
        component: ProductForm,
        meta: { requiresAuth: true },
    },
    {
        path: "/products/:id/edit",
        name: "product-edit",
        component: ProductForm,
        meta: { requiresAuth: true },
    },
];

// Tạo router
const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Navigation guard để kiểm tra authentication
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("auth_token");

    if (to.meta.requiresAuth && !token) {
        next("/login");
    } else if (to.meta.requiresGuest && token) {
        next("/products");
    } else {
        next();
    }
});

// Tạo Vue app
const app = createApp(App);
app.use(router);
app.mount("#app");
