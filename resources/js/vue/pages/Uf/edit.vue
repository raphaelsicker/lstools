<template>
    <div id="">
        <div class="inner-content">
            <b-row>
                <b-col class="form-field">
                    <b-overlay :show="overlay" class="grid-box">
                        <b-card>
                            <card-title
                                title="Cadastro"
                                subTitle="Edite aqui os dados da Estado"/>
                            <b-row>
                                <b-col md="4" class="form-field">
                                    <b-form-group
                                        id="fieldset-uf"
                                        label="Uf"
                                        label-for="uf">
                                        <b-form-input id="uf" v-model="uf.uf" trim/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="8" class="form-field">
                                    <b-form-group
                                        id="fieldset-nome"
                                        label="Nome"
                                        label-for="nome">
                                        <b-form-input id="nome" v-model="uf.name" trim/>
                                    </b-form-group>
                                </b-col>
                            </b-row>
                            <template v-slot:footer>
                                <b-button variant="info" @click="save">Salvar</b-button>
                                <b-button variant="danger" v-if="uf.id" @click="confirmDelete">Excluir</b-button>
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
    import Uf from "../../../models/Uf";
    import CardTitle from "../../components/CardTitle";
    import Swal from "sweetalert2";

    export default {
        name: "UfEdit",
        components: {CardTitle, ContentTitle},
        props: ['value'],
        data() {
            return {
                uf: Uf.new(),
                url: '/forms/ufs/',
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
                this.uf = id ? await Uf.find(id) : Uf.new();
            },
            updateUf(uf = {}) {
                this.uf.uf_id = uf.id;
            },
            async save() {
                const response = await Uf.save(this.uf)

                if(!response.id) {
                    return Swal.fire('Erro!', response.message ?? 'Aconteceu um erro ao salvar o registro!', 'error')
                }

                this.uf = response
                Swal.fire('Sucesso!','Registro atualizado com sucesso!','success')
                this.$router.push(this.url + this.uf.id)
                this.$emit('reloadGrid')
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
                Uf.delete(this.uf.id);

                Swal.fire('Sucesso!', 'Cidade removida com sucesso', 'success')
                this.uf = Uf.new();
                this.$router.push(this.url)
                this.$emit('reloadGrid')
            },
            updateHistory(id = '') {
                console.log(id)
                history.pushState({}, null, this.url + id);
            }
        }
    }
</script>

<style scoped>

</style>
