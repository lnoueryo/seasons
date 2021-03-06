import store from './store'
import VueRouter from 'vue-router';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import Home from './pages/Home.vue';
import Concept from './pages/Concept.vue';
import Menu from './pages/Menu.vue';
import Blog from './pages/Blog.vue';
import Booking from './pages/Booking.vue';
import Access from './pages/Access.vue';
import Header from './globals/Header.vue';
import Header2 from './globals/Header2.vue';



const routes = [
    {
        path: '/',
        component: Login,
        name: 'login'
    },
    {
        path: '/register',
        component: Register,
        name: 'register'
    },
    {
        path: '/booking',
        components: {
            default: Booking,
            header: Header2
        },
        name: 'booking'
    },
    {
        path: '/home',
        components: {
            default: Home,
            header: Header
        },
        name: 'home'
    },
    {
        path: '/concept',
        components: {
            default: Concept,
            header: Header
        },
        name: 'concept'
    },
    {
        path: '/menu',
        components: {
            default: Menu,
            header: Header
        },
        name: 'menu'
    },
    {
        path: '/blog',
        components: {
            default: Blog,
            header: Header
        },
        name: 'blog'
    },
    {
        path: '/access',
        components: {
            default: Access,
            header: Header
        },
        name: 'access'
    },
];

const router = new VueRouter({
    routes: routes,
    mode: 'history',
});

export default router;

// router.beforeEach((to, from, next) => {
//     const isAuth = store.getters.isAuth;
//     // const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  
//     if (isAuth) {
//       // 認証状態はそのまま遷移
//       next();
//     } else if (requiresAuth) {
//       // 認証してないのでログイン画面へ
//       next({
//         path: "/login",
//         query: { redirect: to.fullPath }
//       });
//     } else {
//       // 認証が必要ないのでそのまま遷移
//       next();
//     }
//   });