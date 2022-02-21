<template>
    <div id="">
        <div class="inner-content">
            <b-row>
                <b-col class="form-field">
                    <b-overlay :show="overlay" class="grid-box">
                        <b-card>
                            <card-title
                                title="Cadastro"
                                subTitle="Edite aqui os dados do Endereço"/>
                            <b-row>
                                <b-col md="7" class="form-field">
                                    <b-form-group
                                        id="fieldset-street"
                                        label="Endereço"
                                        label-for="street">
                                        <gmap-autocomplete
                                            :value="address.street"
                                            @place_changed="onChangeAddress"
                                            placeholder=""
                                        />
                                    </b-form-group>
                                </b-col>
                                <b-col md="2" class="form-field">
                                    <b-form-group
                                        id="fieldset-number"
                                        label="Número"
                                        label-for="number">
                                        <b-form-input id="name" v-model="address.number" trim/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="3" class="form-field">
                                    <b-form-group
                                        id="fieldset-complement"
                                        label="Complemento"
                                        label-for="complement">
                                        <b-form-input id="name" v-model="address.complement" trim/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="5" class="form-field">
                                    <b-form-group
                                        id="fieldset-district"
                                        label="Bairro/Distrito"
                                        label-for="district">
                                        <b-form-input id="name" v-model="address.district" trim/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="2" class="form-field">
                                    <b-form-group
                                        id="fieldset-uf"
                                        label="UF"
                                        label-for="uf">
                                        <uf-select v-model="uf" @input="address.city = {}"/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="5" class="form-field">
                                    <b-form-group
                                        id="fieldset-city"
                                        label="Cidade"
                                        label-for="city">
                                        <city-select
                                            v-model="address.city"
                                            :uf="uf"
                                            @input="onChangeCity"/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="12" class="form-field">
                                    <b-form-group
                                        id="fieldset-reference"
                                        label="Referência"
                                        label-for="reference">
                                        <b-form-textarea id="name" v-model="address.reference" trim/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="4" class="form-field">
                                    <b-form-group
                                        id="fieldset-service-group"
                                        label="Saída de Campo"
                                        label-for="service-group">
                                        <service-group-select v-model="serviceGroup" @input="onChangeServiceGroup"/>
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
                                            v-model="address.card"
                                            :locality="locality"
                                            @input="address.card_id = address.card.id"/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="12" class="form-field">
                                    <b-form-group
                                        id="fieldset-gmap"
                                        label="Mapa"
                                        label-for="gmap">

                                        <b-form-checkbox
                                            id="checkbox-1"
                                            v-model="onDragMarker"
                                            name="checkbox-1"
                                            value="update"
                                            unchecked-value="not_update">
                                            <div style="font-weight: normal">
                                                Atualizar endereço ao mover o ponteiro do mapa
                                            </div>
                                        </b-form-checkbox>
                                        <gmap-map
                                            ref="gMap"
                                            :center="center"
                                            :zoom="gmapZoom"
                                            class="form-control"
                                            style="width: 100%; height: 400px">
                                            <gmap-marker
                                                ref="myMarker"
                                                :position="address"
                                                :clickable="true"
                                                :draggable="true"
                                                @drag="updateLatLng"/>
                                        </gmap-map>
                                    </b-form-group>
                                </b-col>
                            </b-row>
                            <template v-slot:footer>
                                <b-button variant="info" @click="save">Salvar</b-button>
                                <b-button variant="danger" v-if="address.id" @click="confirmDelete">Excluir</b-button>
                            </template>
                        </b-card>

                    </b-overlay>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import CardTitle from "../../components/CardTitle";
    import Swal from "sweetalert2";
    import Address from "../../../models/Address";
    import CitySelect from "../City/select";
    import City from "../../../models/City";
    import UfSelect from "../Uf/select";
    import ServiceGroupSelect from "../ServiceGroup/select";
    import LocalitySelect from "../Locality/select";
    import CardSelect from "../Card/select";
    import Uf from "../../../models/Uf";
    import ServiceGroup from "../../../models/ServiceGroup";
    import Locality from "../../../models/Locality";
    import Card from "../../../models/Card";

    export default {
        name: "AddressEdit",
        components: {
            CardSelect,
            LocalitySelect,
            ServiceGroupSelect,
            UfSelect,
            CitySelect,
            CardTitle,
            ContentTitle
        },
        props: ['value'],
        data() {
            return {
                address: Address.new(),
                uf: Uf.new(),
                serviceGroup: ServiceGroup.new(),
                locality: Locality.new(),
                url: '/maps/addresses/',
                overlay: false,
                popoverDelete: false,
                onDragMarker: 'update',
                gmapZoom: 16,
                center: {
                    lat: -22.5127163,
                    lng: -41.918432
                }
            }
        },
        created() {
            this.load(this.value)
        },
        watch: {
            value: function(newVal) {
                this.load(newVal)
            }
        },
        methods: {
            async load(id) {
                this.address = id ? await Address.find(id) : Address.new();

                this.center.lat = this.address.lat = (this.address.lat ?? -22.5127163) * 1
                this.center.lng = this.address.lng = (this.address.lng ?? -41.918432) * 1

                if(this.address.city.uf)
                    this.uf = this.address.city.uf

                this.fillCardChilds()
            },
            fillCardChilds() {
                if(!this.address.card) {
                    this.locality = Locality.new()
                    this.serviceGroup = Locality.new()
                    return
                }

                this.locality = this.address.card.locality
                this.serviceGroup = this.address.card.locality.service_group
            },
            updateId(uf = {}) {
                this.address.uf_id = uf.id;
            },
            async save() {
                const response = await Address.save(this.address)

                if(!response.id) {
                    return Swal.fire('Erro!', response.message ?? 'Aconteceu um erro ao salvar o registro!', 'error')
                }

                Swal.fire('Sucesso!','Registro atualizado com sucesso!','success')

                this.address = response
                this.address.lat *= 1
                this.address.lng *= 1

                if(!this.value) {
                    await this.$router.push(this.url + this.address.id)
                    this.$emit('reloadGrid')
                }
            },
            confirmDelete() {
                Swal.fire({
                    title: "Tem certeza que quer que excluir este registro?",
                    text: "Não será possível reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#ccc',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.delete()
                    }
                })
            },
            delete() {
                this.popoverDelete = false;
                Address.delete(this.address.id);

                Swal.fire('Sucesso!', 'Cidade removida com sucesso', 'success')
                this.address = Address.new();
                this.$router.push(this.url)
                this.$emit('reloadGrid')
            },
            updateHistory(id = '') {
                console.log(id)
                history.pushState({}, null, this.url + id);
            },
            updateLatLng(position = {}) {
                this.address.lat = position.latLng.lat()
                this.address.lng = position.latLng.lng()

                if(this.onDragMarker !== 'update') return

                const latlng = new google.maps.LatLng(this.address.lat, this.address.lng)
                const geocoder = new google.maps.Geocoder()

                geocoder
                    .geocode({location: latlng})
                    .then(response => {
                        if(!response.results[0]) return
                        this.fillAddressFields(response.results[0].address_components)
                    }).catch(error => error)
            },
            getAddressField(place, key, partial = 'long_name') {
                const field = place.filter(v => v.types.includes(key))
                return field[0] ? field[0][partial] : ''
            },
            async onChangeAddress(place) {
                if (!place) return

                this.center.lat = this.address.lat = place.geometry.location.lat()
                this.center.lng = this.address.lng = place.geometry.location.lng()

                this.fillAddressFields(place.address_components)
            },
            async fillAddressFields(place) {
                this.address.street = this.getAddressField(place, 'route')
                this.address.district = this.getAddressField(place, 'sublocality_level_1')
                    || this.getAddressField(place, 'sublocality')

                const city = this.getAddressField(place, 'administrative_area_level_2', 'short_name')
                const uf = this.getAddressField(place, 'administrative_area_level_1', 'short_name')

                const filters = JSON.stringify({
                    name: city,
                    uf: {uf:uf}
                })

                const cities = await City.get({filters})

                this.uf = cities.data[0].uf
                this.address.city = cities.data[0]
                this.address.city_id = cities.data[0].id
            },
            onChangeCity() {
                this.address.city_id = this.address.city.id ?? null
            },
            onChangeLocality() {
                this.address.card = Card.new()
            },
            onChangeServiceGroup() {
                this.locality = Locality.new()
                this.address.card = Card.new()
            }
        }
    }
</script>

<style scoped>

</style>
