<template>
    <header id="hoe-header" hoe-lpanel-effect="shrink">
        <div class="hoe-left-header">
            <a href="#"><i class="fas fa-route"></i> <span>LS Tools</span></a>
            <span class="hoe-sidebar-toggle"><a href="#"></a></span>
        </div>

        <div class="hoe-right-header" hoe-position-type="relative">
            <span class="hoe-sidebar-toggle"><a href="#"></a></span>
            <ul class="left-navbar">
                <li class="dropdown hoe-rheader-submenu message-notification">
                    <a href="#" class="dropdown-toggle icon-circle" data-toggle="dropdown">
                        <i class="far fa-envelope-open"></i>
                        <span class="badge badge-danger">5</span>
                    </a>
                    <emails></emails>
                </li>
                <li class="dropdown hoe-rheader-submenu message-notification left-min-30">
                    <a href="#" class="dropdown-toggle icon-circle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge badge-success">6</span>
                    </a>
                  <notifications></notifications>
                </li>
                <li class="dropdown hoe-rheader-submenu message-notification left-min-65">
                    <a href="#" class="dropdown-toggle icon-circle" data-toggle="dropdown">
                        <i class="fa fa-tasks"></i>
                        <span class="badge badge-danger">4</span>
                    </a>
                    <tasks></tasks>
                </li>
                <li>
                    <search></search>
                </li>
            </ul>
            <profile></profile>
        </div>
    </header>
</template>

<script>
    import Emails from "./headers/Emails";
    import Notifications from "./headers/Notifications";
    import Tasks from "./headers/Tasks";
    import Search from "./headers/Search";
    import Profile from "./headers/Profile";
    export default {
        name: "AppHeader",
        components: {Profile, Search, Tasks, Notifications, Emails}
    }
</script>

<style scoped>

</style>
