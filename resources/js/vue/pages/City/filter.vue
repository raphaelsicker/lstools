<template>
    <b-modal
        v-model="showFilter"
        title="Filtro :: Cidades"
        cancel-title="Cancelar"
        ok-title="Filtrar"
        @ok="reloadGrid"
        @filtrar="reloadGrid"
        @hide="hideFilter"
    >
        <b-form-group
            id="fieldset-uf"
            label="UF"
            label-for="uf">
            <uf-select v-model="uf" @input="value.uf_id = uf.id"/>
        </b-form-group>
        <b-form-group
            id="fieldset-nome"
            label="Nome"
            label-for="name">
            <b-form-input id="name" v-model="value.name" trim/>
            <b-form-input id="id" v-model="value.uf_id" trim/>
        </b-form-group>
    </b-modal>
</template>

<script>
    import UfSelect from "../Uf/select";
    export default {
        name: "CityFilter",
        components: {
            UfSelect
        },
        data() {
            return {
                uf: {},
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
            }
        }
    }
</script>

<style scoped>

</style>
