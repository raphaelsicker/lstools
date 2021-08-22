<template>
    <aside id="hoe-left-panel" hoe-position-type="absolute">
        <div class="profile-box">
            <div class="media">
                <a class="pull-left" href="user-profile.html">
                    <img class="rounded" src="/images/avatar-1.jpg">
                </a>
                <div class="media-body">
                    <h5 class="media-heading">Welcome <span>James</span></h5>
                    <small>UX Designer</small>
                </div>
            </div>
        </div>
        <div id="panel-list">
            <main-menu/>
        </div>
    </aside>

</template>

<script>
    import MainMenu from "../../components/MainMenu";
    export default {
        name: "LeftPanel",
        components: {MainMenu},
    }
</script>

<style scoped>
    #panel-list {
        height: calc(100vh - 103px);
        overflow-y: auto;
        direction: rtl;
    }

</style>
