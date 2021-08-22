<template>
    <b-form @submit.prevent="onSubmit">
        <input type="hidden" v-model="bairro.id">
        <content-title title="Bairros" subTitle="Cadastro" id="divDelete">
            <b-button
                variant="success" pill
                type="submit"
                v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-save"></i></b-button>
                <b-button
                    id="btnDelete"
                    v-show="bairro.id"
                    variant="danger" pill
                    v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-trash"></i></b-button>
                <b-popover
                    :show.sync="popoverDelete"
                    target="btnDelete"
                    triggers="click"
                    placement="bottom"
                >
                    <template v-slot:title>Tem certeza que deseja excluir esse Bairro?</template>
                    <div class="text-right">
                        <b-button @click="naoDeletar" size="sm" variant="danger">Cancelar</b-button>
                        <b-button @click="deletar" size="sm" variant="info">Excluir</b-button>
                    </div>
                </b-popover>
        </content-title>
        <div class="content-fields">
            <b-col md="2" class="form-field">
                <b-form-group
                    id="fieldset-estado"
                    label="Estado"
                    label-for="estado"
                >
                    <select-estados v-model="bairro.cidade.estado"/>
                </b-form-group>
            </b-col>
            <b-col md="3" class="form-field">
                <b-form-group
                    id="fieldset-cidade"
                    label="Cidade"
                    label-for="city">
                    <select-cidades
                        v-model="bairro.cidade"
                        v-bind:estado="bairro.cidade.estado"
                        @input="atualizarCidade"
                    />
                </b-form-group>
            </b-col>
            <b-col md="7" class="form-field">
                <b-form-group
                    id="fieldset-nome"
                    label="Nome"
                    label-for="nome">
                    <b-form-input id="nome" v-model="bairro.nome" trim/>
                </b-form-group>
            </b-col>
        </div>
    </b-form>
</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import Bairros from "../../../domain/Bairros";
    import SelectEstados from "../../components/selects/SelectEstados";
    import SelectCidades from "../../components/selects/SelectCidades";

    export default {
        name: "EditarBairro",
        components: {SelectCidades, SelectEstados, ContentTitle},
        data() {
            return {
                exibirDelete: true,
                popoverDelete: false,
                carregandoCidades: false
            }
        },
        props: {
            bairro: {
                required: true,
                type: Object,
                default() {
                    return {
                        cidade: {
                            estado: {}
                        }
                    }
                }
            }
        },
        methods: {
            atribuir(bairro = []) {
                for(let campo in bairro) {
                    this.bairro[campo] = bairro[campo] ?? null;
                }
                this.atualizarUrl(bairro.id ?? '');
                this.$emit('recarregarGrid');
            },
            atualizarCidade(novaCidade = {}) {
                this.bairro.cidade_id = novaCidade.id;
            },
            onSubmit() {
                this.bairro.salvar()
                    .then(resposta=> {
                        if(resposta.data.id) {
                            this.alerta('Bairro salva com sucesso');
                            this.atribuir(resposta.data);
                        }
                    }).catch(error => {
                        if(!erro.mensagem) {
                            erro.mensagem = 'Erro ao salvar o Bairro'
                        }
                        this.alerta( erro.mensagem, 'danger', 'Erro!')
                    });
            },
            naoDeletar() {
                this.popoverDelete = false;
            },
            deletar() {
                this.popoverDelete = false;
                console.log(this.bairro.id);

                this.bairro.deletar()
                    .then(reposta => {
                        if(reposta.data) {
                            this.alerta('Bairro removido com sucesso');
                            this.atribuir(new Bairros());
                        }
                    }).catch(error => this.alerta(erro.mensagem, 'danger', 'Erro!'));
            },
            atualizarUrl(caminhoRelativo = '') {
                history.pushState({}, null, '/cadastros/bairros/' + caminhoRelativo);
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
