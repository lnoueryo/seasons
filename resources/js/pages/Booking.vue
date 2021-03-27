<template>
    <div>
        <v-stepper v-model="e1">
            <v-stepper-header style="padding: 0 200px">
            <v-stepper-step :complete="e1 > 1" step="1">
                PLAN
            </v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step :complete="e1 > 2" step="2">
                DATE
            </v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step :complete="e1 > 3" step="3">
                CONFIRMATION
            </v-stepper-step>
            </v-stepper-header>
            <v-stepper-items>
                <v-card class="mb-12" color="grey lighten-4" max-width="180" style="opacity: 0.85;position: fixed;right: 2%;top: 100px; width: 100%;z-index: 1">
                    <div style="position: relative;height: 100%;">
                        <v-card-title>
                            合計金額
                        </v-card-title>
                        <v-card-subtitle>
                            <div style="height: 20px;">
                                <span><b>{{ totalValue(decimalSeparator(plan.price)) }}</b></span>
                            </div>
                        </v-card-subtitle>
                        <v-card-title>
                            所要時間
                        </v-card-title>
                        <v-card-subtitle>
                            <div style="height: 20px;">
                                <span><b>{{ calculateHour(plan.duration) }}</b></span>
                            </div>
                        </v-card-subtitle>
                        <div class="d-flex justify-content-around mb-4">
                            <v-btn color="white lighten-2" style="width: 45%;text-decoration: none" to="/" v-if="e1==1">
                                戻る
                            </v-btn>
                            <v-btn color="white lighten-2" style="width: 40%" @click="e1-=1" v-if="e1>1">
                                戻る
                            </v-btn>
                            <v-btn color="primary" style="width: 45%" @click="e1+=1" :disabled="plan.price==0 || e1==2">
                                次へ
                            </v-btn>
                        </div>
                        <div class="d-flex justify-content-around mb-4">
                            <v-btn class="white--text" color="red lighten-1" outlined style="width: 95%" @click="$refs.plan.reset();e1=1">
                                リセット
                            </v-btn>
                        </div>
                    </div>
                </v-card>
                <v-container>
                <v-stepper-content step="1">
                    <plan ref="plan" @plan="plan = $event"></plan>
                </v-stepper-content>

                <v-stepper-content step="2">
                    <calendar v-bind="plan" v-if="plan"></calendar>
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
    </div>
</template>
<script>
import Plan from "../components/Plan";
import Calendar from "../components/Calendar";
import indication from "../mixins/indication"
export default {
    mixins: [indication],
    components: {
        Plan,
        Calendar,
    },
    data: () => ({
        loading: false,
        plan: {duration: 0, price: 0, title: ''},
    }),
    computed: {
        duration(){
            return (this.plan.duration/30)-1;
        }
    },
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