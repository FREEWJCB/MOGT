import { bus } from '../../../bus.js'

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
      state.allTipoD = payload.value;
    },
    updateTipoD(state, message) {
      state.tipoDiscapacidad.tipo_d = message;
    },
    updateId(state, message) {
      state.tipoDiscapacidad.id = message;
    },
    updategAllTD(state, payload){
      state.allTipoD[payload.index].tipo_d = payload.value;
    },
    editTipoD(state, item){
      state.tipoDiscapacidad.id = item.id;
      state.tipoDiscapacidad.tipo_d = item.tipo_d;
    },
    addAllTipoD(state, message){
      state.allTipoD.unshift({
        id: message.id,
        tipo_d: message.tipo_d,
        created_at: message.created_at,
        updated_at: message.updated_at,
      })
    },
    deleteLastAllTipoD(state){
      state.allTipoD.pop();
    },
    deleteTipoD(state, id){
      state.allTipoD = state.allTipoD.filter((item) => {return item.id !== id;});
    },
    cleanTipoD(state){
      state.tipoDiscapacidad.id = 0;
      state.tipoDiscapacidad.tipo_d = '';
    },
    cleanAllTipoD: state => state.allTipoD = []
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
    },
    createTipoD({commit, state}){
        axios.post('/tipoDiscapacidad', {tipo_d: state.tipoDiscapacidad.tipo_d})
          .then((value) => {
            commit('cleanTipoD');
            commit("addAllTipoD", value.data);
            // if(this.paginacion.pag != this.paginacion.paginas.length){
            commit("deleteLastAllTipoD");
            // }
            // this.clean();
            // this.count();
            // this.message.unshift({
            //   tipo: 'alert-success',
            //   msg: `Created <strong>${value.data.tipo_d}!</strong>.`
            // });
            bus.actualizarTotal( true ); // Para que verifique el total de Tipo de Discapacidad
          })
          .catch((err) => {console.error(err);})
      },
      updateTipoD({commit, state}){
          axios.put(`/tipoDiscapacidad/${state.tipoDiscapacidad.id}`,{
            tipo_d: state.tipoDiscapacidad.tipo_d
          })
            .then((value) => {
              state.allTipoD.forEach((item, i) => {
                if(item.id == state.tipoDiscapacidad.id){
                  // state.allTipoD[i].tipo_d = state.tipoDiscapacidad.tipo_d;
                  commit('updategAllTD', {index: i, value: state.tipoDiscapacidad.tipo_d});
                }
              });
              commit('cleanTipoD');
              // this.message.unshift({
              //   tipo: 'alert-info',
              //   msg: `Updated <strong>${this.tipoDiscapacidad.tipo_d}!</strong>.`
              // });

              // this.clean();
            })
            .catch((err) => {console.error(err);})
        },
        deleteTipoD({commit, dispatch, state}, parametros){
           axios.delete(`/tipoDiscapacidad/${parametros.id}`)
             .then((value) => {
              if (state.allTipoD.length == parametros.vista) {
                dispatch('getAllTipoD', {pag: parametros.pag, buscar: ''});
              } else {
                commit('deleteTipoD', parametros.id);
              }
              bus.actualizarTotal( true ); // Para que verifique el total de Tipo de Discapacidad
             })
             .catch((err) => {console.error(err);})
         }
  }
}

export default tipoDiscapacidad
