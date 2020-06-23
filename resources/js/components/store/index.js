import Vue from 'vue'
import Vuex from 'vuex'
import tipoDiscapacidad from './modules/tipoDiscapacidad.js'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    tipoDiscapacidad
  }
})
