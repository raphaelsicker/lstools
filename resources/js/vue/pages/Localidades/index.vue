<template>
    <section id="main-content">
        <content-title title="Localidades" subTitle="Lista as localidades da Congregação"/>
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
                                new: {title: 'Nova Localidade'},
                            }"
                        />
                        <card-callout
                            v-for="item in localidades.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            @click="carregarForm(item.id)"
                        >
                            <h6>{{item.nome}} <small>({{item.bairro.nome}})</small></h6>
                            {{item.bairro.cidade.nome}} - {{item.bairro.cidade.estado.sigla}}
                        </card-callout>

                        <b-pagination
                            v-model="localidades.current_page"
                            :total-rows="localidades.total"
                            :per-page="localidades.per_page"
                            @change="paginar"
                            align="center"
                        />

                        {{error.message}}
                    </b-overlay>
                </b-col>
                <b-col lg="8" class="form-content">
                    <b-overlay :show="overlay.form" class="grid-box">
                        <editar-localidade
                            :localidade="localidade"
                            v-on:recarregarGrid="pesquisar"
                        />
                    </b-overlay>
                </b-col>
            </b-row>
            <filtro-localidade
                :filtro="filtro"
                :filtros="filtros"
                @filtrar="filtrar"/>
        </div>
    </section>
</template>

<script>
    import EditarLocalidade from "./edit";
    import FiltroLocalidade from "./filter";

    import ContentTitle from "../../components/ContentTitle";
    import Localidades from "../../../domain/Localidades";
    import CardCallout from "../../components/CardCallout";
    import GridFilter from "../../components/GridFilter";

    export default {
        name: "Localidades",
        components: {
            FiltroLocalidade,
            GridFilter,
            EditarLocalidade,
            CardCallout,
            ContentTitle
        },
        data() {
            return {
                id: this.$route.params.id || null,
                pesquisa: {text: ''},
                localidades: [],
                localidade: {},
                erro: [],
                overlay: {
                    grid: true,
                    form: true
                },
                filtro: {exibir: false},
                filtros: {},
                url: '/cadastros/localidades/'
            }
        },
        created() {
            this.localidade = new Localidades();
            this.carregarGrid();
            this.carregarForm(this.id);
        },
        methods: {
            atribuir(localidade = []) {
                for(let campo in localidade) {
                    this.localidade[campo] = localidade[campo] ?? null;
                }
                this.atualizarUrl(localidade.id);
            },
            atualizarUrl(caminhoRelativo = '') {
                history.pushState({}, null, this.url + caminhoRelativo);
            },
            novaSaida() {
                this.localidade = new Localidades();
                this.atualizarUrl();
            },
            carregarGrid(filters = '') {
                this.overlay.grid = true;
                console.log(filtros);

                this.localidade.listar(filtros)
                    .then(reposta => {
                        this.localidades = reposta.data;
                        this.overlay.grid = false;
                    })
                    .catch(error => this.erro = erro)
            },
            carregarForm(localidadeId) {
                if(!localidadeId) {
                    return setTimeout(
                        () => this.overlay.form = false,
                        500
                    );
                }

                this.overlay.form = true;

                this.localidade.encontrar(localidadeId)
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
