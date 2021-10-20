<template>
    <section id="main-content">
        <main-content-title title="Estados" subTitle="Lista os estados"/>
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
                                new: {title: 'Novo Estado'},
                            }"
                        />
                        <card-callout
                            v-for="item in ufs.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            :class="item.id === id ? 'active' : '' "
                            @click="updateId(item.id)">
                            <h6 style="display: inline-block">{{item.name}}</h6> ({{item.uf}})
                        </card-callout>

                        <b-pagination
                            v-model="ufs.current_page"
                            :total-rows="ufs.total"
                            :per-page="ufs.per_page"
                            @input="loadGrid"
                            align="center"
                        />

                      {{ error.message }}
                    </b-overlay>
                </b-col>
                <b-col lg="8" class="form-content">
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
    import Uf from "../../../models/Uf";

    export default {
        name: "Ufs",
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
                ufs: [],
                uf: {},
                error: [],
                overlay: {
                    grid: true,
                    form: true
                },
                filter: {show: false},
                filters: {},
                url: '/forms/ufs/',
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

                this.ufs = await Uf.get({
                    filters: this.filters,
                    search: this.search,
                    page: this.ufs.current_page,
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
                    page: this.uf.current_page
                });
            },
            runSearch() {
                this.loadGrid({
                    filters: JSON.stringify(this.filters),
                    search: this.search.text,
                    page: this.uf.current_page
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
