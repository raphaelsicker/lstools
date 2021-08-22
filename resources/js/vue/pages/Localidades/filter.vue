<template>
    <b-modal
        v-model="filtro.exibir"
        size="lg"
        title="Filtro :: Localidades"
        cancel-title="Cancelar"
        ok-title="Filtrar"
        @ok="filtrar"
        @filtrar="filtrar"
    >
        <b-col md="2" class="form-field">
            <b-form-group
                id="fieldset-estado"
                label="Estado"
                label-for="estado"
            >
                <select-estados v-model="filtro.estado"/>
            </b-form-group>
        </b-col>
        <b-col md="5" class="form-field">
            <b-form-group
                id="fieldset-cidade"
                label="Cidade"
                label-for="city">
                <select-cidades
                    v-model="filtro.cidade"
                    v-bind:estado="filtro.estado"
                />
            </b-form-group>
        </b-col>
        <b-col md="5" class="form-field">
            <b-form-group
                id="fieldset-bairro"
                label="Bairro"
                label-for="bairro">

                <select-bairros
                    v-model="filtro.bairro"
                    v-bind:cidade="filtro.cidade"
                />
            </b-form-group>
        </b-col>
        <b-col md="2" class="form-field">
            <b-form-group
                id="fieldset-numero"
                label="Número"
                label-for="numero">
                <b-form-input id="numero" v-model="filtro.numero" trim/>
            </b-form-group>
        </b-col>
        <b-col md="10" class="form-field">
            <b-form-group
                id="fieldset-nome"
                label="Nome"
                label-for="nome">
                <b-form-input id="nome" v-model="filtro.nome" trim/>
            </b-form-group>
        </b-col>
    </b-modal>
</template>

<script>

    import SelectBairros from "../../components/selects/SelectBairros";
    import SelectCidades from "../../components/selects/SelectCidades";
    import SelectEstados from "../../components/selects/SelectEstados";

    export default {
        name: "FiltroLocalidade",
        components: {SelectBairros, SelectCidades, SelectEstados},
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
