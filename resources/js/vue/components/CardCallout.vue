<template>
    <div class="callout" @click="onclick">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "CardCallout",
        props: {
           to: {}
        },
        methods: {
            onclick() {
                this.$emit('click');
            }
        }
    }
</script>

<style lang="sass">
    @import "./CardCallout.scss"
</style>
