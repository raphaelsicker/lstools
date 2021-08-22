<template>
    <b-modal
        v-model="filtro.exibir"
        title="Filtro :: Cidades"
        cancel-title="Cancelar"
        ok-title="Filtrar"
        @ok="filtrar"
        @filtrar="filtrar"
    >
        <b-form-group
            id="fieldset-estado"
            label="Estado"
            label-for="estado"
        >
            <select-estados v-model="filtros.estado"/>
        </b-form-group>
        <b-form-group
            id="fieldset-nome"
            label="Nome"
            label-for="nome"
        >
            <b-form-input id="nome" v-model="filtros.nome" trim/>
        </b-form-group>
    </b-modal>
</template>

<script>
    import SelectEstados from "../../components/selects/SelectEstados";
    export default {
        name: "FiltroCidade",
        components: {SelectEstados},
        props: {
            filtro: {
                required: true,
                type: Object
            },
            filtros: {
                required: true,
                type: Object
            },
        },
        methods: {
            filtrar() {
                this.$emit('filtrar');
            }
        }
    }
</script>

<style scoped>

</style>
