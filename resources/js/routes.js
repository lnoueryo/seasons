import VueRouter from 'vue-router';
import Login from './pages/Login.vue';
import Home from './pages/Home.vue';
import Concept from './pages/Concept.vue';
import Menu from './pages/Menu.vue';
import Blog from './pages/Blog.vue';
import Booking from './pages/Booking.vue';
import Header from './globals/Header.vue';
import Header2 from './globals/Header2.vue';



const routes = [
    {
        path: '/',
        component: Login,
        name: 'login'
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
];

const router = new VueRouter({
    routes: routes,
    mode: 'history',
});

export default router;