<template>
    <div @mouseup="dragEnd" @mouseleave="dragEnd" @mousemove="dragging($event)">
        <div class="content-container">
            <div class="d-flex align-items-center">
                <div class="d-flex justify-content-center" style="width: 10%;">
                    <button @click="previous" :disabled="currentPosition==0">Back</button>
                </div>
                <div id="card-cover" class="rel" @mousedown="dragStart($event)">
                    <div ref="frame" class="d-flex rel" :style="translateX">
                        <div class="abs" ref="card" v-for="(style, i) in styles" :key="i" hover link>
                            <v-card tag="button" class="mx-auto my-12 text-decoration-none" max-width="280" :to="{name: 'blog', params: {bid: style.id}}" :disabled="disabled">
                                <template slot="progress">
                                    <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                                </template>

                                <v-img height="250" :src="style.src">
                                    <v-badge class="px-1" content="NEW" value="NEW" color="green"></v-badge>
                                </v-img>
                                <v-card-title>{{ style.title }}
                                </v-card-title>
                                <v-card-text>
                                    <div v-html="str(style.description)"></div>
                                </v-card-text>
                                <v-card-subtitle>
                                    <b>{{ style.date }}</b>
                                </v-card-subtitle>
                            </v-card>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center" style="width: 10%;">
                    <button @click="next" :disabled="currentPosition<=-(this.styles.length-3)*340">Next</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
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
                {id: 1, title: 'やっぱり', date: '2021.01.07', src: 'images/blog01.jpg',description: 'いつも本当に有難う御座いますm(_ _)m<br>仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてます(｀_´)ゞここまで読んで頂いてありがとうございました！'},
                {id: 2, title: '夏は', date: '2021.01.07', src: 'images/blog01.jpg',description: 'いつも本当に有難う御座いますm(_ _)m<br>仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてます(｀_´)ゞここまで読んで頂いてありがとうございました！'},
                {id: 3, title: 'ショート', date: '2021.01.07', src: 'images/blog01.jpg',description: 'いつも本当に有難う御座いますm(_ _)m<br>仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてます(｀_´)ゞここまで読んで頂いてありがとうございました！'},
                {id: 4, title: 'ですか', date: '2021.01.07', src: 'images/blog01.jpg',description: 'いつも本当に有難う御座いますm(_ _)m<br>仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてます(｀_´)ゞここまで読んで頂いてありがとうございました！'},
                {id: 5, title: '？', date: '2021.01.07', src: 'images/blog01.jpg',description: 'いつも本当に有難う御座いますm(_ _)m<br>仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてます(｀_´)ゞここまで読んで頂いてありがとうございました！'},
                {id: 6, title: 'やっぱり夏は', date: '2021.01.07', src: 'images/blog01.jpg',description: 'いつも本当に有難う御座いますm(_ _)m<br>仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてます(｀_´)ゞここまで読んで頂いてありがとうございました！'},
                {id: 7, title: 'ショート', date: '2021.01.07', src: 'images/blog01.jpg',description: 'いつも本当に有難う御座いますm(_ _)m<br>仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてます(｀_´)ゞここまで読んで頂いてありがとうございました！'},
                {id: 8, title: 'です', date: '2021.01.07', src: 'images/blog01.jpg',description: 'いつも本当に有難う御座いますm(_ _)m<br>仕上がりはこちらです耳のところを短くすることで襟足と顔周りの長さを際立たせてます(｀_´)ゞここまで読んで頂いてありがとうございました！'}
            ],
            currentPosition: 0,
            distance: 0,
        }
    },
    mounted(){
        this.cardInterval()
        this.$refs.frame.style.width = (this.styles.length*340) + 10 +'px';
    },
    computed:{
        translateX() {
            return {'transform': `translateX(${this.currentPosition+this.distance}px)`}
        }
    },
    methods: {
        cardInterval(){
            this.$refs.card.forEach((card, index)=>{
                card.style.left = `${340*index+2}px`
            })
        },
        dragStart(e){
            this.startX = e.clientX
            this.isMouse = true;
            this.$refs.frame.style.transition= '';
        },
        dragging(e){
            if (this.isMouse) {
                this.disabled = true;
                const movedDistance = e.clientX - this.startX
                const distance = this.currentPosition+movedDistance
                if(170>distance && distance > -((this.styles.length-3)*340)-170){
                    this.distance = movedDistance;
                }
            }
        },
        dragEnd(){
            this.disabled = false;
            this.isMouse = false;
            this.$refs.frame.style.transition= 'all .5s'
            this.currentPosition = Math.round((this.currentPosition + this.distance)/340)*340;
            // this.currentPosition = this.currentPosition + this.distance;
            this.distance = 0;
        },
        next(){
            this.currentPosition -=340
        },
        previous(){
            this.currentPosition +=340
        },
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
    .align-items-center{
        align-items: center;
    }
    .justify-content-center{
        justify-content: center;
    }
    .content-container{
        max-width: 1200px;
        width: 100%;
        margin: auto;
        height: 550px;
        position: relative;
    }
    #card-cover{
        overflow: hidden;
        width: 82%;
        height: 550px;
        z-index:0
    }

</style>