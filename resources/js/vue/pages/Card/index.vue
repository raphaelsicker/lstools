<template>
    <section id="main-content">
        <main-content-title title="Cartões" subTitle="Lista os Cartões de Mapas da Congregação"/>
        <div class="inner-content">
            <b-row>
                <b-col lg="3" class="grid-content">
                    <b-overlay :show="overlay.grid" class="grid-box">
                        <grid-filter
                            @newClick="updateId(null)"
                            :opt="{
                                search: search,
                                filter: {show: false},
                                new: {title: 'Novo Cartão'}
                            }">
                            <service-group-select
                                v-model="service_group_filter"
                                @input="runFilter"
                            />
                            <div class="filters-append">
                                <b-button
                                    v-b-popover.hover.top="'Imprimir'"
                                    @click="goPrinter">
                                    <font-awesome-icon icon="fa-solid fa-print" />
                                </b-button>
                            </div>
                        </grid-filter>
                        <card-callout
                            v-for="item in localities.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            :class="item.id === id ? 'active' : '' "
                            @click="updateId(item.id)">
                            <div>
                                <strong>{{item.name}}</strong>
                                ({{item.service_group.shortname}})
                            </div>
                            <div>Cartões: {{item.cards_length}}</div>
                        </card-callout>

                        <b-pagination
                            v-model="localities.current_page"
                            :total-rows="localities.total"
                            :per-page="localities.per_page"
                            @input="loadGrid"
                            align="center"
                        />

                      {{ error.message }}
                    </b-overlay>
                </b-col>
                <b-col lg="9">
                    <b-overlay :show="overlay.form" class="grid-box">
                        <edit v-model="id" v-on:reloadGrid="runSearch"/>
                    </b-overlay>
                </b-col>
            </b-row>
            <printer :show="printer.show" @hide="printer.show = false"/>
        </div>
    </section>

</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import CardCallout from "../../components/CardCallout";
    import GridFilter from "../../components/GridFilter";

    import Edit from "./edit";
    import MainContentTitle from "../../components/MainContentTitle";
    import Locality from "../../../models/Locality";
    import ServiceGroupSelect from "../ServiceGroup/select";

    export default {
        name: "Cards",
        components: {
            ServiceGroupSelect,
            Edit,
            MainContentTitle,
            GridFilter,
            CardCallout,
            ContentTitle
        },
        data() {
            return {
                id: this.$route.params.id || null,
                search: {text: ''},
                localities: [],
                ServiceGroup: {},
                error: [],
                overlay: {
                    grid: true,
                    form: true
                },
                printer: {show: false},
                url: '/maps/cards/',
                orderBy: {'name': 'asc'},
                service_group_filter: {}
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

                this.localities = await Locality.get({
                    filters: this.filters,
                    search: this.search,
                    page: this.localities.current_page,
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
                let filters = this.service_group_filter
                    ? {service_group_id: this.service_group_filter.id}
                    : {}

                this.loadGrid({filters: JSON.stringify(filters)});
            },
            paginate() {
                this.loadGrid({
                    search: this.search.text,
                    page: this.localities.current_page
                });
            },
            runSearch() {
                this.loadGrid({
                    filters: JSON.stringify(this.filters),
                    search: this.search.text,
                    page: this.localities.current_page
                });
            },
            goPrinter() {
                this.$router.push('/maps/printer')
            },
        }
    }
</script>

<style lang="scss" scoped>
</style>
