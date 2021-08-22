<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="tiposDeContato"
        :searchable="true"
        :close-on-select="true"
        :show-labels="false"
        id="tiposDeContato"
        label="nome"
        track-by="nome"
        placeholder="Selecione"
    >
        <span slot="noOptions">Nenhuma opção ainda</span>
        <span slot="noResult">Nenhum tipo encontrado</span>
    </multiselect>
</template>

<script>
    import TiposDeContato from "../../../domain/TiposDeContato";

    export default {
        name: "SelectTiposDeContato",
        props: ['value'],
        data() {
            return {
                tiposDeContato: []
            }
        },
        mounted() {
            this.carregarTiposDeContato();
        },
        methods: {
            carregarTiposDeContato() {
                TiposDeContato.todos().then(resposta => {
                    this.tiposDeContato = resposta.data;
                });
            }
        }
    }
</script>

<style scoped>

</style>
