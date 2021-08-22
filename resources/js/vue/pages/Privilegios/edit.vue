<template>
    <b-form @submit.prevent="onSubmit">
        <input type="hidden" v-model="privilegio.id">
        <content-title title="Privilegios" subTitle="Cadastro" id="divDelete">
            <b-button
                variant="success" pill
                type="submit"
                v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-save"></i></b-button>
                <b-button
                    id="btnDelete"
                    v-show="privilegio.id"
                    variant="danger" pill
                    v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-trash"></i></b-button>
                <b-popover
                    :show.sync="popoverDelete"
                    target="btnDelete"
                    triggers="click"
                    placement="bottom"
                >
                    <template v-slot:title>Tem certeza que deseja excluir esse Privilegio?</template>
                    <div class="text-right">
                        <b-button @click="naoDeletar" size="sm" variant="danger">Cancelar</b-button>
                        <b-button @click="deletar" size="sm" variant="info">Excluir</b-button>
                    </div>
                </b-popover>
        </content-title>
        <div class="content-fields">
            <b-col md="12" class="form-field">
                <b-form-group
                    id="fieldset-nome"
                    label="Nome"
                    label-for="nome">
                    <b-form-input id="nome" v-model="privilegio.nome" trim/>
                </b-form-group>
            </b-col>
            <b-col md="12" class="form-field acessos-dos-privilegios">
                <privilegio-acessos v-bind:value="privilegio.acessos" :nome-acesso="privilegio.nome"/>
            </b-col>
        </div>
    </b-form>
</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import Privilegios from "../../../domain/Privilegios";
    import PrivilegioAcessos from "./Acessos/index";

    export default {
        name: "EditarPrivilegio",
        components: {PrivilegioAcessos, ContentTitle},
        data() {
            return {
                id: this.$route.params.id || 0,
                exibirDelete: true,
                popoverDelete: false,
            }
        },
        props: ['privilegio', 'url'],
        methods: {
            atribuir(privilegio = []) {
                for(let campo in privilegio) {
                    this.privilegio[campo] = privilegio[campo] ?? null;
                }
                this.atualizarUrl(this.privilegio.id ?? '');
                this.$emit('recarregarGrid');
            },
            onSubmit() {
                this.privilegio.salvar()
                    .then(resposta=> {
                        if(resposta.data.id) {
                            this.alerta('Privilegio salva com sucesso');
                            this.atribuir(resposta.data);
                        }
                    }).catch(error => {
                        if(!erro.mensagem) {
                            erro.mensagem = 'Erro ao salvar o Privilégio'
                        }
                        this.alerta( erro.mensagem, 'danger', 'Erro!')
                    });
            },
            naoDeletar() {
                this.popoverDelete = false;
            },
            deletar() {
                this.popoverDelete = false;

                this.privilegio.deletar()
                    .then(reposta => {
                        if(reposta.data) {
                            this.alerta('Privilégio removido com sucesso');
                            this.atribuir(new Privilegios());
                        }
                    }).catch(error => this.alerta(erro.mensagem, 'danger', 'Erro!'));
            },
            atualizarUrl(caminhoRelativo = '') {
                history.pushState({}, null, this.url + caminhoRelativo);
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
