<template>
    <b-form-group
        id="fieldset-contatos"
        :label="label || 'Clique em um contato para poder editar'"
        label-for="contatos"
    >
        <b-table
            ref="contatos"
            id="contatos"
            stacked="md"
            striped
            hover
            show-empty
            :fields="campos"
            :items="value"
            @row-clicked="editarContato">
            <template v-slot:empty="value">
                Nenhum contato retornado
            </template>
        </b-table>
        <div class="text-center">
            <b-button variant="info" @click="novoContato">Novo Contato</b-button>
        </div>
        <editar-contato
            v-model="contato"
            :modal="modal"
            @adicionarContato="adicionarContato"/>

    </b-form-group>
</template>

<script>
    import EditarContato from "./edit";
    export default {
        name: "Contatos",
        components: {EditarContato},
        data() {
            return {
                campos: [
                    {key: 'tipo.nome', label: 'Tipo do Contato', sortable: false, sortDirection: 'asc'},
                    {key: 'valor', label: 'Valor', sortable: false, sortDirection: 'asc'},
                    {key: 'observacao', label: 'Observação', sortable: false, sortDirection: 'asc'},
                ],
                linha: 0,
                contato: {},
                modal: {exibir: false}
            }
        },
        props: ['value', 'label'],
        methods: {
            editarContato(contatoClicado) {
                this.contato = contatoClicado;
                this.modal.exibir = true;
            },
            novoContato() {
                this.contato = {};
                this.modal.exibir = true;
            },
            adicionarContato(contato = {}) {
                if(!contato.id && !contato.linha) {
                    this.atribuirNovoContato(contato)
                    return this.$refs.contatos.refresh();
                }

                for(let item in this.value) {
                    if(contato.id === this.value[item].id) {
                        this.atribuirCampos(item, contato);
                    }
                }

                this.$refs.contatos.refresh();
            },
            atribuirCampos(item, contato) {
                for(let campo in contato) {
                    this.value[item][campo] = contato[campo] ?? null;
                }
            },
            atribuirNovoContato(contato) {
                contato.linha =  ++this.linha;
                this.value.push(contato);
            }
        },
    }
</script>

<style scoped>
    .table {
        font-size: 14px;
        border-bottom: 2px solid #ddd;
    }
</style>
