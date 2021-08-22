<template>
    <div id="hoeapp-wrapper" class="hoe-hide-lpanel" hoe-device-type="desktop">
        <AppHeader></AppHeader>
        <AppContainer></AppContainer>
    </div>
</template>

<script>
    import AppHeader from "./menu/AppHeader";
    import AppContainer from "./menu/AppContainer";

    export default {
        name: "App",
        components: {AppContainer, AppHeader},
    }
</script>

<style lang="sass">
    @import "../../sass/app.scss"
</style>
