<template>
    <ul class="nav panel-list">
        <li
            v-for="item in menus"
            :class="item.submenus ? 'hoe-has-menu' : ''">
            <router-link :to="item.submenus ? '#': item.link">
                <i :class="item.icon"></i>
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
    import Acessos from "../../domain/Acessos";
    import MenuItem from "./MenuItem";

    export default {
        name: "MainMenu",
        components: {MenuItem},
        data() {
            return {
                menus: {}
            }
        },
        beforeCreate() {
            Acessos.menus()
                .then(reposta =>{
                    this.menus = reposta.data;

                    this.$nextTick(() => {
                        this.carregarHoeScript();
                    })
                });
        },
        methods: {
            carregarHoeScript() {
                let newHoe = document.createElement('script');
                newHoe.src = '/js/menu/hoe.js';

                let oldHoe = document.getElementById('app-script');
                oldHoe.parentNode.insertBefore(newHoe, oldHoe.nextSibling);
            }
        }
    }
</script>

<style scoped>

</style>
