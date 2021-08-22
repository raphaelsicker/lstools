<template>
    <b-form-group
        id="fieldset-enderecos"
        label="Endereços"
        label-for="enderecos"
    >
        <b-table
            ref="enderecos"
            id="enderecos"
            stacked="md"
            striped
            hover
            show-empty
            :fields="campos"
            :items="value"
            @row-clicked="editarEndereco">
            <template v-slot:empty="value">
                Nenhum endereço retornado
            </template>
        </b-table>
        <div class="text-center">
            <b-button variant="info" @click="novoEndereco">Novo Endereço</b-button>
        </div>
        <editar-endereco
            v-model="endereco"
            :modal="modal"
            @adicionarEndereco="adicionarEndereco"/>

    </b-form-group>
</template>

<script>
    import EditarEndereco from "./edit";
    export default {
        name: "Enderecos",
        components: {EditarEndereco},
        data() {
            return {
                campos: [
                    {key: 'logradouro', label: 'Logradouro', sortable: false, sortDirection: 'asc'},
                    {key: 'numero', label: 'Número', sortable: false, sortDirection: 'asc'},
                    {key: 'complemento', label: 'Complemento', sortable: false, sortDirection: 'asc'},
                    {key: 'bairro.nome', label: 'Bairro', sortable: true, sortDirection: 'asc'},
                    {key: 'cidade.nome', label: 'Cidade', sortable: true, sortDirection: 'asc'},
                    {key: 'cidade.estado.sigla', label: 'UF', sortable: true, sortDirection: 'asc'},
                ],
                linha: 0,
                endereco: {},
                modal: {exibir: false}
            }
        },
        props: ['value'],
        methods: {
            editarEndereco(enderecoClicado) {
                this.endereco = enderecoClicado;
                this.modal.exibir = true;
            },
            novoEndereco() {
                this.endereco = {};
                this.modal.exibir = true;
            },
            adicionarEndereco(endereco = {}) {
                if(!endereco.id && !endereco.linha) {
                    this.atribuirNovoEndereco(endereco)
                    return this.$refs.enderecos.refresh();
                }

                for(let item in this.value) {
                    if(endereco.id === this.value[item].id) {
                        this.atribuirCampos(item, endereco);
                    }
                }

                this.$refs.enderecos.refresh();
            },
            atribuirCampos(item, endereco) {
                for(let campo in endereco) {
                    this.value[item][campo] = endereco[campo] ?? null;
                }
            },
            atribuirNovoEndereco(endereco) {
                endereco.linha =  ++this.linha;
                this.value.push(endereco);
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
