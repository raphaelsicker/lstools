<template>
    <div>
        <multiselect
            v-bind:value="valorAtual"
            @input="atualizarValor($event)"
            :options="options"
            :searchable="false"
            :close-on-select="true"
            :show-labels="false"
            :allow-empty="false"
            id="id"
            label="name"
            track-by="name"
            placeholder="Status"
        />
    </div>
</template>

<script>
    export default {
        name: "SelectStatusDosAcessos",
        props: ['value'],
        data() {
            return {
                valorAtual: {id: 'e', name: 'Editar'},
                options: [
                    {id: 'e', name: 'Editar'},
                    {id: 'v', name:'Visualizar'},
                    {id: 'o', name:'Ocultar'},
                ]
            }
        },
        watch: {
           value: function (id) {
               this.valorAtual = this.options.filter(el => el.id === this.value);
           }
        },
        mounted() {
            this.valorAtual = this.options.filter(el => el.id === this.value);
        },
        methods: {
            atualizarValor($event) {
                this.valorAtual =$event;
                this.$emit('input', $event.id);
            }
        }
    }
</script>

<style>
    .acessos-dos-privilegios .multiselect {
        min-height: 30px;
        font-size: 14px;
    }
    .acessos-dos-privilegios .multiselect__tags {
        min-height: 30px;
        height: 30px;
        padding: 4px 40px 0 4px;
    }
    .acessos-dos-privilegios .multiselect__select{
        height: 30px;
    }
    .acessos-dos-privilegios .multiselect__single {
        font-size: 14px;
    }
</style>
