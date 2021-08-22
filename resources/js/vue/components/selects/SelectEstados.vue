<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="estados"
        :searchable="true"
        :close-on-select="true"
        :show-labels="false"
        id="estados"
        label="sigla"
        track-by="sigla"
        placeholder="Estados"
    >
        <span slot="noOptions">Nenhuma opção ainda</span>
        <span slot="noResult">Nenhuma city encontrada</span>
    </multiselect>
</template>

<script>
    import Estados from "../../../domain/Estados";

    export default {
        name: "SelectEstados",
        props: ['value'],
        data() {
            return {
                estados: []
            }
        },
        mounted() {
            this.carregarEstados();
        },
        methods: {
            carregarEstados() {
                Estados.todos().then(resposta => {
                    this.estados = resposta.data;
                });
            }
        }
    }
</script>

<style scoped>

</style>
