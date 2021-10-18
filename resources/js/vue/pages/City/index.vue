<template>
    <section id="main-content">
        <main-content-title title="Cidades" subTitle="Lista as cidades"/>
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
                                new: {title: 'Nova Cidade'},
                            }"
                        />
                        <card-callout
                            v-for="item in cities.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            :class="item.id == id ? 'active' : '' "
                            @click="updateId(item.id)">
                            <h6>{{item.name}}</h6>
                            {{item.uf.name}} ({{item.uf.uf}})
                        </card-callout>

                        <b-pagination
                            v-model="cities.current_page"
                            :total-rows="cities.total"
                            :per-page="cities.per_page"
                            @input="loadGrid"
                            align="center"
                        />

                      {{ error.message }}
                    </b-overlay>
                </b-col>
                <b-col lg="8" class="form-content">
                    <b-overlay :show="overlay.form" class="grid-box">
                        <city-edit v-model="id" v-on:reloadGrid="runSearch"/>
                    </b-overlay>
                </b-col>
            </b-row>
            <city-filter
                v-model="filters"
                :show="filter.show"
                @reloadGrid="runFilter"
                @hide="filter.show = false"/>
        </div>
    </section>

</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import CardCallout from "../../components/CardCallout";
    import GridFilter from "../../components/GridFilter";
    import City from "../../../models/City";
    import CityFilter from "./filter";
    import CityEdit from "./edit";
    import MainContentTitle from "../../components/MainContentTitle";

    export default {
        name: "Cities",
        components: {
            MainContentTitle,
            CityFilter,
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
        watch: {
            id: function (newVal) {
                console.log('watch',newVal)
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

                this.cities = await City.get({
                    filters: this.filters,
                    search: this.search,
                    page: this.cities.current_page,
                    per_page: this.perPage,
                    ...params,
                })

                this.overlay.grid = false
                this.overlay.form = false
            },
            runFilter() {
                this.loadGrid({filters: JSON.stringify(this.filters)});
                this.filters = {};
            },
            paginate() {
                this.loadGrid({
                    search: this.search.text,
                    page: this.city.current_page
                });
            },
            runSearch() {
                this.loadGrid({
                    search: this.search.text,
                    page: this.city.current_page
                });
            },
            openFilterModal() {
                this.filter.show = true;
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>
