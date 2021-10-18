<template>
    <section id="main-content">
        <content-title
            title="Estado"
            subTitle="Cadastros / Estados"/>
        <div class="inner-content">
            <b-row>
                <b-col xl="6" lg="9" md="12" class="form-field">
                    <b-overlay :show="overlay" class="grid-box">
                    <b-card>
                        <card-title
                            title="Cadastro"
                            subTitle="Edite aqui os dados do Estado"/>
                        <b-row>
                            <b-col md="4" class="form-field">
                                <b-form-group
                                    id="fieldset-sigla"
                                    label="Sigla"
                                    label-for="sigla">
                                    <b-form-input id="sigla" v-model="results.sigla" trim/>
                                </b-form-group>
                            </b-col>
                            <b-col md="8" class="form-field">
                                <b-form-group
                                    id="fieldset-nome"
                                    label="Nome"
                                    label-for="nome">
                                    <b-form-input id="nome" v-model="results.nome" trim/>
                                </b-form-group>
                            </b-col>
                        </b-row>
                        <template v-slot:footer>
                            <b-button variant="info" @click="save">Salvar</b-button>
                            <b-button variant="danger" v-if="id" @click="confirmDelete">Excluir</b-button>
                        </template>
                    </b-card>

                    </b-overlay>
                </b-col>
            </b-row>
        </div>
    </section>
</template>

<script>
import Swal from 'sweetalert2';
import ContentTitle from "../../components/ContentTitle";
import Estado from "../../../models2/Estado";
import CardTitle from "../../components/CardTitle";
export default {
    name: "Estado",
    components: {CardTitle, ContentTitle},
    data() {
        return {
            id: !isNaN(this.$route.params.id) ? this.$route.params.id : null,
            overlay: false,
            results: {}
        }
    },
    created() {
        if(this.id) {
            this.load();
        }
    },
    methods: {
        async load() {
            this.overlay = true;
            this.results = await Estado.find(this.id)
            this.overlay = false;

            return;

            if(!this.results.id) {
                Swal.fire('Oops...', this.results.data.error, 'error')
                this.$router.push({name: 'cadastros.estados'})
            }
        },

        async save() {
            if(this.id) {
                let response = await Estado.put(this.results, this.id);
                return Swal.fire('Sucesso!','Registro atualizado com sucesso!','success')
            }

            let response = await Estado.post(this.results);
            Swal.fire('Sucesso!','Registro criado com sucesso!','success')

            this.id = response.id

            this.$router.push({
                name: 'cadastros.estados.edit',
                params: { id: response.id}
            })
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

        async delete() {
            let response = await Estado.destroy(this.id)

            if(response.status === 200) {
                Swal.fire('Sucesso!', response.data.mensagem, 'success')
                this.$router.push({name: 'cadastros.estados'})
            }
            Swal.fire('Oops...', response.data.error, 'error')
        },
    }
}
</script>

<style scoped>

</style>
