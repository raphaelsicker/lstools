<template>
    <b-modal
        v-model="showFilter"
        title="Filtro :: Saídas de Campo"
        cancel-title="Cancelar"
        ok-title="Filtrar"
        @ok="reloadGrid"
        @hide="hideFilter"
        @cancel="clearFilter" >
        <b-form-group
            id="fieldset-shortname"
            label="Sigla"
            label-for="shortname">
            <service-group-select
                v-model="service_group"
                @input="value.service_group_id = service_group.id"
            />
        </b-form-group>
        <b-form-group
            id="fieldset-nome"
            label="Nome"
            label-for="name">
            <b-form-input id="name" v-model="value.name" trim/>
        </b-form-group>
    </b-modal>
</template>

<script>
    import ServiceGroupSelect from "../ServiceGroup/select";
    export default {
        name: "ServiceGroupFilter",
        components: {ServiceGroupSelect},
        data() {
            return {
                service_group: {},
                showFilter: false
            }
        },
        props: ['value', 'show'],
        watch: {
            show: function(newValue) {
                this.showFilter = newValue
            }
        },
        methods: {
            reloadGrid() {
                this.$emit('reloadGrid')
            },
            hideFilter() {
                this.$emit('hide')
            },
            clearFilter() {
                this.$emit('clear')
            }
        }
    }
</script>

<style scoped>

</style>
