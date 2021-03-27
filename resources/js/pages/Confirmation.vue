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
            const bookingDate = new Date(Number(time));
            return bookingDate;
        },
        async booking(){
            const route = this.$route.query;
            const user = await (axios.get('api/check'))
            const to = route.date*1+((route.duration*60-1)*1000);
            const params = {
                booking: {
                    from: route.date,
                    to: to,
                    duration: route.duration,
                    user_id: user.data.id,
                    staff_id: '2f0efe5f-6e62-46fc-ab10-6edc19259d11',
                    shop_id: this.$route.params.sid,
                    message: ''
                },
                payment: {price: route.price, paid: false, method: 'cash'},
                plan: {title: route.title, user_id: user.data.id,},
            }
            try {
                axios.post('/api/booking', params)
                .then(()=>{
                    this.$router.push('/')
                })
            } catch (error) {
                
            }
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
