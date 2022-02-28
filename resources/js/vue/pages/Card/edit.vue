<template>
    <div id="">
        <div class="inner-content">
            <b-row>
                <b-col class="form-field">
                    <b-overlay :show="overlay" class="grid-box">
                        <b-card>
                            <card-title
                                title="Cadastro"
                                subTitle="Edite aqui os dados do Cartão"/>
                            <b-row>
                                <b-col md="4" class="form-field">
                                    <b-form-group
                                        id="fieldset-service-group"
                                        label="Saída de Campo"
                                        label-for="service-group">
                                        <service-group-select
                                            v-model="locality.service_group"
                                            @input="locality.service_group_id = locality.service_group.id"
                                        />
                                    </b-form-group>
                                </b-col>
                                <b-col md="8" class="form-field">
                                    <b-form-group
                                        id="fieldset-nome"
                                        label="Localidade"
                                        label-for="name">
                                        <b-form-input id="name" v-model="locality.name" trim/>
                                    </b-form-group>
                                </b-col>
                            </b-row>

                            <b-row >
                                <b-col v-for="(card, i) in cards" :key="i" md="4" class="form-field">
                                    <b-card class="mb-4">
                                        <template v-slot:header>
                                            Cartão: {{getCardOrder(i, card)}}
                                        </template>
                                        <draggable class="list-group" :list="card.addresses" group="cards">
                                            <b-list-group-item v-for="address in card.addresses" :key="address.id">
                                                {{ address.complete }}
                                            </b-list-group-item>
                                        </draggable>
                                    </b-card>
                                </b-col>
                            </b-row>

                            <b-row class="m-1">
                                <b-button variant="info" @click="newCard">Novo Cartão</b-button>
                            </b-row>

                            <template v-slot:footer>
                                <b-button variant="info" @click="save">Salvar</b-button>
                                <b-button variant="danger" v-if="locality.id" @click="confirmDelete">Excluir</b-button>
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
    import Locality from "../../../models/Locality";
    import Card from "../../../models/Card";
    import ServiceGroupSelect from "../ServiceGroup/select";
    import Draggable from 'vuedraggable'

    export default {
        name: "ServiceGroupEdit",
        components: {ServiceGroupSelect, CardTitle, ContentTitle, Draggable},
        props: ['value'],
        data() {
            return {
                locality: Locality.new(),
                cards:[],
                url: '/maps/cards/',
                overlay: false,
                popoverDelete: false
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
                this.locality = id ? await Locality.find(id) : Locality.new()
                this.cards = this.locality.id ? await Locality.cards(this.locality.id) : []
            },
            async save() {
                this.locality.cards = this.cards
                const response = await Locality.save(this.locality)

                if(!response.id) {
                    return Swal.fire('Erro!', response.message ?? 'Aconteceu um erro ao salvar o registro!', 'error')
                }

                this.locality = response
                this.cards = this.locality.id ? await Locality.cards(this.locality.id) : []

                await Swal.fire('Sucesso!','Cartão salvo com sucesso!','success')
                this.$emit('reloadGrid')

                if(!this.value)
                    await this.$router.push(this.url + this.locality.id)
            },
            confirmDelete() {
                Swal.fire({
                    title: "Tem certeza que quer que excluir este cartão?",
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
                Locality.delete(this.locality.id);

                Swal.fire('Sucesso!', 'Cartão removido com sucesso', 'success')
                this.locality = Locality.new();
                this.$router.push(this.url)
                this.$emit('reloadGrid')
            },
            updateHistory(id = '') {
                history.pushState({}, null, this.url + id);
            },
            getCardOrder(i, card) {
                card.order = i + 1
                return card.order
            },
            newCard() {
                Card.new();
                this.cards.push(Card.new())
            }
        }
    }
</script>

<style scoped>

</style>
