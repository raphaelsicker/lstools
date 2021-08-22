<template>
    <b-modal
        v-model="modal.exibir"
        size="md"
        title="Cadastro de Contato"
        scrollable
    >
        <b-col md="4" class="form-field">
            <b-form-group
                id="fieldset-logradouro"
                label="Logradouro"
                label-for="logradouro"
            >
                <select-tipos-de-contato v-model="contato.tipo" @input="atualizarTipo"/>
            </b-form-group>
        </b-col>
        <b-col md="8" class="form-field">
            <b-form-group
                id="fieldset-valor"
                label="Valor"
                label-for="valor"
            >
                <b-form-input id="valor" v-model="contato.valor" v-mask="mascaraValor" trim/>
            </b-form-group>
        </b-col>
        <b-col md="12" class="form-field">
            <b-form-group
                id="fieldset-observacao"
                label="Observação"
                label-for="observacao"
            >
                <b-form-textarea id="observacao" v-model="contato.observacao" rows="2" no-resize/>
            </b-form-group>
        </b-col>

        <template v-slot:modal-footer>
            <b-button variant="success" @click="salvar">Salvar</b-button>
        </template>
    </b-modal>
</template>

<script>
    import SelectTiposDeContato from "../selects/SelectTiposDeContato";

    export default {
        name: "EditarContato",
        components: {SelectTiposDeContato},
        props: ['value', 'modal'],
        data() {
            return {
                contato: {}
            }
        },
        computed: {
            mascaraValor() {
                return this.formatacao(this.contato.tipo ? this.contato.tipo.formatacao : null);
            }
        },
        watch: {
           value() {
               this.contato = JSON.parse(JSON.stringify(this.value));
           }
        },
        methods: {
            salvar() {
                this.modal.exibir = false;
                this.$emit('adicionarContato', this.contato);
            },
            atualizarTipo(tipo = {}) {
                this.contato.tipo_de_contato_id = tipo.id;
            },
            formatacao(formatacao = null) {
                switch(formatacao) {
                    case 'telefone':
                        return  '(##) ####-#####';
                    default:
                        return 'X'.repeat(50);
                }
            }
        }
    }
</script>

<style scoped>

</style>
