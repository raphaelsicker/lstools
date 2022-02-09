<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="serviceGroups"
        :searchable="true"
        :close-on-select="true"
        :show-labels="false"
        id="serviceGroups"
        label="name"
        track-by="name"
        placeholder="Saídas de Campo">
        <span slot="noOptions">Nenhuma opção ainda</span>
        <span slot="noResult">Nenhum estado encontrada</span>
    </multiselect>
</template>

<script>
    import ServiceGroup from "../../../models/ServiceGroup";

    export default {
        name: "ServiceGroupSelect",
        props: ['value'],
        data() {
            return {
                serviceGroups: []
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            async load() {
                this.serviceGroups = await ServiceGroup.all();
            }
        }
    }
</script>

<style scoped>

</style>
