<template>
    <section id="main-content">
        <content-title title="Bairros" subTitle="Lista os bairros cadastrados pela congregação"/>
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
                                new: {title: 'Novo Bairro'},
                            }"
                        />
                        <card-callout
                            v-for="item in bairros.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            @click="carregarForm(item.id)"
                        >
                            <h6>{{item.nome}}</h6>
                            {{item.cidade.nome}} - {{item.cidade.estado.sigla}}
                        </card-callout>

                        <b-pagination
                            v-model="bairros.current_page"
                            :total-rows="bairros.total"
                            :per-page="bairros.per_page"
                            @change="paginar"
                            align="center"
                        />

                        {{error.message}}
                    </b-overlay>
                </b-col>
                <b-col lg="8" class="form-content">
                    <b-overlay :show="overlay.form" class="grid-box">
                        <editar-bairro
                            :bairro="bairro"
                            v-on:recarregarGrid="pesquisar"
                        />
                    </b-overlay>
                </b-col>
            </b-row>
            <filtro-bairro
                :filtro="filtro"
                :filtros="filtros"
                @filtrar="filtrar"/>
        </div>
    </section>
</template>

<script>
    import EditarBairro from "./edit";
    import FiltroBairro from "./filter";

    import ContentTitle from "../../components/ContentTitle";
    import Bairros from "../../../domain/Bairros";
    import CardCallout from "../../components/CardCallout";
    import GridFilter from "../../components/GridFilter";

    export default {
        name: "Bairros",
        components: {
            FiltroBairro,
            GridFilter,
            EditarBairro,
            CardCallout,
            ContentTitle
        },
        data() {
            return {
                id: this.$route.params.id || null,
                pesquisa: {text: ''},
                bairros: [],
                bairro: null,
                erro: [],
                overlay: {
                    grid: true,
                    form: true
                },
                filtro: {exibir: false},
                filtros: {},
                url: '/cadastros/bairros/'
            }
        },
        created() {
            this.bairro = new Bairros();
            this.carregarGrid();
            this.carregarForm(this.id);
        },
        methods: {
            atribuir(bairro = []) {
                for(let campo in bairro) {
                    this.bairro[campo] = bairro[campo] ?? null;
                }
                this.atualizarUrl(bairro.id);
            },
            atualizarUrl(caminhoRelativo = '') {
                history.pushState({}, null, this.url + caminhoRelativo);
            },
            novaSaida() {
                this.bairro = new Bairros();
                this.atualizarUrl();
            },
            carregarGrid(filters = '') {
                this.overlay.grid = true;
                console.log(filtros);

                this.bairro.listar(filtros)
                    .then(reposta => {
                        this.bairros = reposta.data;
                        this.overlay.grid = false;
                    })
                    .catch(error => this.erro = erro)
            },
            carregarForm(bairroId) {
                if(!bairroId) {
                    return setTimeout(
                        () => this.overlay.form = false,
                        500
                    );
                }

                this.overlay.form = true;

                this.bairro.encontrar(bairroId)
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
