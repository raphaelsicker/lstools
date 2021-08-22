<template>
    <ul class="hoe-sub-menu">
        <li
            v-for="item in menus"
            :class="item.submenus ? 'hoe-has-menu' : ''">
            <router-link :to="item.submenus ? '#': item.link ">
                <span class="menu-text">{{item.name}}</span>
                <span class="selected"></span>
            </router-link>
            <menu-item
                v-if="item.submenus"
                :menus="item.submenus"/>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "MenuItem",
        props: {
            menus: {
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
