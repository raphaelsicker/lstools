<template>
    <b-modal
        v-model="showPrinter"
        title="Impressão de Cartões de Mapas de Território"
        cancel-title="Cancelar"
        ok-title="Imprimir"
        @ok="print"
        @hide="hideFilter"
        @cancel="clearFilter">
        <b-form-group
            id="fieldset-service-group"
            label="Saída de Campo"
            label-for="service-group">
            <service-group-select
                v-model="serviceGroup"
                @input="onChangeServiceGroup"/>
        </b-form-group>
        <b-form-group
            id="fieldset-locality"
            label="Localidade"
            label-for="locality">
            <locality-select
                v-model="locality"
                :service-group="serviceGroup"
                @input="onChangeLocality"/>
        </b-form-group>
        <b-form-group
            id="fieldset-card"
            label="Cartão"
            label-for="card">
            <card-select
                v-model="card"
                :locality="locality"/>
        </b-form-group>

        Filter: {{locality}}
    </b-modal>
</template>

<script>
    import ServiceGroupSelect from "../ServiceGroup/select";
    import LocalitySelect from "../Locality/select";
    import CardSelect from "./select";
    import Locality from "../../../models/Locality";
    import Card from "../../../models/Card";

    export default {
        name: "CardPrinter",
        components: {CardSelect, LocalitySelect, ServiceGroupSelect},
        data() {
            return {
                showPrinter: false,
                serviceGroup: {},
                locality: {},
                card: {}
            }
        },
        props: ['show'],
        watch: {
            show: function(newValue) {
                this.showPrinter = newValue
            }
        },
        methods: {
            hideFilter() {
                this.$emit('hide')
            },
            clearFilter() {
                this.$emit('clear')
            },
            onChangeServiceGroup() {
                this.locality = Locality.new()
                this.card = Card.new()
            },
            onChangeLocality() {
                this.card = Card.new()
            },
            print() {
                alert('teste')
            }
        }
    }
</script>

<style scoped>

</style>
