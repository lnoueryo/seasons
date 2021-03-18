<template>
    <div>
        <div class="d-flex text-center align-items-center" style="max-width:680px;margin: auto">
            <div>
                <span>{{ calculateHour($route.query.duration) }}</span>
            </div>
            <div>
                <span>{{ decimalSeparator($route.query.price) }}</span>
            </div>
            <div>
                <span v-for="(t, i) in $route.query.title" :key="i">{{ t }}</span>
            </div>
            <div>
                <span>{{ changeToTimeStamp($route.query.date) }}</span>
                <!-- <span>{{ new Date(changeToTimeStamp(this.$route.query.date)).getMonth()+1 }}</span>
                <span>{{ new Date(changeToTimeStamp(this.$route.query.date)).getDate() }}</span>
                <span>{{ dayOfWeek(new Date(changeToTimeStamp(this.$route.query.date)).getDay()) }}</span>
                <span>{{ new Date(changeToTimeStamp(this.$route.query.date)).getHours() }}</span>
                <span>{{ new Date(changeToTimeStamp(this.$route.query.date)).getMinutes() }}</span> -->
            </div>
            <div>
                <v-btn @click="booking" class="white--text" color="brown">予約</v-btn>
            </div>
        </div>
    </div>
</template>
<script>
import indication from "../mixins/indication"
export default {
    mixins: [indication],
    methods: {
        changeToTimeStamp(time){
            const bookingDate = new Date();
            bookingDate.setTime(time);
            return bookingDate;
        },
        async booking(){
            const route = this.$route.query;
            const bookingDate = new Date();
            bookingDate.setTime(route.date);
            bookingDate.setMinutes(route.duration);
            // const db = firebase.firestore();
            console.log(route)
            // try {
            //     db.collection('bookings').doc(String(route.date)).set({
            //         duration: route.duration,
            //         from: this.changeToTimeStamp(route.date),
            //         price: route.price,
            //         to: bookingDate,
            //         uid: this.$store.state.user.uid
            //     })
            //     if (Array.isArray(route.title)) {
            //         route.title.forEach((t)=>{
            //             db.collection(`bookings/${route.date}/plan`).add({
            //                 id: route.date,
            //                 title: t,
            //             })
            //         })
            //     } else {
            //         db.collection(`bookings/${route.date}/plan`).add({
            //             id: route.date,
            //             title: route.title,
            //         })
            //     }
            //     this.$router.push('/')
            // } catch (error) {
                
            // }
        }
    }
}
</script>

<style scoped>
    .is-disabled {
        pointer-events: none;
        opacity: .5;
        color: red;
        font-weight: bold;
    }
    .fade-enter-active, .fade-leave-active {
        will-change: opacity;
        transition: opacity 1000ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        opacity: 1;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>
