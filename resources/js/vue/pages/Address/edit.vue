<template>
    <div id="">
        <div class="inner-content">
            <b-row>
                <b-col class="form-field">
                    <b-overlay :show="overlay" class="grid-box">
                        <b-card>
                            <card-title
                                title="Cadastro"
                                subTitle="Edite aqui os dados da Saída de Campo"/>
                            <b-row>
                                <b-col md="1" class="form-field">
                                    <b-form-group
                                        id="fieldset-color"
                                        label="Cor"
                                        label-for="color">

                                        <swatches
                                            v-model="serviceGroup.color"
                                            swatches="text-advanced"
                                            :trigger-style="{
                                                width: '35px',
                                                height: '35px',
                                                borderRadius: '30px',
                                                border: getSwatchesBorder(serviceGroup.color)
                                            }"
                                        ></swatches>

                                    </b-form-group>
                                </b-col>
                                <b-col md="2" class="form-field">
                                    <b-form-group
                                        id="fieldset-shortname"
                                        label="Sigla"
                                        label-for="shortname">
                                        <b-form-input id="shortname" v-model="serviceGroup.shortname" trim/>
                                    </b-form-group>
                                </b-col>
                                <b-col md="9" class="form-field">
                                    <b-form-group
                                        id="fieldset-nome"
                                        label="Nome"
                                        label-for="name">
                                        <b-form-input id="name" v-model="serviceGroup.name" trim/>
                                    </b-form-group>
                                </b-col>
                            </b-row>
                            <template v-slot:footer>
                                <b-button variant="info" @click="save">Salvar</b-button>
                                <b-button variant="danger" v-if="serviceGroup.id" @click="confirmDelete">Excluir</b-button>
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
    import ServiceGroup from "../../../models/ServiceGroup";

    export default {
        name: "ServiceGroupEdit",
        components: {CardTitle, ContentTitle},
        props: ['value'],
        data() {
            return {
                serviceGroup: ServiceGroup.new(),
                url: '/forms/service-groups/',
                overlay: false,
                exibirDelete: true,
                popoverDelete: false,
                carregandoCidades: false
            }
        },
        computed: {
            shortNameState() {
                return this.serviceGroup.shortname
                    ? this.serviceGroup.shortname.length > 0
                    : false
            },
            nameState() {
                return this.serviceGroup.name
                    ? this.serviceGroup.name.length > 0
                    : false
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
                this.serviceGroup = id ? await ServiceGroup.find(id) : ServiceGroup.new();
                this.serviceGroup.color = this.serviceGroup.color ?? "#3d85c6"
            },
            updateId(uf = {}) {
                this.serviceGroup.uf_id = uf.id;
            },
            async save() {
                const response = await ServiceGroup.save(this.serviceGroup)

                if(!response.id) {
                    return Swal.fire('Erro!', response.message ?? 'Aconteceu um erro ao salvar o registro!', 'error')
                }

                this.serviceGroup = response
                Swal.fire('Sucesso!','Registro atualizado com sucesso!','success')
                this.$router.push(this.url + this.serviceGroup.id)
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
                ServiceGroup.delete(this.serviceGroup.id);

                Swal.fire('Sucesso!', 'Cidade removida com sucesso', 'success')
                this.serviceGroup = ServiceGroup.new();
                this.$router.push(this.url)
                this.$emit('reloadGrid')
            },
            updateHistory(id = '') {
                console.log(id)
                history.pushState({}, null, this.url + id);
            },
            // Cria as bordas para os swatches caso a cor seja muito clara
            getSwatchesBorder(color = null) {
                if(!color)
                    return 'none'

                const red = parseInt(color[1], 16)
                const blue = parseInt(color[3], 16)
                const green = parseInt(color[5], 16)

                if(red > 11 && blue > 11 && green > 11)
                    return '1px solid #ccc'

                return 'none'
            }
        }
    }
</script>

<style scoped>

</style>
