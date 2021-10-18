<template>
    <content-title
        :title="title"
        :subTitle="subTitle"
        class="main-content-title"/>
</template>

<script>
    import ContentTitle from "./ContentTitle";
    export default {
        name: "MainContentTitle",
        components: {ContentTitle},
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
</style>
