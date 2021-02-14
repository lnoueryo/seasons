<template>
    <div>
        <v-img src="/images/headermain.png"></v-img>
        <nav>
            <div class="d-flex justify-content-around" style="font-weight: bold; border: solid 3px; border-color: #ebdedaa3; background-color: #e9967a87;padding:20px">
                <div v-for="(item, i) in filteredItems" :key="i">
                    <router-link :to="item.route" exact-active-class="active">{{ item.page }}</router-link>
                </div>
                <div class="logout" v-if="this.$store.getters.isAuth" @click="logout">ログアウト</div>
            </div>
        </nav>
    </div>
</template>
<script>
export default {
    data() {
        return {
            items: [
                {page: 'トップ', route: '/home'},
                {page: 'コンセプト', route: '/concept'},
                {page: 'メニュー', route: '/menu'},
                {page: 'ブログ', route: '/blog'},
                {page: 'アクセス', route: '/access'},
                {page: 'Web予約', route: '/booking'},
                {page: 'ログイン', route: '/'},
                {page: '会員登録', route: '/register'},
            ]
        }
    },
    computed: {
        filteredItems(){
            const isAuth = this.$store.getters.isAuth;
            return isAuth ? this.items.filter((item, index)=>{
                return index < 6;
            }) : this.items
        }
    },
    methods: {
        logout(){
            axios.post('/logout').then(response => {
                this.$store.dispatch('logout');
            })
        },
    }
}
</script>
<style scoped>
    .active{
        color: rgb(255, 61, 61)!important;
        /* background-color: black; */
    }
    .fade-enter-active, .fade-leave-active {
        will-change: opacity;
        transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
    .logout{
        color: #1976d2;
    }
    .logout:hover{
        cursor: pointer;
        text-decoration: underline;
    }
</style>