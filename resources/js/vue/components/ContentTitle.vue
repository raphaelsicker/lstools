<template>
    <b-row class="content-title">
        <b-col sm="6" class="float-left">
            <h3 :class="'main-title ' + (subTitle ? '' : 'sem-subtitulo')">{{title}}</h3>
            <span v-if="subTitle">{{subTitle}}</span>
        </b-col>
        <b-col sm="6" class="float-right text-right">
            <div>
                <slot></slot>
            </div>
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name: "ContentTitle",
        props: {
            title: {
                required: false
            },
            subTitle: {
                required: true,
                type: String
            }
        }
    }
</script>

<style scoped>
    .row {
        margin: 0;
    }

    .content-title {
        padding: 30px 10px 0px;
    }
</style>
