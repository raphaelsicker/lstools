<template>
    <div>
        <vue-html2pdf
            ref="html2Pdf"
            :show-layout="false"
            :float-layout="false"
            :enable-download="false"
            :preview-modal="false"
            :manual-pagination="true"
            :html-to-pdf-options="htmlToPdfOptions"
            pdf-content-width="100%"
            @progress="onProgress">
            <section slot="pdf-content">
                <div v-for="(maps, key) in value" v-bind:key="key" class="html2pdf__page-break" style="height: 700px">
                        <div v-for="(map, keyMap) in maps" v-bind:key="keyMap" >
                            <b-row class="m-0" >
                                <b-col cols="6" class="p-1 border-gray">
                                    <b-row class="content-title p-2">
                                        <b-col sm="12">
                                            <h3 class="main-title">Cartão de Mapa de Território</h3>
                                        </b-col>
                                        <b-col sm="9">
                                            Localidade: <strong >{{map.locality}}</strong>
                                        </b-col>
                                        <b-col sm="3" class="float-right text-right">
                                            Número: <strong >{{map.serviceGroup}} {{map.order}}</strong>
                                        </b-col>
                                    </b-row>
                                    <div class="m-2 map-table">
                                        <b-row class="m-0 p-2 header" :style="{'background-color': map.color}">
                                            <b-col sm="1" class="p-0 text-center">Nº</b-col>
                                            <b-col sm="8" class="p-0">Endereço</b-col>
                                            <b-col sm="3" class="p-0 text-center">Qr Code</b-col>
                                        </b-row>
                                        <b-row
                                            v-for="(address, keyAddrees) in map.addresses"
                                            v-bind:key="keyAddrees"
                                            class="m-0 p-2"
                                            :class="(address.label % 2) ? 'odd' : 'pair'">
                                            <b-col sm="1" class="p-0 order" :style="{'color': map.color}">{{address.label}}</b-col>
                                            <b-col sm="8" class="p-0">
                                                <div class="address"> {{address.complete}} </div>
                                                <div> {{address.reference}} </div>
                                            </b-col>
                                            <b-col sm="3" class="p-0 text-center">{{address.qrcode}}</b-col>
                                        </b-row>

                                        {{map}}
                                    </div>
                                </b-col>
                                <b-col cols="6" class="grid-content border-gray">
                                    <static-map
                                        :google-api-key="apiKey"
                                        center=""
                                        :markers="map.addresses"
                                        :zoom="zoom"
                                        :size="size"
                                        :type="type"
                                        language="pt-Br"
                                        style="width: 100%; height: 100%"/>
                                </b-col>
                            </b-row>
                        </div>
                </div>
            </section>

        </vue-html2pdf>
    </div>
</template>

<script>
    import VueHtml2pdf from 'vue-html2pdf';
    import StaticMap from 'vue-static-map';
    import MainContentTitle from "../../components/MainContentTitle";

    export default {
        name: "pdf",
        components: {MainContentTitle, VueHtml2pdf, StaticMap},
        props: ['value', 'print'],
        data() {
            return {
                apiKey: 'AIzaSyAlUit4tpB1aNGRzNEQtLXf_umBlkthRQQ',
                cards: [],
                type: 'roadmap',
                zoom: 16,
                size: [800, 450],
                center: {
                    lat: -22.5127163,
                    lng: -41.918432
                },
                htmlToPdfOptions: {
                    margin: 0,
                    filename: 'Maps.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 2
                    },
                    html2canvas: {
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'a4',
                        orientation: 'landscape'
                    }
                }
            }
        },
        watch: {
            print: function(newVal) {
                if(newVal) this.makePdf()
            }
        },
        mounted() {
        },
        methods: {
            makePdf() {
                this.$refs.html2Pdf.generatePdf()
                this.$emit('printed')
            },
            getCenter(addresses) {
                return {
                    lat: addresses.reduce((t, a) => t + (a.lat * 1), 0) / addresses.length,
                    lng: addresses.reduce((t, a) => t + (a.lng * 1), 0) / addresses.length
                }
            },
            onProgress(e) {
                //console.log(e)
            }
        }
    }
</script>

<style lang="scss" scoped>
    .map-table {
        .header {
            color: #fff;
            font-weight: bold;
        }

        .order {
            text-align: center !important;
            font-weight: bold;
            font-size: 20px;
        }

        .address {
            font-weight: 500;
        }

        .odd {
            background-color: #fff;
        }

        .pair {
            background-color: #eee;
        }
    }
</style>
