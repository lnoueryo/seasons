<template>
    <div>
        <transition name="fade" mode="out-in">
            <router-view name="header"></router-view>
        </transition>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>