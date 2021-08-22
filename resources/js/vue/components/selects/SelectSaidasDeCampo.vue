<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="saidasDeCampo"
        :searchable="true"
        :close-on-select="true"
        :show-labels="false"
        id="saidasDeCampo"
        label="nome"
        track-by="nome"
        placeholder="Selecione"
    >
        <span slot="noOptions">Nenhuma opção ainda</span>
        <span slot="noResult">Nenhuma city encontrada</span>
    </multiselect>
</template>

<script>
    import SaidasDeCampo from "../../../domain/SaidasDeCampo";

    export default {
        name: "SelectSaidasDeCampo",
        props: ['value'],
        data() {
            return {
                saidasDeCampo: []
            }
        },
        mounted() {
            this.carregarSaidasDeCampo();
        },
        methods: {
            carregarSaidasDeCampo() {
                SaidasDeCampo.todos().then(resposta => {
                    this.saidasDeCampo = resposta.data;
                });
            }
        }
    }
</script>

<style scoped>

</style>
