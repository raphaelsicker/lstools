<template>
    <div class="grid-filter">
        <b-input-group>
            <b-form-input type="text" v-model="opt.search.text"/>
            <b-input-group-append>
                <b-button
                    v-b-popover.hover.top="opt.search.title"
                    @click="searchClick">
                    <i class="fas fa-search"></i>
                </b-button>
            </b-input-group-append>
        </b-input-group>
        <div class="filters-append">
            <b-button
                v-b-popover.hover.top="opt.filter.title"
                @click="filterClick">
                <i class="fas fa-filter"></i>
            </b-button>
        </div>
        <div class="filters-append">
            <b-button
                v-b-popover.hover.top="opt.new.title"
                @click="newClick"
            ><i class="fas fa-plus"></i></b-button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GridFilter",
        props: {
            opt: {
                type: Object,
                default: function () {
                    return {
                        filter: {title: "Filtros"},
                        new: {title: "Novo"},
                        search: {
                            val: '',
                            title: "Pesquisar"
                        }
                    }
                }
            },
        },
        methods: {
            filterClick() {
                this.$emit('filterClick');
            },
            newClick() {
                this.$emit('newClick');
            },
            searchClick() {
                this.$emit('searchClick');
            },
        }
    }
</script>

<style scoped>

</style>
