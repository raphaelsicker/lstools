<template>
    <b-form @submit.prevent="onSubmit">
        <input type="hidden" v-model="saida.id">
        <content-title title="Nova Saída de Campo" subTitle="Saídas de Campo" id="divDelete">
            <b-button
                variant="success" pill
                type="submit"
                v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-save"></i></b-button>
                <b-button
                    id="btnDelete"
                    v-show="saida.id"
                    variant="danger" pill
                    v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-trash"></i></b-button>
                <b-popover
                    :show.sync="popoverDelete"
                    target="btnDelete"
                    triggers="click"
                    placement="bottom"
                >
                    <template v-slot:title>Tem certeza que deseja excluir essa Saída?</template>
                    <div class="text-right">
                        <b-button @click="naoDeletar" size="sm" variant="danger">Cancelar</b-button>
                        <b-button @click="deletar" size="sm" variant="info">Excluir</b-button>
                    </div>
                </b-popover>
        </content-title>
        <div class="content-fields">
            <b-col md="3" class="form-field">
                <b-form-group
                    id="fieldset-sigla"
                    label="Sigla"
                    label-for="sigla"
                    :state="states.sigla"
                >
                    <b-form-input id="sigla" v-model="saida.sigla" :state="states.sigla" trim></b-form-input>
                </b-form-group>
            </b-col>
            <b-col md="9" class="form-field">
                <b-form-group
                    id="fieldset-nome"
                    label="Nome"
                    label-for="nome"
                    :state="states.nome"
                >
                    <b-form-input id="nome" v-model="saida.nome" :state="states.nome" trim></b-form-input>
                </b-form-group>
            </b-col>
        </div>
    </b-form>
</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import SaidasDeCampo from "../../../domain/SaidasDeCampo";

    export default {
        name: "EditarSaidaDeCampo",
        components: {ContentTitle},
        data() {
            return {
                exibirDelete: true,
                popoverDelete: false
            }
        },
        props: {
            saida: {
                required: true,
                type: Object
            }
        },
        computed: {
            states() {
                return {
                    sigla: null,
                    nome: null
                }
            }
        },
        methods: {
            atribuir(saida) {
                for(let campo in saida) {
                    this.saida[campo] = saida[campo] ?? null;
                }
                this.atualizarUrl(saida.id ?? '');
                this.$emit('recarregarGrid');
            },
            onSubmit() {
                this.saida.salvar()
                    .then(reposta=> {
                        if(reposta.data.id) {
                            this.alerta('Saída salva com sucesso');
                            this.atribuir(reposta.data);
                        }
                    }).catch(error => {
                        this.alerta(erro.mensagem, 'danger', 'Erro!')
                    });
            },
            naoDeletar() {
                this.popoverDelete = false;
            },
            deletar() {
                this.popoverDelete = false;
                console.log(this.saida.id);

                this.saida.deletar()
                    .then(reposta => {
                        if(reposta.data) {
                            this.alerta('Saída removida com sucesso');
                            this.atribuir(new SaidasDeCampo());
                        }
                    }).catch(error => this.alerta(erro.mensagem, 'danger', 'Erro!'));
            },
            atualizarUrl(caminhoRelativo = '', params = '') {
                history.pushState({}, null, '/saidas_de_campo/' + caminhoRelativo);
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
