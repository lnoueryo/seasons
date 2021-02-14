<template>
    <div>
        <v-container>
            <div v-for="(plan, i) in plans" :key="i">
                {{ plan.name }}{{ total }}
                <v-row>
                    <v-col v-for="(n, j) in plan.type" :key="j" cols="12" md="4">
                        <div>
                            <v-card :loading="loading" class="mx-auto my-12" max-width="374" @click="changeIndex(i,j)">
                                <template slot="progress">
                                    <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                                </template>
                                <v-img height="250" :src="n.src"></v-img>
                                <v-card-title>{{ n.title }}</v-card-title>
                                <v-card-text>
                                    <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus patio seating.</div>
                                </v-card-text>
                                <!-- <v-divider class="mx-4"></v-divider> -->
                                <v-card-title>{{ decimalSeparator(n.price) }}</v-card-title>
                                    <div :ref="'div'+String(i)+String(j)" class="color" style="opacity: 0.05"></div>
                            </v-card>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </v-container>
    </div>
</template>
<script>
export default {
    data: () => ({
        loading: false,
        timer: null,
        selection: 1,
        selectIndex: [[false, false], [false, false, false], [false, false, false], [false, false, false], [false]],
        plans: [
            {name: 'Cut', type: [{title: 'Mens', src: '/images/cut.jpg', price: 2900}, {title: 'Ladies', src: '/images/cut.jpg', price: 3300}]},
            {name: 'Perm', type: [{title: 'ColdPerm', src: '/images/perm.jpg', price: 5500}, {title: 'CreepPerm', src: '/images/perm.jpg', price: 7700}, {title: 'DigitalPerm', src: '/images/perm.jpg', price: 13200}]},
            {name: 'Color', type: [{title: 'GrayColor', src: '/images/color.jpg', price: 4400}, {title: 'FashionColor', src: '/images/color.jpg', price: 5500}, {title: '3D・DesignColor', src: '/images/color.jpg', price: 12200}]},
            {name: 'Spa', type: [{title: '30min コース', src: '/images/spa.jpg', price: 3900}, {title: '60min コース', src: '/images/spa.jpg', price: 7000}, {title: '90min コース', src: '/images/spa.jpg', price: 11000}]},
            {name: 'Treatment', type: [{title: 'Treatment', src: '/images/spa.jpg', price: 2200}]},
        ]
    }),
    created(){
        this.$watch(() => this.selectIndex[0][0], this.selectedMensCut);
        this.$watch(() => this.selectIndex[0][1], this.selectedLadiesCut);
        this.$watch(() => this.selectIndex[3][2], this.selected90Spa);
    },
    computed:{
        total(){
            return 
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
        reserve () {
            this.loading = true
            setTimeout(() => (this.loading = false), 2000)
        },
        decimalSeparator(num){
            const number = `${num}`;
            const firstHalf = number.slice(0, number.length-3)
            const secondHalf = number.slice(number.length-3)
            return (num===0) ? 'free' : '¥ ' + firstHalf + ',' + secondHalf + '- 税込';
        },
        changeIndex(num1, num2){
            if(this.selectIndex[num1][num2]==true){
                this.selectIndex[num1].splice(num2, 1, false)
            } else {
                const isSelected = this.selectIndex[num1].findIndex((v)=> {
                    return v === true;
                })
                if(isSelected>=0){
                    this.selectIndex[num1].splice(isSelected, 1, false)
                }
                this.selectIndex[num1].splice(num2, 1, true);
            };
            this.changeColor(num1, num2)
        },
        startColor(num1, num2){
            this.changeColor(num1, num2)
        },
        changeColor(num1, num2){
            let refs = [];
            for (let i = 0; i < this.selectIndex[num1].length; i++) {
                refs.push({ref: 'div'+String(num1)+String(i), isSelected: this.selectIndex[num1][i]})
            }
            console.log(refs)
            refs.forEach((ref)=>{
            let opacityNum = Number(this.$refs[ref.ref][0].style.opacity);
            if(ref.isSelected==true && this.$refs[ref.ref][0].style.opacity==0.05){
                for (let i = 1; i < 14; i++) {
                    this.$refs[ref.ref][0].style.opacity=String(opacityNum+0.05*i)
                }
            } else if(ref.isSelected==false && this.$refs[ref.ref][0].style.opacity==0.7) {
                for (let i = 1; i < 14; i++) {
                    this.$refs[ref.ref][0].style.opacity=String(opacityNum-0.05*i)
                }
            }
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
    .color{
        background-color: black!important;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 5!important;
        transition: all 1s;
        opacity: 0.2;
    }
    .color::after{
        color: brown;
        font-weight: bold;
        font-size: 24px;
        content: "Selected";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
        margin: auto;
    }
</style>