<template>
    <div class="a">
        <!-- <v-img src="/images/inside.png"></v-img> -->
    </div>
</template>
<script>
export default {
    data() {
        return {

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