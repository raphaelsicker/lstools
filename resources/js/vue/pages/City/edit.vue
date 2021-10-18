<template>
    <div id="">
        <div class="inner-content">
            <b-row>
                <b-col class="form-field">
                    <b-overlay :show="overlay" class="grid-box">
                        <b-card>
                            <card-title
                                title="Cadastro"
                                subTitle="Edite aqui os dados da Cidade"/>
                            <b-row>
                                <b-col md="4" class="form-field">
                                    <b-form-group
                                        id="fieldset-uf"
                                        label="UF"
                                        label-for="uf">
                                        <uf-select v-model="city.uf" @input="city.uf_id = city.uf.id"/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="8" class="form-field">
                                    <b-form-group
                                        id="fieldset-nome"
                                        label="Nome"
                                        label-for="nome">
                                        <b-form-input id="nome" v-model="city.name" trim/>
                                    </b-form-group>
                                </b-col>
                            </b-row>
                            <template v-slot:footer>
                                <b-button variant="info" @click="save">Salvar</b-button>
                                <b-button variant="danger" v-if="city.id" @click="confirmDelete">Excluir</b-button>
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
    import City from "../../../models/City";
    import UfSelect from "../Uf/select";
    import CardTitle from "../../components/CardTitle";
    import Swal from "sweetalert2";

    export default {
        name: "CityEdit",
        components: {CardTitle, UfSelect, ContentTitle},
        props: ['value'],
        data() {
            return {
                city: City.new(),
                url: '/cities/',
                overlay: false,
                exibirDelete: true,
                popoverDelete: false,
                carregandoCidades: false
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
                console.log('id', id)
                this.city = id ? await City.find(id) : City.new();
            },
            fill(city = []) {
                for(let campo in city) {
                    this.cidade[campo] = city[campo] ?? null;
                }
                this.updateHistory(city.id ?? '');
                this.$emit('reloadGrid');
            },
            updateUf(uf = {}) {
                this.city.uf_id = uf.id;
            },
            async save() {
                const response = await City.save(this.city)

                if(!response.id) {
                    return Swal.fire('Erro!', response.message ?? 'Aconteceu um erro ao salvar o registro!', 'error')
                }

                this.city = response
                Swal.fire('Sucesso!','Registro atualizado com sucesso!','success')
                this.$emit('reloadGrid')
                this.updateHistory(this.city.id ?? '')
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
                City.delete(this.city.id);

                Swal.fire('Sucesso!', 'Cidade removida com sucesso', 'success')
                this.city = City.new();

                this.$emit('reloadGrid')
                this.updateHistory('')
            },
            updateHistory(id = '') {
                history.pushState({}, null, this.url + id);
            }
        }
    }
</script>

<style scoped>

</style>
