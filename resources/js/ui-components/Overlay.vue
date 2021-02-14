<template>
    <div>
        <transition name="overlay">
            <div class="text" v-if="isSelected">Selected</div>
        </transition>
        <transition name="overlay">
            <div class="bg-color" v-if="isSelected"></div>
        </transition>
    </div>
</template>
<script>
export default {
    props: ['switch'],
    computed: {
        isSelected(){
            return this.switch;
        }
    },
}
</script>
<style scoped>
    .bg-color{
        background-color: black!important;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 5!important;
        opacity: 0.7;
    }
    .text{
        color: rgba(255, 255, 255, 0.66);
        font-weight: bold;
        font-size: 36px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
        margin: auto;
        z-index: 6!important;
    }
    .overlay-enter-active, .overlay-leave-active {
        will-change: opacity;
        transition: opacity 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    }
    .overlay-enter, .overlay-leave-to {
        opacity: 0
    }
</style>