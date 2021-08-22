<template>
    <section id="main-content">
        <div class="content-title">
            <button @click="updateData">Alterar</button>

            {{estado}}
        </div>
        <div class="inner-content">

            <pre>
            {{estados}}
            </pre>
        </div>
    </section>
</template>

<script>
    import Estado from "../../models2/Estado";
    export default {
        name: "Teste",
        data() {
            return {
                estado: null
            }
        },
        computed: {
            estados: () => Estado.all(),
            teste: () => Estado.find(11)
        },
        created() {
            this.load();
        },
        methods: {
            async updateData() {
                //await Estado.fetch();
                //Estado.save({sigla: "RD"}, 11);
            },
            async load() {
                this.estado = await Estado.get();

                //await Estado.fetchById(11);



            }
        }
    }
</script>

<style scoped>

</style>
