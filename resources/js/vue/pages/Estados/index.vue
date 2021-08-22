<template>
    <section id="main-content">
        <content-title
            title="Estados"
            subTitle="Cadastros / Estados"/>

        <div class="inner-content">
            <b-row>
                <b-card>
                    <b-overlay :show="overlay" class="grid-box">
                        <b-row class="table">
                            <b-col lg="4" class="grid-filter">
                                <b-input-group>
                                    <b-form-input type="text" v-model="search"/>
                                    <b-input-group-append>
                                        <b-button
                                            v-b-popover.hover.top="'Filtro de Estados'"
                                            @click="searchClick">
                                            <i class="fas fa-search"></i>
                                        </b-button>
                                    </b-input-group-append>
                                </b-input-group>
                            </b-col>
                        </b-row>

                        <b-table
                            :items="items"
                            :fields="fields"
                            striped
                            hover
                            responsive="sm"
                            @row-clicked="rowClicked"
                        ></b-table>
                    </b-overlay>

                    <b-pagination
                        v-model="results.current_page"
                        :total-rows="results.total"
                        :per-page="results.per_page"
                        @change="paginate"
                    />
                </b-card>

                <pre>{{clicado}}</pre>
            </b-row>
        </div>

    </section>
</template>

<script>
import ContentTitle from "../../components/ContentTitle";
import Estado from "../../../models2/Estado";
import GridFilter from "../../components/GridFilter";
export default {
    name: "Estados",
    components: {GridFilter, ContentTitle},
    data() {
        return {
            fields: [
                {
                    key: 'sigla',
                    label: 'Sigla',
                    sortable: true
                },
                {
                    key: 'nome',
                    label: 'Nome',
                    sortable: true
                }
            ],
            page: 1,
            search: '',
            overlay: true,
            items: [],
            results: {},
            clicado: null
        }
    },
    created() {
        this.load();
    },
    methods: {
        async load(params = {}) {
            this.overlay = true;

            this.results = await Estado.get({
                search: this.search,
                page: this.page,
                per_page: params.perPage,
                ...params,
            })

            this.items = this.results.data
            this.overlay = false
        },

        paginate(page) {
            this.page = page
            this.load()
        },

        searchClick() {
            this.load()
        },

        rowClicked(data) {
            this.$router.push({
                name: 'cadastros.estados.edit',
                params: { id: data.id}
            })
        }
    }
}
</script>

<style scoped>
</style>
