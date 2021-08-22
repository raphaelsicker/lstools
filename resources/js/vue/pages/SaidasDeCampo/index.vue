<template>
    <section id="main-content">
        <content-title title="Saídas de Campo" subTitle="Teste de Subtítulo"/>
        <div class="inner-content">
            <b-row>
                <b-col lg="4" class="grid-content">
                    <b-overlay :show="overlay.grid" class="grid-box">
                        <grid-filter
                            @filterClick="abrirModalFiltros"
                            @newClick="novaSaida"
                            @searchClick="pesquisar"
                            :opt="{
                                search: pesquisa,
                                filter: {title: 'Filtros'},
                                new: {title: 'Nova Saída de Campo'},
                            }"
                        />
                        <card-callout
                            v-for="item in saidas.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            @click="carregarForm(item.id)"
                        >
                            <h6>{{item.sigla}}</h6>
                            {{item.nome}}
                        </card-callout>

                        <b-pagination
                            v-model="saidas.current_page"
                            :total-rows="saidas.total"
                            :per-page="saidas.per_page"
                            @change="paginar"
                            align="center"
                        />

                        {{error.message}}
                    </b-overlay>
                </b-col>
                <b-col lg="8" class="form-content">
                    <b-overlay :show="overlay.form" class="grid-box">
                        <editar-saida-de-campo
                            :saida="saida"
                            v-on:recarregarGrid="pesquisar"
                        />
                    </b-overlay>
                </b-col>
            </b-row>
            <filtro-saida-de-campo
                :filtro="filtro"
                :filtros="filtros"
                @filtrar="filtrar"/>
        </div>
    </section>
</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import SaidasDeCampo from "../../../domain/SaidasDeCampo";
    import CardCallout from "../../components/CardCallout";
    import EditarSaidaDeCampo from "./edit";
    import GridFilter from "../../components/GridFilter";
    import FiltroSaidaDeCampo from "./filter";

    export default {
        name: "SaidasDeCampo",
        components: {
            FiltroSaidaDeCampo,
            GridFilter,
            EditarSaidaDeCampo,
            CardCallout,
            ContentTitle
        },
        data() {
            return {
                id: this.$route.params.id || null,
                pesquisa: {text: ''},
                saidas: [],
                saida: null,
                erro: [],
                overlay: {
                    grid: true,
                    form: true
                },
                filtro: {exibir: false},
                filtros: {},
                url: '/pregacao/saidas_de_campo/'
            }
        },
        created() {
            this.saida = new SaidasDeCampo();
            this.carregarGrid();
            this.carregarForm(this.id);
        },
        methods: {
            atribuir(saida) {
                for(let campo in saida) {
                    this.saida[campo] = saida[campo] ?? null;
                }
                this.atualizarUrl(saida.id);
            },
            atualizarUrl(caminhoRelativo = '', params = '') {
                history.pushState({}, null, this.url + caminhoRelativo);
            },
            novaSaida() {
                this.saida = new SaidasDeCampo();
                this.atualizarUrl();
            },
            carregarGrid(filters = '') {
                this.overlay.grid = true;

                this.saida.listar(filtros)
                    .then(reposta => {
                        this.saidas = reposta.data;
                        this.overlay.grid = false;
                    })
                    .catch(error => this.erro = erro)
            },
            carregarForm(saidaId) {
                if(!saidaId) {
                    return setTimeout(
                        () => this.overlay.form = false,
                        500
                    );
                }

                this.overlay.form = true;

                this.saida.encontrar(saidaId)
                    .then(reposta => {
                        this.atribuir(reposta.data);
                        this.overlay.form = false;
                    })
                    .catch(error => this.erro = erro)
            },
            filtrar() {
                console.log(this.filtros);
                this.carregarGrid({filtros: JSON.stringify(this.filtros)});
                this.filtros = {};
            },
            paginar(paginacao) {
                this.carregarGrid({
                    pesquisa: this.pesquisa.text,
                    page: paginacao
                });
            },
            pesquisar() {
                this.carregarGrid({pesquisa: this.pesquisa.text});
            },
            abrirModalFiltros() {
                this.filtro.exibir = true;
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>
