<template>
    <multiselect
        v-bind:value="value"
        @input="$emit('input', $event)"
        :options="bairros"
        :searchable="true"
        :close-on-select="true"
        :clear-on-select="true"
        :preserve-search="true"
        :show-labels="false"
        :loading="carregando"
        id="bairros"
        label="nome"
        placeholder="Pesquise um bairro"
        @search-change="carregar"
    >
        <span slot="noOptions">Selecione uma Cidade</span>
        <span slot="noResult">Nenhuma city encontrada</span>
    </multiselect>
</template>

<script>
    import Bairros from "../../../domain/Bairros";

    export default {
        name: "SelectBairros",
        props: ['value', 'cidade'],
        data() {
            return {
                bairros: [],
                carregando: false
            }
        },
        watch: {
           cidade() {
               this.carregar()
           }
        },
        methods: {
            carregar(search = '') {
                this.carregando = true;

                if(!this.cidade || !this.cidade.id) {
                    this.carregando = false;
                    this.bairros = [];
                    return;
                }

                return Bairros.todos({
                    filtros:  JSON.stringify({cidade_id: this.cidade.id}),
                    pesquisa: pesquisa
                }).then(resposta => {
                    this.bairros = resposta.data;
                    this.carregando = false;
                });
            },
        }
    }
</script>

<style scoped>

</style>
