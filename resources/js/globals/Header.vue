<template>
    <div v-resize="onResize">
        <div class="video-container" style="position: relative;" :style="{'height': windowSize.y + 'px'}">
            <transition-group name="fade" mode="out-in">
                <video ref="video" :src="video" v-for="(video,i) in videos" :key="i" autoplay loop v-show="videoIndex==i" muted @load="ready==true"></video>
            </transition-group>
            <div class="overlay"></div>
            <div class="mouten"></div>
            <nav class="d-flex" style="position: relative;align-items: center;justify-content: space-between;z-index: 2;padding: 25px;" v-show="ready">
                <div style="margin: auto">
                    <router-link to="/">
                        <v-img class="hover" style="max-width: 280px" src="images/logo.png"></v-img>
                    </router-link>
                </div>
                <div class="d-flex" style="max-width: 1100px;width: 100%;margin-left: auto;padding:30px;justify-content: space-between">
                    <div v-for="(item, i) in filteredItems" :key="i">
                        <router-link :to="item.route" class="white--text font hover" exact-active-class="active" style="text-decoration: none;"><span>{{ item.page }}</span></router-link>
                    </div>
                    <div class="logout white--text font hover" v-if="this.$store.getters.isAuth" @click="logout">LOGOUT</div>
                </div>
            </nav>
            <div style="margin: auto;position: absolute;bottom: 4.5vw;left: 10vw;">
                <v-img src="images/logo3.png" style="max-width: 720px;position: relative;z-index: 1;margin: auto"></v-img>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            videoIndex: 0,
            videos: ['videos/01.mp4', 'videos/02.mp4', 'videos/03.mp4', 'videos/04.mp4'],
            mainVisual: 'images/headermain.png',
            items: [
                {page: 'TOP', route: '/'},
                {page: 'CONCEPT', route: '/concept'},
                {page: 'MENU', route: '/menu'},
                {page: 'BLOG', route: '/blog'},
                {page: 'ACCESS', route: '/access'},
                {page: 'BOOKING', route: '/booking'},
                {page: 'LOGIN', route: '/login'},
                {page: 'REGISTER', route: '/register'},
            ],
            windowSize: {
                x: 0,
                y: 0,
            },
            ready: false,
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
    mounted(){
        this.onResize();
        let that = this;
        setInterval(that.changeVideo,4000)
    },
    methods: {
        logout(){
            axios.post('/logout').then(response => {
                this.$store.dispatch('logout');
            })
        },
        onResize () {
            this.windowSize = { x: window.innerWidth, y: window.innerHeight }
            console.log(this.windowSize)
        },
        changeVideo(){
            this.videoIndex+=1;
            if(this.videoIndex == this.videos.length){
                this.videoIndex = 0
            }
        }
    }
}
</script>
<style scoped>

        .fade-enter-active, .fade-leave-active {
            will-change: opacity;
            transition: opacity 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
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
    video {
    -o-object-fit: cover;
        object-fit: cover;
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    }
    .video-container {
        position: relative;
        overflow: hidden;
    }
    .overlay{
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background-color: black;
        opacity: 0.6;
    }
    .mouten{
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: url("/../images/01.png");
        background-repeat: repeat;
        z-index: 1;
    }
    .font{
        letter-spacing: 0.01em;
        font-family: 'Roboto Condensed', sans-serif!important;
    }
@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap');
</style>