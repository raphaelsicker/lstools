<template>
    <div>
        <b-row class="content-title" :class=" value.pai ? '' : 'header-title'">
            <b-col md="9" class="access-name">
                <div class="arrow" v-if="value.subAcessos">
                    <a  class="collapse-arrow"  @click="value.visible = !value.visible" />
                </div>
                <div class="title" :style="'padding: 0 0 0 ' + value.nivel * 10 + 'px'">{{value.nome}}</div>
            </b-col>
            <b-col md="3" class="float-right select">
                <select-status-dos-acessos v-model="value.status" class="width-select"/>
            </b-col>
        </b-row>
        <b-collapse v-model="value.visible" class="with-bord" v-if="value.subAcessos">
            <div v-for="item in value.subAcessos">
                <items v-bind:value="item" :item-class="childClass"/>
            </div>
        </b-collapse>
    </div>
</template>

<script>
    import ContentTitle from "../../../components/ContentTitle";
    import SelectStatusDosAcessos from "../../../components/selects/SelectStatusDosAcessos";
    export default {
        name: "items",
        components: {SelectStatusDosAcessos, ContentTitle},
        props: ['value', 'itemClass', 'childClass']
    }
</script>

<style scoped>
    .row {
        margin: 0;
    }

    .access-name {
        align-items: center;
        display: flex;
        font-size: 14px;
    }

    .content-title {
        padding: 4px 0 4px 0;
    }

    .content-title:hover {
        background-color: #f5f5f5;
        font-weight: 600;
    }
    .content-title .select {
        font-weight: 400!important;
    }


    .little-header .main-title{
        font-size: 14px;
        font-weight: 400;
    }

    .collapse.with-bord {
        border-left: 5px solid #ddd;
    }

    .collapse-arrow::after {
        font-family: FontAwesome,serif;
        content: "\F106" !important;
        font-size: 15px;
        float: right;
        position: relative;
        cursor: pointer;
    }

    .collapsed.collapse-arrow::after {
        content: "\F107" !important;
    }

    .little-header {
        padding: 5px 5px;
    }

    .width-select {
        min-width: 120px;
    }

    .arrow {
        margin-right: 15px;
    }

    .multiselect__single {
        font-size: 14px;
    }

    .collapse-arrow::after {
        font-family: FontAwesome,serif;
        content: "\F106" !important;
        font-size: 15px;
        float: right;
        position: relative;
        cursor: pointer;
    }

    .collapsed.collapse-arrow::after {
        content: "\F107" !important;
    }
</style>
