<template>
    <b-form @submit.prevent="onSubmit">
        <input type="hidden" v-model="city.id">
        <content-title title="Cidades" subTitle="Cadastro" id="divDelete">
            <b-button
                variant="success" pill
                type="submit"
                v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-save"></i></b-button>
            <b-button
                id="btnDelete"
                v-show="city.id"
                variant="danger" pill
                v-b-popover.hover.top="'Salvar'"
                ><i class="fas fa-trash"></i></b-button>
            <b-popover
                :show.sync="popoverDelete"
                target="btnDelete"
                triggers="click"
                placement="bottom"
                >
                <template v-slot:title>Tem certeza que deseja excluir essa Cidade?</template>
                <div class="text-right">
                    <b-button @click="cancelRemove" size="sm" variant="danger">Cancelar</b-button>
                    <b-button @click="remove" size="sm" variant="info">Excluir</b-button>
                </div>
            </b-popover>
        </content-title>
        <div class="content-fields">
            <b-col md="2" class="form-field">
                <b-form-group
                    id="fieldset-uf"
                    label="Estado"
                    label-for="uf"
                >
                    <uf-select v-model="city.uf" @input="updateUf"/>
                </b-form-group>
            </b-col>
            <b-col md="10" class="form-field">
                <b-form-group
                    id="fieldset-name"
                    label="Nome"
                    label-for="name">
                    <b-form-input id="nome" v-model="city.name" trim/>
                </b-form-group>

            </b-col>
        </div>
    </b-form>
</template>

<script>
    import ContentTitle from "../../components/ContentTitle";
    import City from "../../../models/City";
    import UfSelect from "../Uf/select";

    export default {
        name: "CityEdit",
        components: {UfSelect, ContentTitle},
        props: ['value'],
        data() {
            return {
                city: City.new(),
                url: '/cities/',
                exibirDelete: true,
                popoverDelete: false,
                carregandoCidades: false
            }
        },
        created() {
            this.load(this.value)
        },
        watch: {
            value: function(newVal) {
                this.load(newVal)
            }
        },
        methods: {
            async load(id) {
                console.log('id', id)
                this.city = id ? await City.find(id) : City.new();
            },
            fill(city = []) {
                for(let campo in city) {
                    this.cidade[campo] = city[campo] ?? null;
                }
                this.updateHistory(city.id ?? '');
                this.$emit('reloadGrid');
            },
            updateUf(uf = {}) {
                this.city.uf_id = uf.id;
            },
            onSubmit() {
                this.city = City.save(this.city)
                this.alert('Cidade salva com sucesso');

                this.$emit('reloadGrid')
                this.updateHistory(this.city.id ?? '')
            },
            cancelRemove() {
                this.popoverDelete = false;
            },
            remove() {
                this.popoverDelete = false;
                City.delete(this.city.id);

                this.alert('Cidade removida com sucesso');
                this.city = City.new();

                this.$emit('reloadGrid')
                this.updateHistory('')
            },
            updateHistory(id = '') {
                history.pushState({}, null, this.url + id);
            },
            alert(
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
