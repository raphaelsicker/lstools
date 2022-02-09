<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="localities"
        :searchable="true"
        :close-on-select="true"
        :show-labels="false"
        id="localidades"
        label="name"
        track-by="name"
        placeholder="Localidades">
        <span slot="noOptions">Nenhuma opção ainda</span>
        <span slot="noResult">Nenhum estado encontrada</span>
    </multiselect>
</template>

<script>
    import Locality from "../../../models/Locality";

    export default {
        name: "LocalitySelect",
        props: ['value', 'service-group'],
        data() {
            return {
                localities: []
            }
        },
        watch: {
            serviceGroup: function() {
                this.load()
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            async load() {
                const filters = this.serviceGroup
                    ? JSON.stringify({service_group_id: this.serviceGroup.id})
                    : {}

                this.localities = await Locality.all({filters})
            }
        }
    }
</script>

<style scoped>

</style>
