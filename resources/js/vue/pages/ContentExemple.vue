<template>
    <section id="main-content">
        <div class="content-title">
            <h3 class="main-title">Counter: {{ meuValor }}</h3>
            <button @click="decrement">Decrement</button>
            <button @click="increment">Increment</button>
        </div>
        <div class="inner-content">

        </div>
    </section>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    export default {
        name: "ContentExemple",
        computed: {
            ...mapGetters('contador', [
                'meuValor'
            ])
        },
        methods: mapActions('contador', [
            'decrement',
            'increment'
        ])
    }
</script>

<style scoped>

</style>
