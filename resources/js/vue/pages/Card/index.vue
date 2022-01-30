<template>
    <section id="main-content">
        <main-content-title title="Saídas de Campo" subTitle="Lista os grupos de Saída de Campo"/>
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
                                new: {title: 'Nova Saída de Campo'},
                            }"
                        />
                        <card-callout
                            v-for="item in serviceGroups.data"
                            v-bind:key="item.id"
                            class="callout-default"
                            :class="item.id === id ? 'active' : '' "
                            @click="updateId(item.id)">
                            <b-row>
                                <b-col md="2" class="float-left">
                                    <div class="callout-color-circle" :style="{
                                        'background-color': item.color,
                                         border: getSwatchesBorder(item.color)
                                    }"/>
                                </b-col>
                                <b-col md="10" >
                                    <h6 >{{item.name}}</h6> {{item.shortname}}
                                </b-col>
                            </b-row>
                        </card-callout>

                        <b-pagination
                            v-model="serviceGroups.current_page"
                            :total-rows="serviceGroups.total"
                            :per-page="serviceGroups.per_page"
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
    import ServiceGroup from "../../../models/ServiceGroup";

    export default {
        name: "ServiceGroups",
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
                serviceGroups: [],
                ServiceGroup: {},
                error: [],
                overlay: {
                    grid: true,
                    form: true
                },
                filter: {show: false},
                filters: {},
                url: '/forms/service-groups/',
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

                this.serviceGroups = await ServiceGroup.get({
                    filters: this.filters,
                    search: this.search,
                    page: this.serviceGroups.current_page,
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
                    page: this.ServiceGroup.current_page
                });
            },
            runSearch() {
                this.loadGrid({
                    filters: JSON.stringify(this.filters),
                    search: this.search.text,
                    page: this.ServiceGroup.current_page
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
