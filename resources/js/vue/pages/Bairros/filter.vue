<template>
    <b-modal
        v-model="filtro.exibir"
        title="Filtro :: Saídas de Campo"
        cancel-title="Cancelar"
        ok-title="Filtrar"
        @ok="filtrar"
        @filtrar="filtrar"
    >
        <b-form-group
            id="fieldset-sigla"
            label="Número"
            label-for="sigla"
        >
            <b-form-input id="sigla" v-model="filtros.sigla" trim/>
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
    export default {
        name: "FiltroBairro",
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
