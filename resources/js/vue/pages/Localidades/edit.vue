<template>
    <b-form @submit.prevent="onSubmit">
        <input type="hidden" v-model="localidade.id">
        <content-title title="Bairros" subTitle="Cadastro" id="divDelete">
            <b-button
                variant="success" pill
                type="submit"
                v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-save"></i></b-button>
                <b-button
                    id="btnDelete"
                    v-show="localidade.id"
                    variant="danger" pill
                    v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-trash"></i></b-button>
                <b-popover
                    :show.sync="popoverDelete"
                    target="btnDelete"
                    triggers="click"
                    placement="bottom"
                >
                    <template v-slot:title>Tem certeza que deseja excluir essa Localidade?</template>
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
                    <select-estados v-model="localidade.bairro.cidade.estado"/>
                </b-form-group>
            </b-col>
            <b-col md="5" class="form-field">
                <b-form-group
                    id="fieldset-cidade"
                    label="Cidade"
                    label-for="city">
                    <select-cidades
                        v-model="localidade.bairro.cidade"
                        v-bind:estado="localidade.bairro.cidade.estado"
                    />
                </b-form-group>
            </b-col>
            <b-col md="5" class="form-field">
                <b-form-group
                    id="fieldset-bairro"
                    label="Bairro"
                    label-for="bairro">

                    <select-bairros
                        v-model="localidade.bairro"
                        v-bind:cidade="localidade.bairro.cidade"
                        @input="atualizarBairro"
                    />
                </b-form-group>
            </b-col>
            <b-col md="2" class="form-field">
                <b-form-group
                    id="fieldset-numero"
                    label="Número"
                    label-for="numero">
                    <b-form-input id="numero" v-model="localidade.numero" trim/>
                </b-form-group>
            </b-col>
            <b-col md="10" class="form-field">
                <b-form-group
                    id="fieldset-nome"
                    label="Nome"
                    label-for="nome">
                    <b-form-input id="nome" v-model="localidade.nome" trim/>
                </b-form-group>
            </b-col>
        </div>
    </b-form>
</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import SelectEstados from "../../components/selects/SelectEstados";
    import SelectCidades from "../../components/selects/SelectCidades";
    import SelectBairros from "../../components/selects/SelectBairros";

    export default {
        name: "EditarLocalidade",
        components: {SelectBairros, SelectCidades, SelectEstados, ContentTitle},
        data() {
            return {
                exibirDelete: true,
                popoverDelete: false
            }
        },
        props: ['localidade'],
        methods: {
            atribuir(localidade = []) {
                for(let campo in localidade) {
                    this.localidade[campo] = localidade[campo] ?? null;
                }
                this.atualizarUrl(localidade.id ?? '');
                this.$emit('recarregarGrid');
            },
            atualizarBairro(novoBairro = {}) {
                this.localidade.bairro_id = novoBairro.id;
            },
            onSubmit() {
                this.localidade.salvar()
                    .then(resposta=> {
                        if(resposta.data.id) {
                            this.alerta('Localidade salva com sucesso');
                            this.atribuir(resposta.data);
                        }
                    }).catch(error => {
                        if(!erro.mensagem) {
                            erro.mensagem = 'Erro ao salvar o Localidade'
                        }
                        this.alerta( erro.mensagem, 'danger', 'Erro!')
                    });
            },
            naoDeletar() {
                this.popoverDelete = false;
            },
            deletar() {
                this.popoverDelete = false;

                this.localidade.deletar()
                    .then(reposta => {
                        if(reposta.data) {
                            this.alerta('Localidade removida com sucesso');
                            this.atribuir(new Bairros());
                        }
                    }).catch(error => this.alerta(erro.mensagem, 'danger', 'Erro!'));
            },
            atualizarUrl(caminhoRelativo = '') {
                history.pushState({}, null, '/cadastros/localidades/' + caminhoRelativo);
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
