<template>
    <ul class="nav panel-list">
        <li v-for="item in menus"
            :class="getClass(item)">
            <router-link :to="item.submenus ? '#': item.link">
                <i :class="item.icon"></i>
                <span class="menu-text">{{item.name}}</span>
                <span class="selected"></span>
            </router-link>
            <menu-item
                v-if="item.submenus"
                :menus="item.submenus"
            />
        </li>
    </ul>
</template>

<script>
    import MenuItem from "./MenuItem";
    import Menu from "../../models/Menu";

    export default {
        name: "MainMenu",
        components: {MenuItem},
        data() {
            return {
                menus: {}
            }
        },
        async beforeCreate() {
            this.menus = await Menu.get()

            this.$nextTick(() => {
                this.loadHoeScript();
            })
        },
        methods: {
            loadHoeScript() {
                let newHoe = document.createElement('script');
                newHoe.src = '/js/menu/hoe.js';

                let oldHoe = document.getElementById('app-script');
                oldHoe.parentNode.insertBefore(newHoe, oldHoe.nextSibling);
            },
            getClass(item) {
                let active = false
                let link = item.link.replace('/', '')

                for(let path of location.pathname.split('/')) {
                    if(path !== '' && path === link) {
                        active = true
                    }
                }

                return (item.submenus ? 'hoe-has-menu' : '') + ' ' + (active ? 'opened' : '')
            }
        }
    }
</script>

<style scoped>

</style>
