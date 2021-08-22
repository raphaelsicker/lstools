<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="cidades"
        :searchable="true"
        :close-on-select="true"
        :clear-on-select="true"
        :preserve-search="true"
        :show-labels="false"
        :loading="carregando"
        id="cidades"
        label="nome"
        placeholder="Pesquise uma city"
        @search-change="carregar"
    >
        <span slot="noOptions">Selecione um estado</span>
        <span slot="noResult">Nenhuma city encontrada</span>
    </multiselect>
</template>

<script>
    import Cidades from "../../../domain/Cidades";

    export default {
        name: "SelectCidades",
        props: ['value', 'estado'],
        data() {
            return {
                cidades: [],
                carregando: false
            }
        },
        watch: {
            estado() {
                this.carregar();
            }
        },
        methods: {
            carregar(search = '') {
                this.carregando = true;

                if(!this.estado || !this.estado.id) {
                    this.carregando = false;
                    this.cidades = [];
                    return;
                }

                return Cidades.todos({
                    filtros:  JSON.stringify({estado_id: this.estado.id}),
                    pesquisa: pesquisa
                }).then(resposta => {
                    this.cidades = resposta.data;
                    this.carregando = false;
                });
            },
        }
    }
</script>

<style scoped>

</style>
