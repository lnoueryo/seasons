<template>
    <div>
        <div class="d-flex text-center align-items-center" style="max-width:900px;margin: auto">
            <div>
                <v-btn @click="previousWeek" :disabled="ready || dateIndex==0">Back</v-btn>
            </div>
                <div class="px-3" style="max-width: 740px; width: 100%;">
                    <transition name="fade">
                        <div class="d-flex text-center justify-content-start align-items-end">
                            <div>
                                <div style="display: inline-block;">&nbsp;&nbsp;</div>
                                <div class="p-1" v-for="(period , i) in periods" :key="i">{{ period }}</div>
                            </div>
                            <div class="d-flex" style="margin: auto" v-if="calendar.length!=0">
                                <div v-for="(c, i) in calendar" :key="i">
                                    <div style="width: 45px;" v-if="days.length!=0">
                                        <div>{{ days[i].getMonth()+1}}/{{ days[i].getDate() }}</div>
                                        <div>{{ dayOfWeek(days[i].getDay()) }}</div>
                                    </div>
                                    <div class="p-1" v-for="(time, j) in c" :key="j">
                                        <router-link to="/confirmation" :class="{ 'is-disabled': time.isBooking }">
                                            {{ (time.isBooking==false) ? '〇' : '×' }}
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
            <div>
                <v-btn @click="nextWeek" :disabled="ready">Next</v-btn>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['duration'],
    data() {
        return {
            calendar: [],
            bookings: [
                {id: 1, from: new Date('2021/02/13 11:30:00'), to: new Date('2021/02/13 12:00:00')},
                {id: 2, from: new Date('2021/02/13 13:00:00'), to: new Date('2021/02/13 14:00:00')},
                {id: 3, from: new Date('2021/02/13 17:00:00'), to: new Date('2021/02/13 19:30:00')},
                {id: 4, from: new Date('2021/02/15 10:00:00'), to: new Date('2021/02/13 11:00:00')},
                {id: 5, from: new Date('2021/02/14 14:00:00'), to: new Date('2021/02/14 16:30:00')},
                {id: 6, from: new Date('2021/02/16 13:00:00'), to: new Date('2021/02/16 18:00:00')},
                {id: 7, from: new Date('2021/02/14 17:00:00'), to: new Date('2021/02/14 18:00:00')},
                {id: 8, from: new Date('2021/02/17 13:30:00'), to: new Date('2021/02/14 17:00:00')},
                {id: 9, from: new Date('2021/02/20 11:00:00'), to: new Date('2021/02/20 15:30:00')},
                {id: 10, from: new Date('2021/02/28 12:00:00'), to: new Date('2021/02/28 16:00:00')},
            ],
            periods: ['10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30','19:00'],
            days: this.makeTwoWeeks(0),
            dateIndex: 0,
            ready: false,
        }
    },
    watch: {
        duration: {
            handler(){
                this.makeCalendar(this.dateIndex);
            },
            immediate: true
        },
    },
    methods: {
        makeCalendar(index){
            this.calendar = [];
            axios.get('api/time').then(response => {
                for (let i = 15*index; i < 15+15*index; i++) {
                    let dates = []
                    for (let j = 0; j < 19; j++) {
                        const today = new Date(response.data)
                        today.setMonth(today.getMonth())
                        today.setDate(today.getDate()+i)
                        today.setHours(10)
                        today.setMinutes(30*j)
                        today.setSeconds(0)
                        dates.push({date: today, isBooking: false});
                    }
                    this.calendar.push(dates)
                }
            })
            .then(()=>{
                this.getBookings()
            })
            .then(()=>{
                this.bookableDate(this.duration)
            })
            .catch((error)=>{
                console.log(error)
                this.ready = false;
            })
        },
        getBookings(){
            this.calendar.forEach((date, i) => {
                date.forEach((time, j) => {
                    this.bookings.forEach(booking=>{
                        if (this.floor(booking.from)<=this.floor(time.date)&&this.floor(time.date)<this.floor(booking.to)) {
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
                        // if (this.floor()<=this.floor(time.date)&&this.floor(time.date)<this.floor(booking.to)) {
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
                })
            })
            this.calendar.forEach((date, i) => {
                date.forEach((time, j)=>{
                    if(index!==0 && (date.length-index)<=j){
                    this.$set(this.calendar[i][j], 'isBooking', true)
                }
                })
            })
            let that = this;
            setTimeout(function(){
                that.ready = false;
            },200)
        },
        floor(time){
            return Math.floor(time.getTime()/1000)
        },
        makeTwoWeeks(index){
            let daysArray = [];
            axios.get('api/time').then(response => {
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
    }
    .fade-enter-active, .fade-leave-active {
        will-change: opacity;
        transition: opacity 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>