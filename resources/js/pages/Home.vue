<template>
    <div>
    <section id="section1">
        <div class="wrapper">
            <div class="content-container d-flex">
                <h2 style="width: 10%;padding: 15px 0">BLOG</h2>
                <div style="width: 80%">
                    <div class="mb-4" v-for="(blog, i) in blogs" :key="i">
                        <router-link :to="{name: 'blog', params: {bid: blog.id}}" class="hover d-flex" style="justify-content: space-between;padding: 15px 0;text-decoration: none">
                            <div>
                                <div class="blog">
                                    <span class="date">{{ blog.date }}</span>
                                    <span>{{ blog.title }}</span>
                                </div>
                            </div>
                            <div>
                                <v-icon>mdi-arrow-right</v-icon>
                            </div>
                        </router-link>
                        <div>
                            <hr class="hr">
                        </div>
                    </div>
                    <div>
                        <router-link :to="{name: 'blog'}" class="hover" style="padding: 15px 0;text-decoration: none">
                            <span class="date blog">more</span>
                        </router-link>
                    </div>
                </div>
                <div style="width: 10%"></div>
            </div>
        </div>
    </section>
    <section id="section2">
        <div class="wrapper">
            <div class="content-container d-flex align-items-center rel">
                <div style="position: relative;width: 87.5%;z-index:1">
                    <img style="width: 100%;height: auto;padding: 50px 0;" src="images/index01.jpg">
                    <div style="position: absolute;padding: 50px 0;z-index:2;top: 50px;bottom: 55px;left: 0;right: 0;"><div style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;background-color: white;opacity: 0.175;"></div></div>
                </div>
                <div class="bg"></div>
            </div>
        </div>
    </section>
    <section id="section3">
        <div class="wrapper">
            <v-img src="images/inside2.jpg" style="filter: sepia(0.2)">
                <div class="d-flex" style="justify-content: flex-end;padding: 40px;align-items: center;height:100%;">
                    <div style="margin-right: 15px">
                        <div class="blog">
                            <h2 style="padding: 15px 0">SALON</h2>
                        </div>
                        <div class="blog">
                            <span class="date"></span>
                        </div>
                        <div class="blog">
                            <span class="date"></span>
                        </div>
                        <div class="blog">
                            <span class="date"></span>
                        </div>
                    </div>
                    <div>
                        <div class="blog">
                            <span class="date">福岡市中央区六本松4-9-7ジャパンパル101</span>
                        </div>
                        <div class="blog">
                            <span class="date">OPEN　9:00 - 19:00</span>
                        </div>
                        <div class="blog">
                            <span class="date">CLOSE　毎週月曜日</span>
                        </div>
                        <div class="blog">
                            <span class="date">TEL 092-775-1821</span>
                        </div>
                    </div>
                </div>
            </v-img>
        </div>
    </section>
    <section id="section4">
        <div class="wrapper">
            <draggable-carousel></draggable-carousel>
        </div>
    </section>
    <section id="section5">
        <div class="wrapper">
            <div class="content-container d-flex" style=" justify-content: center;padding: 30px">
                <div>
                    <div style="margin-bottom:30px">
                        <v-img style="max-width: 280px;margin: auto;" src="images/logo.png"></v-img>
                    </div>
                    <div class="d-flex" style="justify-content: space-around;">
                        <button class="insta_btn hover">
                            <v-icon color="white">mdi-instagram</v-icon>　Follow Me
                        </button>
                        <button class="fb_btn hover">
                            <v-icon color="white">mdi-facebook</v-icon>　Follow Me
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</template>
<script>
import DraggableCarousel from "../ui-components/DraggableCarousel";
export default {
    components: {
        DraggableCarousel
    },
    data() {
        return {
            duration: 0,
            styleIndex: 0,
            startX: 0,
            isMouse: false,
            disabled: false,
            blogs: [
                {id: 1, title: 'やっぱり夏はショート', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'},
                {id: 2, title: 'やっぱり夏はショート', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'},
                {id: 3, title: 'やっぱり夏はショート', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'}
            ],
            styles: [
                {id: 1, title: 'やっぱり', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'},
                {id: 2, title: '夏は', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'},
                {id: 3, title: 'ショート', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'},
                {id: 4, title: 'ですか', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'},
                {id: 5, title: '？', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'},
                {id: 6, title: 'やっぱり夏はショート', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'},
                {id: 7, title: 'やっぱり夏はショート', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'},
                {id: 8, title: 'やっぱり夏はショート', date: '2021.01.07', src: 'images/blog01.jpg',description: '今日来て下さったH様もショートボブにうちでカットするようになってからずっと気に入って来て下さってます。いつも本当に有難う御座いますm(_ _)m<br>今日は大学の休み前なのでという事でサッパりカットさせて頂くことに(￣^￣)ゞ仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてショートでも女性らしさをしっかり演出出来るようにしてます(｀_´)ゞ気にいってもらえたようなので安心ですが、いつでも何か気になる部分があったらご相談下さいねでは、ここまで読んで頂いてありがとうございました！'}
            ],
        }
    },
    methods: {
        changeCalendar(index){
            this.duration=index
        },
        str(str){
            return str.length>50 ? str.slice(0, 50) + '...' : str;
        }
    }
}
</script>
<style scoped>
    .fade-enter-active, .fade-leave-active {
        will-change: opacity;
        transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
                /* background: linear-gradient(to bottom right, #e4f0e9, #dce7e1); */
    }
    #section1 .content-container{
        max-width: 1200px;
        width: 100%;
        margin: auto;
        align-items: flex-start;
        padding: 10%
    }
    .hr{
        border: 0;
        background-color: #bdbdbd;
        height: 1px;
    }
    h2 {
        font-size: 18px;
        font-weight: bold;
        letter-spacing: 0.25em;
        color: #006362;
        padding-right: 5%;
    }
    .blog{
        color: #333;
        letter-spacing: 0.15em;
    }
    .date{
        padding-right: 10px;
    }
    #section2 .wrapper{
        margin-bottom: 150px;
    }
    #section3 .wrapper{
        margin-bottom: 50px;
    }
    .bg{
        width: 50%;
        height: 100%;
        position: absolute;
        top: 0;
        right: 0;
        background-color: #383b3d;
        z-index: 0;
    }
    #section4 .wrapper{
        width: 100%;
        /* background-color: #333; */
    }
    #section4 .content-container{
        max-width: 1200px;
        width: 100%;
        margin: auto;
        height: 550px;
        position: relative;
    }
    #section5 .wrapper{
        width: 100%;
        background-color: #333;
    }
    #section5 .content-container{
        max-width: 1100px;
        width: 100%;
        margin: auto;
    }
    .insta_btn {
        color: #f3f3f3;
        border-radius: 7px;
        position: relative;
        display: inline-block;
        width: 45%;
        text-align: center;
        font-size: 15px;
        line-height: 35px;
        background: linear-gradient(
    135deg
    , #427eff 0%, #f13f79 70%) no-repeat;
        overflow: hidden;
        text-decoration: none;
    }
    .insta_btn:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
    15deg
    , #ffdb2c, #f9764c 25%, rgba(255, 77, 64, 0) 50%) no-repeat;
    }
    .insta_btn .fa-instagram {
        font-size: 25px;
        position: relative;
        top: 5px;
        padding: 0px;
    }
    .insta_btn span {
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }
    .fb_btn {
        color: #f3f3f3;
        border-radius: 7px;
        position: relative;
        display: inline-block;
        width: 45%;
        text-align: center;
        font-size: 15px;
        line-height: 35px;
        overflow: hidden;
        text-decoration: none;
        background: #355392;
    }
    .change{
        transition: all .5s;
    }
</style>