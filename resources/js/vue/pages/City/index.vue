<template>
    <section id="main-content">
        <content-title title="Cidades" subTitle="Lista as cidades"/>
        <div class="inner-content">
            <b-row>
                <b-col lg="4" class="grid-content">
                    <b-overlay :show="overlay.grid" class="grid-box">
                        <grid-filter
                            @filterClick="abrirModalFiltros"
                            @newClick="newCity"
                            @searchClick="runSearch"
                            :opt="{
                                search: search,
                                filter: {title: 'Filtros'},
                                new: {title: 'Nova Cidade'},
                            }"
                        />
                        <card-callout
                            v-for="item in cities.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            @click="loadForm(item.id)"
                        >
                            <h6>{{item.name}}</h6>
                            {{item.uf.name}} ({{item.uf.uf}})
                        </card-callout>

                        <b-pagination
                            v-model="cities.current_page"
                            :total-rows="cities.total"
                            :per-page="cities.per_page"
                            @change="paginate"
                            align="center"
                        />

                      {{ error.message }}
                    </b-overlay>
                </b-col>
                <b-col lg="8" class="form-content">
                    <b-overlay :show="overlay.form" class="grid-box">
                        <city-edit v-on:recarregarGrid="search"/>
                    </b-overlay>
                </b-col>
            </b-row>
            <filtro-cidade
                :filtro="filter"
                :filtros="filters"
                @filtrar="runFilter"/>

        </div>
    </section>

</template>

<script>
    import CityEdit from "./edit";
    import FiltroCidade from "./filter";

    import ContentTitle from "../../components/ContentTitle";
    import CardCallout from "../../components/CardCallout";
    import GridFilter from "../../components/GridFilter";
    import City from "../../../models/City";

    export default {
        name: "Cities",
        components: {
            FiltroCidade,
            GridFilter,
            CityEdit,
            CardCallout,
            ContentTitle
        },
        data() {
            return {
                id: this.$route.params.id || null,
                search: {text: ''},
                cities: [],
                city: {},
                error: [],
                overlay: {
                    grid: true,
                    form: true
                },
                filter: {show: false},
                filters: {},
                url: '/cities/'
            }
        },
        mounted() {
            this.loadGrid()
        },
        methods: {
            updateHistory(id = '') {
                history.pushState({}, null, this.url + id);
            },
            newCity() {
                this.city = null
                this.updateHistory();
            },
            async loadGrid(params = {}) {
                this.overlay.grid = true;

                this.cities = await City.get({
                    search: this.search,
                    page: this.page,
                    per_page: this.perPage,
                    ...params,
                })
                this.overlay = false
            },
            runFilter() {
              alert('teste');
                if(this.filters.uf) {
                    this.filters.uf_id = this.filters.uf.id;
                }
                console.log(this.filters);

                this.loadGrid({filters: JSON.stringify(this.filters)});
                this.filters = {};
            },
            paginate(page) {
                this.loadGrid({
                    search: this.search.text,
                    page: page
                });
            },
            runSearch() {
                this.loadGrid({search: this.search.text});
            },
            abrirModalFiltros() {
                this.filter.show = true;
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>
