<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="cards"
        :searchable="true"
        :close-on-select="true"
        :show-labels="false"
        id="cards"
        label="order"
        track-by="order"
        placeholder="">
        <span slot="noOptions">Nenhuma opção ainda</span>
        <span slot="noResult">Nenhum estado encontrada</span>
    </multiselect>
</template>

<script>
    import Card from "../../../models/Card";

    export default {
        name: "CardSelect",
        props: ['value', 'locality'],
        data() {
            return {
                cards: []
            }
        },
        watch: {
            locality: function() {
                this.load()
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            async load() {
                const filters = this.locality
                    ? JSON.stringify({locality_id: this.locality.id})
                    : {}

                this.cards = await Card.all({filters})
            }
        }
    }
</script>

<style scoped>

</style>
