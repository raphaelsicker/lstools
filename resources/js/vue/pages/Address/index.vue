<template>
    <section id="main-content">
        <main-content-title title="Endereços" subTitle="Lista os Endereços do Território da Congregação"/>
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
                                new: {title: 'Novo Endereço'},
                            }"
                        />
                        <card-callout
                            v-for="item in addresses.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            :class="item.id === id ? 'active' : '' "
                            @click="updateId(item.id)">
                            <h6 >{{ item.complete }}</h6>
                            {{item.city.name}} - {{item.city.uf.uf}}
                        </card-callout>

                        <b-pagination
                            v-model="addresses.current_page"
                            :total-rows="addresses.total"
                            :per-page="addresses.per_page"
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
    import Address from "../../../models/Address";

    export default {
        name: "Address",
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
                addresses: [],
                Address: {},
                error: [],
                overlay: {
                    grid: true,
                    form: true
                },
                filter: {show: false},
                filters: {},
                url: '/maps/addresses/',
                orderBy: {'street': 'asc'}
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

                this.addresses = await Address.get({
                    filters: this.filters,
                    search: this.search,
                    page: this.addresses.current_page,
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
                    page: this.Address.current_page
                });
            },
            runSearch() {
                this.loadGrid({
                    filters: JSON.stringify(this.filters),
                    search: this.search.text,
                    page: this.Address.current_page
                });
            },
            openFilterModal() {
                this.filter.show = true
                this.search.text = ''
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>
