<template>
    <div>
        <div class="container">
            <iframe width="560" height="315" :src="movie" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <hr color="#c0c0c0">
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class="image">
                                        <!-- <img src=""> -->
                                </div>
                                <div class="title p-2">
                                    <h1></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="body mx-auto"></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr color="#c0c0c0">
            <div class="row">
                <div class="posts col-md-8 mx-auto mt-3">
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                </div>
                                <div class="title">
                                </div>
                                <div class="body mt-3">
                                </div>
                            </div>
                            <div class="image col-md-6 text-right mt-4">

                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            movie: 'https://www.youtube.com/embed/N1a7VhqODY4'
        }
    },
}
</script>
<style scoped>
    .fade-enter-active, .fade-leave-active {
        will-change: opacity;
        transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>