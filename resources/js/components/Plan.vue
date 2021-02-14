<template>
    <div>
        <div v-for="(plan, i) in plans" :key="i">
            <h1>{{ plan.name }}</h1>
            <v-row>
                <v-col v-for="(n, j) in plan.type" :key="j" cols="12" md="4">
                    <div>
                        <v-card :loading="loading" class="mx-auto my-12" max-width="300" @click="select(i,j)">
                            <template slot="progress">
                                <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                            </template>
                            <v-img height="250" :src="n.src">
                                <v-overlay :switch="n.isSelected"></v-overlay>
                            </v-img>
                            <v-card-title>{{ n.title }}
                            </v-card-title>
                            <v-card-text>
                                <div v-html="n.description"></div>
                            </v-card-text>
                            <div class="d-flex">
                            <v-card-subtitle>
                                <b>{{ decimalSeparator(n.price) }}</b>
                            </v-card-subtitle>
                            <v-card-subtitle>
                                <b>{{ calculateHour(n.duration) }}</b>
                            </v-card-subtitle>
                            </div>
                            <!-- <v-card-title>{{ decimalSeparator(n.price) }}</v-card-title> -->
                        </v-card>
                    </div>
                </v-col>
            </v-row>
        </div>
    </div>
</template>
<script>
import indication from "../mixins/indication"
export default {
    mixins: [indication],
    created(){
        this.$watch(() => this.plans[0].type[0].isSelected, this.selectedMensCut);
        this.$watch(() => this.plans[0].type[1].isSelected, this.selectedLadiesCut);
        this.$watch(() => this.plans[3].type[2].isSelected, this.selected90Spa);
    },
    watch: {
        plans: {
            handler(){
                const selectedPlanPrice = this.plans.map((plan)=>{
                    let selectedPlan = plan.type.filter((v)=>{
                        return v.isSelected ===true;
                    })
                    return selectedPlan.length > 0 ? selectedPlan[0].price : 0;
                })

                const totalPrice = selectedPlanPrice.reduce((a,b)=>{
                    return a+b;
                });
                const selectedPlanDuration = this.plans.map((plan)=>{
                    let selectedPlan = plan.type.filter((v)=>{
                        return v.isSelected ===true;
                    })
                    return selectedPlan.length > 0 ? selectedPlan[0].duration : 0;
                })

                const totalDuration = selectedPlanDuration.reduce((a,b)=>{
                    return a+b;
                });
                this.$emit('plan', {price: totalPrice, duration: totalDuration})
            },
            deep: true,
            immidiate: true
        }
    },
    methods: {
        selectedMensCut(isSelected){
            if(isSelected){
                this.plans[1].type.forEach((perm) => {
                    this.$set(perm, 'price', perm.price-1600)
                });
                this.plans[2].type.forEach((color) => {
                    this.$set(color, 'price', color.price-1600)
                });
            } else {
                this.plans[1].type.forEach((perm) => {
                    this.$set(perm, 'price', perm.price+1600)
                });
                this.plans[2].type.forEach((color) => {
                    this.$set(color, 'price', color.price+1600)
                });
            }
        },
        selectedLadiesCut(isSelected){
            if(isSelected){
                this.plans[1].type.forEach((perm) => {
                    this.$set(perm, 'price', perm.price-1500)
                });
                this.plans[2].type.forEach((color) => {
                    this.$set(color, 'price', color.price-1500)
                });
            } else {
                this.plans[1].type.forEach((perm) => {
                    this.$set(perm, 'price', perm.price+1500)
                });
                this.plans[2].type.forEach((color) => {
                    this.$set(color, 'price', color.price+1500)
                });
            }
        },
        selected90Spa(isSelected){
            const treatment = this.plans[4].type[0];
            isSelected ? this.$set(treatment, 'price', treatment.price-2200) : this.$set(treatment, 'price', treatment.price+2200)
        },
        select(num1, num2){
            if(this.plans[num1].type[num2].isSelected==true){
                this.$set(this.plans[num1].type[num2], 'isSelected', false)
            } else {
                const isSelected = this.plans[num1].type.findIndex((v)=> {
                    return v.isSelected === true;
                })
                if(isSelected>=0){
                    this.$set(this.plans[num1].type[isSelected], 'isSelected', false)
                }
                this.$set(this.plans[num1].type[num2], 'isSelected', true)
            };
        },
        reset(){
            this.plans.forEach((plan)=>{
                plan.type.forEach((v)=>{
                    this.$set(v, 'isSelected', false)
                })
            })
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