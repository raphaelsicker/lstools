import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'
import VuexORM from '@vuex-orm/core'
import VuexORMAxios from '@vuex-orm/plugin-axios'
import Estado from '../models2/Estado'

Vue.use(Vuex)
VuexORM.use(VuexORMAxios, { axios })

const database = new VuexORM.Database()

database.register(Estado)

const store = new Vuex.Store({
    plugins: [VuexORM.install(database)]
})

export default store
