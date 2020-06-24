const tipoDiscapacidad = {
  namespaced: true,
  state: {
    allTipoD: [],
    tipoDiscapacidad: {
      id: 0,
      tipo_d: ''
    }
  },
  mutations: {
    loadingAllTD(state, payload){
      state.allTipoD = payload.value
    },
    updateTipoD(state, message) {
      state.tipoDiscapacidad.tipo_d = message
    },
    updateId(state, message) {
      state.tipoDiscapacidad.id = message
    }
  },
  getters: {
    getAllTipoD: state => state.allTipoD
  },
  actions: {
    getAllTipoD: ({commit, state}, parametros) =>{
      axios.get('/tipoDiscapacidad', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {commit("loadingAllTD", {value: value.data});})
            .catch((err) => {console.error(err);})
    }
  }
}

export default tipoDiscapacidad
