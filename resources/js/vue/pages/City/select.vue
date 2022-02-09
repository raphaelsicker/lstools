<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="cities"
        :searchable="true"
        :close-on-select="true"
        :show-labels="false"
        id="cities"
        label="name"
        track-by="name"
        placeholder="">
        <span slot="noOptions">Nenhuma opção ainda</span>
        <span slot="noResult">Nenhum estado encontrada</span>
    </multiselect>
</template>

<script>
    import City from "../../../models/City";

    export default {
        name: "CitySelect",
        props: ['value', 'uf'],
        data() {
            return {
                cities: []
            }
        },
        watch: {
            uf: function() {
                this.load()
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            async load() {
                const filters = this.uf
                    ? JSON.stringify({uf_id: this.uf.id})
                    : {}

                this.cities = await City.all({filters})
            }
        }
    }
</script>

<style scoped>

</style>
