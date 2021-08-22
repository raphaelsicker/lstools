<template>
    <b-form @submit.prevent="onSubmit">
        <input type="hidden" v-model="city.id">
        <content-title title="Cidades" subTitle="Cadastro" id="divDelete">
            <b-button
                variant="success" pill
                type="submit"
                v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-save"></i></b-button>
                <b-button
                    id="btnDelete"
                    v-show="city.id"
                    variant="danger" pill
                    v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-trash"></i></b-button>
                <b-popover
                    :show.sync="popoverDelete"
                    target="btnDelete"
                    triggers="click"
                    placement="bottom"
                >
                    <template v-slot:title>Tem certeza que deseja excluir essa Cidade?</template>
                    <div class="text-right">
                        <b-button @click="naoDeletar" size="sm" variant="danger">Cancelar</b-button>
                        <b-button @click="deletar" size="sm" variant="info">Excluir</b-button>
                    </div>
                </b-popover>
        </content-title>
        <div class="content-fields">
            <b-col md="2" class="form-field">
                <b-form-group
                    id="fieldset-uf"
                    label="Estado"
                    label-for="uf"
                >
                    <uf-select v-model="city.uf"/>
                </b-form-group>
            </b-col>
            <b-col md="10" class="form-field">
                <b-form-group
                    id="fieldset-name"
                    label="Nome"
                    label-for="name">
                    <b-form-input id="nome" v-model="city.name" trim/>
                </b-form-group>
            </b-col>
        </div>
    </b-form>
</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import Cidades from "../../../domain/Cidades";
    import City from "../../../models/City";
    import UfSelect from "../Uf/select";

    export default {
        name: "CityEdit",
        components: {UfSelect, ContentTitle},
        data() {
            return {
                id: this.$route.params.id || null,
                city: City.new(),
                exibirDelete: true,
                popoverDelete: false,
                carregandoCidades: false
            }
        },
        created() {
            this.load(this.id)
        },
        methods: {
            async load(id) {
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
            onSubmit() {
                this.cidade.salvar()
                    .then(resposta=> {
                        if(resposta.data.id) {
                            this.alerta('Cidade salva com sucesso');
                            this.fill(resposta.data);
                        }
                    }).catch(error => {
                        if(!erro.mensagem) {
                            erro.mensagem = 'Erro ao salvar o Cidade'
                        }
                        this.alerta( erro.mensagem, 'danger', 'Erro!')
                    });
            },
            naoDeletar() {
                this.popoverDelete = false;
            },
            deletar() {
                this.popoverDelete = false;

                this.cidade.deletar()
                    .then(reposta => {
                        if(reposta.data) {
                            this.alerta('Cidade removida com sucesso');
                            this.fill(new Cidades());
                        }
                    }).catch(error => this.alerta(erro.mensagem, 'danger', 'Erro!'));
            },
            updateHistory(caminhoRelativo = '') {
                history.pushState({}, null, '/cadastros/cidades/' + caminhoRelativo);
            },
            alerta(
                mensagem,
                variant = 'success',
                title = 'Sucesso!'
            ) {
                this.$bvToast.toast(mensagem, {
                    title,
                    variant: variant,
                    solid: true
                })
            }
        }
    }
</script>

<style scoped>

</style>
