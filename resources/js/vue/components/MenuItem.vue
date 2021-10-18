<template>
    <ul class="hoe-sub-menu">
        <li
            v-for="item in menus"
            :class="getClass(item)">
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
        },
        methods: {
            getClass(item) {
                return item.submenus ? 'hoe-has-menu' : ''
                    + ' '
                    + item.link ? 'active' : ''
            }
        }
    }
</script>

<style scoped>

</style>
