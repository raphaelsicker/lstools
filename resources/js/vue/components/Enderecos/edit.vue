<template>
    <b-modal
        v-model="modal.exibir"
        size="lg"
        title="Cadastro de Endereço"
        scrollable
    >
        <b-col md="8" class="form-field">
            <b-form-group
                id="fieldset-logradouro"
                label="Logradouro"
                label-for="logradouro"
            >
                <b-form-input id="logradouro" v-model="endereco.logradouro" trim/>
            </b-form-group>
        </b-col>
        <b-col md="4" class="form-field">
            <b-form-group
                id="fieldset-numero"
                label="Número"
                label-for="numero"
            >
                <b-form-input id="numero" v-model="endereco.numero" trim/>
            </b-form-group>
        </b-col>
        <template v-slot:modal-footer>
            <b-button variant="success" @click="salvar">Salvar</b-button>
        </template>
    </b-modal>
</template>

<script>
    export default {
        name: "EditarEndereco",
        props: ['value', 'modal'],
        data() {
            return {
                endereco: {}
            }
        },
        watch: {
           value() {
               this.endereco = JSON.parse(JSON.stringify(this.value));
           }
        },
        methods: {
            salvar() {
                this.modal.exibir = false;
                this.$emit('adicionarEndereco', this.endereco);
            }
        }
    }
</script>

<style scoped>

</style>
