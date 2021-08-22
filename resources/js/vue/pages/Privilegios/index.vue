<template>
    <section id="main-content">
        <content-title title="Privilégios" subTitle="Lista os privilégios cadastrados pela congregação"/>
        <div class="inner-content">
            <b-row>
                <b-col lg="4" class="grid-content">
                    <b-overlay :show="overlay.grid" class="grid-box">
                        <grid-filter
                            @filterClick="abrirModalFiltros"
                            @newClick="novoPrivilegio"
                            @searchClick="pesquisar"
                            :opt="{
                                search: pesquisa,
                                filter: {title: 'Filtros'},
                                new: {title: 'Novo Privilegio'},
                            }"
                        />
                        <card-callout
                            v-for="item in privilegios.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            @click="carregarForm(item.id)"
                        >
                            <h6>{{item.nome}}</h6>
                        </card-callout>

                        <b-pagination
                            v-model="privilegios.current_page"
                            :total-rows="privilegios.total"
                            :per-page="privilegios.per_page"
                            @change="paginar"
                            align="center"
                        />

                        {{error.message}}
                    </b-overlay>
                </b-col>
                <b-col lg="8" class="form-content">
                    <b-overlay :show="overlay.form" class="grid-box">
                        <editar-privilegio
                            :id="id"
                            :privilegio="privilegio"
                            :url="url"
                            v-on:recarregarGrid="pesquisar"
                        />
                    </b-overlay>
                </b-col>
            </b-row>
            <filtro-privilegio
                :filtro="filtro"
                :filtros="filtros"
                @filtrar="filtrar"/>
        </div>
    </section>
</template>

<script>
    import EditarPrivilegio from "./edit";
    import FiltroPrivilegio from "./filter";

    import ContentTitle from "../../components/ContentTitle";
    import Privilegios from "../../../domain/Privilegios";
    import CardCallout from "../../components/CardCallout";
    import GridFilter from "../../components/GridFilter";

    export default {
        name: "Privilegios",
        components: {
            FiltroPrivilegio,
            GridFilter,
            EditarPrivilegio,
            CardCallout,
            ContentTitle
        },
        data() {
            return {
                id: this.$route.params.id || 0,
                pesquisa: {text: ''},
                privilegios: [],
                privilegio: null,
                erro: [],
                overlay: {
                    grid: true,
                    form: true
                },
                filtro: {exibir: false},
                filtros: {},
                url: '/congregacao/privilegios/'
            }
        },
        created() {
            this.privilegio = new Privilegios();
            this.carregarGrid();
            this.carregarForm(this.id);
        },
        methods: {
            atribuir(privilegio = []) {
                for(let campo in privilegio) {
                    this.privilegio[campo] = privilegio[campo] || null;
                }
                this.atualizarUrl(privilegio.id);
            },
            atualizarUrl(caminhoRelativo = '') {
                history.pushState({}, null, this.url + caminhoRelativo);
            },
            novoPrivilegio() {
                this.atualizarUrl();
                this.privilegio = new Privilegios();
                this.carregarForm(0);
            },
            carregarGrid(filters = '') {
                this.overlay.grid = true;

                this.privilegio.listar(filtros)
                    .then(reposta => {
                        this.privilegios = reposta.data;
                        this.overlay.grid = false;
                    })
                    .catch(error => this.erro = erro)
            },
            carregarForm(privilegioId) {
                this.overlay.form = true;
                this.privilegio = new Privilegios();

                this.privilegio.encontrar(privilegioId)
                    .then(reposta => {
                        this.atribuir(reposta.data);
                        this.overlay.form = false;
                    })
                    .catch(error => this.erro = erro)
            },
            filtrar() {
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
