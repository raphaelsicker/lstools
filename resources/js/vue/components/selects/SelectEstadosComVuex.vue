<template>
    <div>
    <multiselect
        v-model="estadoAtual"
        :options="estados"
        :searchable="true"
        :close-on-select="true"
        :show-labels="false"
        id="estados"
        label="sigla"
        track-by="sigla"
        placeholder="Estados"
    >
        <span slot="noOptions">Nenhuma opção ainda</span>
        <span slot="noResult">Nenhuma city encontrada</span>
    </multiselect>
        Estados:
        {{estados}}
    </div>
</template>

<script>
    import { mapGetters, mapMutations, mapActions } from 'vuex'

    export default {
        name: "SelectEstadosComVuex",
        props: {
            estado: {
                required: true,
                type: Object,
                default: function() {
                    return {}
                }
            }
        },
        computed:{
            ...mapGetters('estados', [
                'estados'
            ])
        },
        data() {
            return {
                estadoAtual: {},
            }
        },
        created() {
            this.listarTodos();
        },
        methods: {
            ...mapActions('estados', [
                'listar',
                'listarTodos'
            ])
        }
    }
</script>

<style scoped>

</style>
