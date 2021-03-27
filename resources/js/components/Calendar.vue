<template>
    <div>
        <div class="d-flex text-center align-items-center" style="max-width:900px;margin: auto">
            <div>
                <v-btn @click="previousWeek" :disabled="ready || dateIndex==0">Back</v-btn>
            </div>
                <div class="px-3" style="max-width: 740px; width: 100%;overflow-x:scroll;">
                    <transition name="fade">
                        <div class="d-flex text-center justify-content-start">
                            <div>
                                <div style="display: inline-block;height: 45px">&nbsp;&nbsp;</div>
                                <div class="p-1" style="height: 31px" v-for="(period , i) in periods" :key="i"><span>{{ period }}</span></div>
                            </div>
                            <div class="d-flex" style="margin: auto" v-if="calendar.length!==0">
                                <div v-for="(c, i) in calendar" :key="i">
                                    <div style="width: 45px;height: 45px">
                                        <div v-if="days[i]">{{ days[i].getMonth()+1}}/{{ days[i].getDate() }}</div>
                                        <div v-if="days[i]">{{ dayOfWeek(days[i].getDay()) }}</div>
                                    </div>
                                    <div style="height: 31px" class="p-1" v-for="(time, j) in c" :key="j">
                                        <router-link style="text-decoration: none;" :to="{name: 'confirmation', $route, query:{date: time.date, duration: duration, title: title, price: price}}" :class="{ 'is-disabled': time.isBooking }">
                                            <b>{{ (time.isBooking==false) ? '〇' : '×' }}</b>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            <div>
                <v-btn @click="nextWeek" :disabled="ready || dateIndex==1">Next</v-btn>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['duration', 'price', 'title'],
    data() {
        return {
            calendar: [],
            bookings: [],
            periods: ['10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30','19:00'],
            days: this.makeTwoWeeks(0),
            dateIndex: 0,
            ready: false,
            time: '',
        }
    },
    watch: {
        duration: {
            handler(){
                this.makeCalendar(this.dateIndex);
            },
            immediate: false
        },
    },
    async created(){
        const response = (await axios.get(`/api/booking/${this.$route.params.sid}`));
        const bookings = response.data;
        for (let i = 0; i < bookings.length; i++) {
            await this.bookings.push(bookings[i]);
        }
        Echo.private('change-booking')
        .listen('ChangeBooking', async () => {
            this.bookings = [];
            const response = await axios.get(`/api/booking/${this.$route.params.sid}`);
            const bookings = response.data;
                for (let i = 0; i < bookings.length; i++) {
                    this.bookings.push(bookings[i]);
                }
            this.makeCalendar(this.dateIndex);
        });
    },
    methods: {
        makeCalendar(index){
            this.calendar = [];
            for (let i = 15*index; i < 15+15*index; i++) {
                let dates = [];
                for (let j = 0; j < 19; j++) {
                    const today = new Date(this.time)
                    today.setMonth(today.getMonth())
                    today.setDate(today.getDate()+i)
                    today.setHours(10)
                    today.setMinutes(30*j)
                    today.setSeconds(0)
                    dates.push({date: today.getTime(), isBooking: false});
                }
                this.calendar.push(dates)
            }
            this.getBookings()
            this.bookableDate((this.duration/30)-1);
        },
        getBookings(){
            this.calendar.forEach((date, i) => {
                date.forEach((time, j) => {
                    this.bookings.forEach(booking=>{
                        const condition1 = this.floor(booking.from)<=this.floor(time.date);
                        const condition2 = this.floor(time.date)<=this.floor(booking.to);
                        if (condition1&&condition2) {
                            this.$set(this.calendar[i][j], 'isBooking', true)
                        }
                    })
                })
            })
        },
        bookableDate(index){
            this.calendar.forEach((date, i) => {
                date.forEach((time, j) => {
                    this.bookings.forEach(booking=>{
                        if (this.floor(booking.from)==this.floor(time.date)) {
                            for (let k = 1; k < index+1; k++) {
                                if((j-k)!==-1){
                                    this.$set(this.calendar[i][j-k], 'isBooking', true);
                                } else {
                                    return;
                                }
                            }
                        }
                    })
                    if(index!==0 && (date.length-index)<=j){
                        this.$set(this.calendar[i][j], 'isBooking', true)
                    }
                    if ((new Date()).getTime()>time.date) {
                        this.$set(this.calendar[i][j], 'isBooking', true)
                    }
                })
            })
            this.ready = false
        },
        floor(time){
            return Math.floor(time/1000)
        },
        makeTwoWeeks(index){
            let daysArray = [];
            axios.get('/api/time').then(response => {
                this.time = response.data;
                for (let i = 15*index; i < 15+15*index; i++) {
                    const days = new Date(response.data);
                    days.setMonth(days.getMonth())
                    days.setDate(days.getDate()+i)
                    daysArray.push(days);
                }
            })
            return daysArray;
        },
        nextWeek(){
            this.ready = true;
            this.calendar = [];
            this.dateIndex+=1;
            this.days = this.makeTwoWeeks(this.dateIndex);
            this.makeCalendar(this.dateIndex)
        },
        previousWeek(){
            this.ready = true;
            this.calendar = [];
            this.dateIndex-=1;
            this.days = this.makeTwoWeeks(this.dateIndex);
            this.makeCalendar(this.dateIndex)
        },
        dayOfWeek(num){
            const dayOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
            return dayOfWeek[num]
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
        transition: opacity 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>