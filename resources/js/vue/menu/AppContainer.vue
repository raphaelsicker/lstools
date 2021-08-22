<template>
    <div id="hoeapp-container" hoe-color-type="lpanel-bg2" hoe-lpanel-effect="shrink">
        <left-panel></left-panel>
        <transition name="page">
            <router-view/>
        </transition>
    </div>
</template>

<script>
    import LeftPanel from "./panels/LeftPanel";

    export default {
        name: "AppContainer",
        components: {LeftPanel}
    }
</script>

<style scoped>
    #hoeapp-container {
        overflow-y: auto;
        height: calc(100vh - 50px);
        position: static;
    }

    .page-enter-active, .page-leave-active {
        transition: opacity .2s
    }
    .page-enter, .page-leave-active {
        opacity: 0
    }
</style>
