<template>
    <section id="main-content">
        <main-content-title title="Cartões" subTitle="Lista os Cartões de Mapas da Congregação"/>
        <div class="inner-content">
            <b-row>
                <b-col lg="4" class="grid-content">
                    <b-overlay :show="overlay.grid" class="grid-box">
                        <grid-filter
                            @filterClick="openFilterModal"
                            @newClick="updateId(null)"
                            @searchClick="runSearch"
                            :opt="{
                                search: search,
                                filter: {title: 'Filtros'},
                                new: {title: 'Novo Cartão'},
                            }"
                        />
                        <card-callout
                            v-for="item in locality.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            :class="item.id === id ? 'active' : '' "
                            @click="updateId(item.id)">
                                <h6 >{{item.name}}</h6>
                                Cartões: {{item.cards.length}}
                        </card-callout>

                        <b-pagination
                            v-model="locality.current_page"
                            :total-rows="locality.total"
                            :per-page="locality.per_page"
                            @input="loadGrid"
                            align="center"
                        />

                      {{ error.message }}
                    </b-overlay>
                </b-col>
                <b-col lg="8">
                    <b-overlay :show="overlay.form" class="grid-box">
                        <uf-edit v-model="id" v-on:reloadGrid="runSearch"/>
                    </b-overlay>
                </b-col>
            </b-row>
            <uf-filter
                v-model="filters"
                :show="filter.show"
                @reloadGrid="runFilter"
                @clear="clearFilter"
                @hide="filter.show = false" />
        </div>
    </section>

</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import CardCallout from "../../components/CardCallout";
    import GridFilter from "../../components/GridFilter";

    import UfFilter from "./filter"
    import UfEdit from "./edit";
    import MainContentTitle from "../../components/MainContentTitle";
    import Locality from "../../../models/Locality";

    export default {
        name: "Cards",
        components: {
            UfEdit,
            UfFilter,
            MainContentTitle,
            GridFilter,
            CardCallout,
            ContentTitle
        },
        data() {
            return {
                id: this.$route.params.id || null,
                search: {text: ''},
                locality: [],
                ServiceGroup: {},
                error: [],
                overlay: {
                    grid: true,
                    form: true
                },
                filter: {show: false},
                filters: {},
                url: '/maps/cards/',
                orderBy: {'name': 'asc'}
            }
        },
        mounted() {
            this.loadGrid()
        },
        watch: {
            id: function (newVal) {
                this.updateHistory(newVal ?? '')
            }
        },
        methods: {
            updateHistory(id = '') {
                history.pushState({}, null, this.url + id);
            },
            updateId(id) {
                this.id = id
            },
            async loadGrid(params = {}) {
                this.id = this.$route.params.id || null
                this.overlay.grid = true;

                this.locality = await Locality.get({
                    filters: this.filters,
                    search: this.search,
                    page: this.locality.current_page,
                    per_page: this.perPage,
                    orderBy: JSON.stringify(this.orderBy),
                    ...params,
                })

                this.overlay.grid = false
                this.overlay.form = false
            },
            clearFilter() {
                this.filters = {}
                this.runFilter()
            },
            runFilter() {
                this.loadGrid({filters: JSON.stringify(this.filters)});
            },
            paginate() {
                this.loadGrid({
                    search: this.search.text,
                    page: this.locality.current_page
                });
            },
            runSearch() {
                this.loadGrid({
                    filters: JSON.stringify(this.filters),
                    search: this.search.text,
                    page: this.locality.current_page
                });
            },
            openFilterModal() {
                this.filter.show = true
                this.search.text = ''
            },
            // Cria as bordas para os swatches caso a cor seja muito clara
            getSwatchesBorder(color = null) {
                if(!color)
                    return 'none'

                const red = parseInt(color[1], 16)
                const blue = parseInt(color[3], 16)
                const green = parseInt(color[5], 16)

                if(red > 11 && blue > 11 && green > 11)
                    return '1px solid #ccc'

                return 'none'
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>
