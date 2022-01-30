<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="ufs"
        :searchable="true"
        :close-on-select="true"
        :show-labels="false"
        id="ufs"
        label="uf"
        track-by="uf"
        placeholder="Estados"
    >
        <span slot="noOptions">Nenhuma opção ainda</span>
        <span slot="noResult">Nenhum estado encontrada</span>
    </multiselect>
</template>

<script>
    import Uf from "../../../models/Uf";

    export default {
        name: "UfSelect",
        props: ['value'],
        data() {
            return {
                ufs: []
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            async load() {
                this.ufs = await Uf.all();
            }
        }
    }
</script>

<style scoped>

</style>
