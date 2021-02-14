<template>
    <div>
        <div class="d-flex text-center align-items-center">
            <div>
                <v-btn @click="previousWeek">Back</v-btn>
            </div>
            <transition name="fade">
                <div class="d-flex text-center justify-content-center" v-if="bookingCalendar" style="max-width: 740px; width: 100%;">
                    <div>
                        <div class="p-1" style="display: inline-block">&nbsp;&nbsp;</div>
                        <div class="p-1" v-for="(period , i) in periods" :key="i">{{ period }}</div>
                    </div>
                    <div class="d-flex" v-if="days">
                        <div v-for="(booking, i) in bookingCalendar" :key="i">
                            <div class="p-1">{{ december(days[i].getMonth()) }}/{{ days[i].getDate() }}</div>
                            <div class="p-1" v-for="(time, j) in booking" :key="j">
                                <router-link :to="time.isBooking ? '/home' : '/'" :class="{ 'is-disabled': time.isBooking }">
                                    {{ (time.isBooking==false) ? '〇' : '×' }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
            <div>
                <v-btn @click="nextWeek">Next</v-btn>
            </div>
        </div>
        <div>
            <v-btn @click="preventBooking">1時間</v-btn>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            bookingCalendar: null,
            periods: ['10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30','19:00'],
            days: this.makeTwoWeeks(0),
            dateIndex: 0,
        }
    },
    created(){
        this.makeNewBookingCalendar(0)
    },
    methods: {
        async makeNewBookingCalendar(index){
            const bookings = await this.getBookings(index);
            await this.calendar(bookings, index)
        },
        makeTwoWeeks(index){
            let daysArray = [];
            for (let i = 15*index; i < 15+15*index; i++) {
                const days = new Date();
                days.setMonth(days.getMonth()+1)
                days.setDate(days.getDate()+i)
                daysArray.push(days);
            }
            return daysArray;
        },
        nextWeek(){
            this.bookingCalendar = null;
            this.dateIndex+=1;
            this.days = this.makeTwoWeeks(this.dateIndex);
            this.makeNewBookingCalendar(this.dateIndex)
        },
        previousWeek(){
            this.bookingCalendar = null;
            this.dateIndex-=1;
            this.days = this.makeTwoWeeks(this.dateIndex);
            this.makeNewBookingCalendar(this.dateIndex)
        },
        december(num){
            return num===0 ?12 : num
        },
        getBookings(index){
            const bookings = []
            axios.get('api/time').then(response => {
                for (let i = 0; i < 15; i++) {
                    let random1 = Math.floor(Math.random()*(15+15*index))
                    let random2 = Math.floor(Math.random()*10)
                    const booking = new Date(response.data)
                    booking.setMonth(booking.getMonth())
                    booking.setDate(booking.getDate()+random1)
                    booking.setHours(10)
                    booking.setMinutes(30*random2)
                    booking.setSeconds(0)
                    bookings.push({date: booking, isBooking: true});
                }
            })
            return bookings
        },
        calendar(bookings, index){
            const calendar = [];
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
                    calendar.push(dates)
                }
            }).then(() => {
                this.bookingsOnCalendar(bookings, calendar)
            })
        },
        bookingsOnCalendar(bookings, calendar){
            const bookingCalendar = calendar.map((date) => {
                let bookedDate = date.map((time)=>{
                    let bookedTime = bookings.find((booking)=>{
                        return Math.floor(time.date.getTime()/1000) === Math.floor(booking.date.getTime()/1000)
                    })
                    return bookedTime ? Object.assign(time,bookedTime) : time;
                })
                return bookedDate;
            })
            this.bookingCalendar = bookingCalendar;
        },
        preventBooking(){
            let bookedTime = [];
            this.bookingCalendar.forEach(date => {
                date.forEach(time => {
                    if (time.isBooking) {
                        bookedTime.push(time)
                    };
                })
            });
            console.log(bookedTime)
        }
    }
}
</script>

<style>
    .is-disabled {
        pointer-events: none;
        opacity: .5;
    }
    /* .fade-enter-active, .fade-leave-active {
        will-change: opacity;
        transition: opacity 1000ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    } */
</style>