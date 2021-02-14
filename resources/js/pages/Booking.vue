<template>
    <div>
        <v-stepper v-model="e1">
            <v-stepper-header style="padding: 0 200px">
            <v-stepper-step :complete="e1 > 1" step="1">
                Name of step 1
            </v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step :complete="e1 > 2" step="2">
                Name of step 2
            </v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step :complete="e1 > 3" step="3">
                Name of step 3
            </v-stepper-step>
            </v-stepper-header>
            <v-stepper-items>
                <v-card class="mb-12" color="grey lighten-1" max-width="200" height="250px" style="position: fixed;right: 5%;top: 100px; width: 100%">
                    <div style="position: relative;height: 100%;">
                        <v-card-title>
                            合計金額
                        </v-card-title>
                        <v-card-subtitle>
                            <span v-if="plan"><b>{{ this.totalValue(this.decimalSeparator(plan.price)) }}</b></span>
                        </v-card-subtitle>
                        <v-card-title>
                            所要時間
                        </v-card-title>
                        <v-card-subtitle>
                            <span v-if="plan"><b>{{ this.culculateHour(plan.duration) }}</b></span>
                        </v-card-subtitle>
                        <div style="position: absolute; right: 10px;bottom: 10px;">
                            <v-btn color="black lighten-2" text to="/home" v-if="e1==1">
                                戻る
                            </v-btn>
                            <v-btn color="black lighten-2" text @click="e1-=1" v-if="e1>1">
                                戻る
                            </v-btn>
                            <v-btn color="black lighten-2" text @click="e1+=1" :disabled="!plan">
                                次へ進む
                            </v-btn>
                        </div>
                    </div>
                </v-card>
                <v-container>
                <v-stepper-content step="1">
                    <plan @plan="plan = $event"></plan>
                    <!-- <v-btn
                    color="primary"
                    @click="e1 = 2"
                    >
                    Continue
                    </v-btn>

                    <v-btn text>
                    Cancel
                    </v-btn> -->
                </v-stepper-content>

                <v-stepper-content step="2">
                    <calendar :duration="duration" v-if="plan"></calendar>
                </v-stepper-content>

                <v-stepper-content step="3">
                    <v-card
                    class="mb-12"
                    color="grey lighten-1"
                    height="200px"
                    ></v-card>

                </v-stepper-content>
                </v-container>
            </v-stepper-items>
        </v-stepper>
        <!-- <v-container>
            <div v-for="(plan, i) in plans" :key="i">
                {{ plan.name }}{{ totalValue(decimalSeparator(total)) }}
                <v-row>
                    <v-col v-for="(n, j) in plan.type" :key="j" cols="12" md="4">
                        <div>
                            <v-card :loading="loading" class="mx-auto my-12" max-width="374" @click="changeIndex(i,j)">
                                <template slot="progress">
                                    <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                                </template>
                                <v-img height="250" :src="n.src"></v-img>
                                <v-card-title>{{ n.title }}
                                </v-card-title>
                                <v-card-text>
                                    <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus patio seating.</div>
                                </v-card-text>
                                <div class="d-flex">
                                <v-card-subtitle>
                                    <b>{{ decimalSeparator(n.price) }}</b>
                                </v-card-subtitle>
                                <v-card-subtitle>
                                    <b>{{ culculateHour(n.duration) }}</b>
                                </v-card-subtitle>
                                </div>
                                    <div :ref="'div'+String(i)+String(j)" class="color" style="opacity: 0.05"></div>
                            </v-card>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </v-container> -->
    </div>
</template>
<script>
import Plan from "../components/Plan";
import Calendar from "../components/Calendar";
export default {
    components: {
        Plan,
        Calendar
    },
    data: () => ({
        e1: 1,
        loading: false,
        plan: null,
    }),
    computed: {
        duration(){
            return (this.plan.duration/30)-1;
        }
    },
    methods: {
        decimalSeparator(num){
            const number = `${num}`;
            const firstHalf = number.slice(0, number.length-3)
            const secondHalf = number.slice(number.length-3)
            return (num===0) ? 'free' : '¥ ' + firstHalf + ',' + secondHalf + '- 税込';
        },
        totalValue(v){
            return v=='free' ? '¥ ' + 0 + '- 税込' : v
        },
        culculateHour(duration){
            if (duration==30) {
                return duration+'分'
            } else if(duration%60){
                return Math.floor(duration/60)+'時間'+ 30 + '分';
            } else {
                return duration/60+'時間';
            }
            return duration;
        },
    }
}
</script>
<style scoped>
    .fade-enter-active, .fade-leave-active {
        will-change: opacity;
        transition: opacity 1000ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>