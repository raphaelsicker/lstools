<template>
    <section id="main-content">
        <main-content-title title="Cartões" subTitle="Lista os Cartões de Mapas da Congregação Impressão"/>
        <div class="inner-content">
            <b-row class="mt-3">
                <b-col>
                    <b-overlay :show="false" class="grid-box">
                        <b-card>
                            <card-title
                                title="Impressão"
                                subTitle="Selecione os filtros para imprimir"/>
                            <b-row>
                                <b-col md="4" class="form-field">
                                    <b-form-group
                                        id="fieldset-service-group"
                                        label="Saída de Campo"
                                        label-for="service-group">
                                        <service-group-select
                                            v-model="serviceGroup"
                                            @input="onChangeServiceGroup"/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="4" class="form-field">
                                    <b-form-group
                                        id="fieldset-locality"
                                        label="Localidade"
                                        label-for="locality">
                                        <locality-select
                                            v-model="locality"
                                            :service-group="serviceGroup"
                                            @input="onChangeLocality"/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="4" class="form-field">
                                    <b-form-group
                                        id="fieldset-card"
                                        label="Cartão"
                                        label-for="card">
                                        <card-select
                                            v-model="card"
                                            :locality="locality"/>
                                    </b-form-group>
                                </b-col>
                                <pdf v-model="maps" :print="print" v-on:printed="print = false"/>
                            </b-row>

                            <template v-slot:footer>
                                <b-button variant="info" @click="makePrint" style="z-index: 9999">Imprimir</b-button>
                            </template>
                        </b-card>

                    </b-overlay>
                </b-col>
            </b-row>
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
    import CardTitle from "../../components/CardTitle";
    import LocalitySelect from "../Locality/select";
    import CardSelect from "./select";
    import Card from "../../../models/Card";
    import Pdf from "./pdf";

    export default {
        name: "CardsPrinter",
        components: {
            Pdf,
            CardSelect,
            LocalitySelect,
            CardTitle,
            ServiceGroupSelect,
            Edit,
            MainContentTitle,
            GridFilter,
            CardCallout,
            ContentTitle
        },
        data() {
            return {
                serviceGroup: {},
                locality: {},
                card: {},
                maps: [],
                print: false
            }
        },
        mounted() {
            this.makePrint()
        },
        methods: {
            onChangeServiceGroup() {
                this.locality = Locality.new()
                this.card = Card.new()
            },
            onChangeLocality() {
                this.card = Card.new()
            },
            async makePrint() {
                this.maps = await Card.toPrint({
                    service_group_id: this.serviceGroup.id,
                    locality_id: this.locality.id,
                    card_id: this.card.id
                })

                this.print = true
            }
        }
    }
</script>

<style lang="scss" scoped>
</style>
