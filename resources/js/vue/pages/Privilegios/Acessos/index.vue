<template>
    <div>
        <content-title title="Acessos" :subTitle="'Defina o acesso do Privilégio'" class="title"/>
        <div class="acessos">
            <div v-for="item in value">
                <items v-bind:value="item" item-class="header-title little-header" child-class="little-header"></items>
            </div>
        </div>
    </div>
</template>

<script>
    import ContentTitle from "../../../components/ContentTitle";
    import Items from "./items";
    export default {
        name: "PrivilegioAcessos",
        components: {Items, ContentTitle},
        props: ['value', 'nomeAcesso'],
        data() {
            return {
                visible: true
            }
        }
    }
</script>

<style scoped>
    .acessos {
        background-color: #ffffff;
        border-left: 1px solid #e8e8e8;
        border-right: 1px solid #e8e8e8;
    }

    .title {
        background-color: #aaa;
        color: #fff;
        border-radius: 5px 5px 0 0;
    }
</style>
