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
            <b-form-input id="shortname" v-model="value.shortname" trim/>
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
    export default {
        name: "ServiceGroupFilter",
        components: {},
        data() {
            return {
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
