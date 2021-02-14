<template>
    <div>
        <ul class="address text-center mt-4 mb-5">
            <li>福岡市中央区六本松</li>
            <li><p>4-9-7ジャパンパル101</p></li>
            <li class="tel">TEL.092-775-1821</li>
        </ul>
        <ul class="introduction text-center mt-4 mb-5">
            <li class="mt-2">美容室SeaSons(シーズン)はお客様の四季折々のヘアースタイルを常に提供させて頂けたらいいな、と言う思いでオープンしました。</li>
            <li>誰でも来やすいアットホームな店つくりを心がけておりますので気軽に立ち寄っていただけたら幸いです。</li>
            <li><span class="name">代表　道下 雅巳</span></li>
        </ul>
        <div class="col-md-10 offset-md-1 abc">
            <div class="quick-booking-able-text">予約表</div>
            <ul id="tabMenu" class="fix-line">
                <li>
                    <v-btn @click="changeCalendar(0)">男性カットのみ</v-btn>
                </li>
                <li>
                    <div class="toggle-switch text-center">
                        <!-- <input id="toggle" class="toggle-input" type='checkbox' v-model="current">
                        <label for="toggle" class="toggle-label"> -->
                    </div>
                </li>
                <li>
                    <v-btn @click="duration=1">女性カットのみ</v-btn>
                </li>
            </ul>
        </div>
        <div style="max-width: 1100px;width: 100%;margin:auto;">
            <calendar :duration="duration"></calendar>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            duration: 0
        }
    },
    methods: {
        changeCalendar(index){
            this.duration=index
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
        opacity: 0
    }
</style>