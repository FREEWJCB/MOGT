import Vue from 'vue'
import Vuex from 'vuex'
import tipoDiscapacidad from './modules/tipoDiscapacidad.js'
import discapacidad from './modules/discapacidad.js'
import tipoAlergia from './modules/tipoAlergia.js'
import alergia from './modules/alergia.js'
import cargo from './modules/cargo.js'
import estado from './modules/estado.js'
import municipio from './modules/municipio.js'
import parroquia from './modules/parroquia.js'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    tipoDiscapacidad,
    discapacidad,
    tipoAlergia,
    alergia,
    cargo,
    estado,
    municipio,
    parroquia
  }
})
