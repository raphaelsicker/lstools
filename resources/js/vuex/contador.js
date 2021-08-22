const state = {
    valor: 1
};

const mutations = {
    decrementMut: state => state.valor--,
    incrementMut: state => state.valor++
};

const getters = {
    meuValor: state => state.valor
};

const actions = {
    decrement: ({ commit }) => commit('decrementMut'),
    increment: ({ commit }) => commit('incrementMut')
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
