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
    // Cargar datos
    loadingAllTD(state, payload){
      state.allTipoD = payload.value;
    },
    // Modificar Datos
    updateTipoD(state, message) {
      state.tipoDiscapacidad.tipo_d = message;
    },
    updateId(state, message) {
      state.tipoDiscapacidad.id = message;
    },
    updategAllTD(state, payload){
      state.allTipoD[payload.index].tipo_d = payload.value;
    },
    // Editar Datos
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
    // Eliminar Datos
    deleteLastAllTipoD(state){
      state.allTipoD.pop();
    },
    deleteTipoD(state, id){
      state.allTipoD = state.allTipoD.filter((item) => {return item.id !== id;});
    },
    // Restablecer los datos
    cleanTipoD(state){
      state.tipoDiscapacidad.id = 0;
      state.tipoDiscapacidad.tipo_d = '';
    },
    cleanAllTipoD: state => state.allTipoD = []
  },
  getters: {
    getAllTipoD: state => state.allTipoD // Obtener todos los registro
  },
  actions: {
    // Read
    getAllTipoD: ({commit, state}, parametros) =>{
      axios.get('/tipoDiscapacidad', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {commit("loadingAllTD", {value: value.data});})
            .catch((err) => {
              bus.alertMenssage({
                icon: 'fas fa-skull-crossbones',
                tipo: 'alert-danger',
                msg: `Error: <strong>${err.request.status}  ${err.request.statusText}!</strong>`
              });
            })
    },
    // Create
    createTipoD({commit, state}, vista){
        axios.post('/tipoDiscapacidad', {tipo_d: state.tipoDiscapacidad.tipo_d})
          .then((value) => {
            commit('cleanTipoD');
            commit("addAllTipoD", value.data);

            if(state.allTipoD.length >= (vista+1)){
              commit("deleteLastAllTipoD");
            }

            bus.alertMenssage({
              icon: 'fas fa-check',
              tipo: 'alert-success',
              msg: `Created <strong>${value.data.tipo_d}!</strong>`
            });
            bus.actualizarTotal( true ); // Para que verifique el total de Tipo de Discapacidad
          })
          .catch((err) => {
            bus.alertMenssage({
              icon: 'fas fa-skull-crossbones',
              tipo: 'alert-danger',
              msg: `Error: <strong>${err.request.status}  ${err.request.statusText}!</strong>`
            });
          })
      },
      // Update
      updateTipoD({commit, state}){
          axios.put(`/tipoDiscapacidad/${state.tipoDiscapacidad.id}`,{
            tipo_d: state.tipoDiscapacidad.tipo_d
          })
            .then((value) => {
              state.allTipoD.forEach((item, i) => {
                if(item.id == state.tipoDiscapacidad.id){

                  commit('updategAllTD', {index: i, value: state.tipoDiscapacidad.tipo_d});
                }
              });

              bus.alertMenssage({
                icon: 'fas fa-thumbs-up',
                tipo: 'alert-primary',
                msg: `Updated <strong>${state.tipoDiscapacidad.tipo_d}!</strong>`
              });

              commit('cleanTipoD');
            })
            .catch((err) => {
              bus.alertMenssage({
                icon: 'fas fa-skull-crossbones',
                tipo: 'alert-danger',
                msg: `Error: <strong>${err.request.status}  ${err.request.statusText}!</strong>`
              });
            })
        },
        // Delete
        deleteTipoD({commit, dispatch, state}, parametros){
           axios.delete(`/tipoDiscapacidad/${parametros.id}`)
             .then((value) => {
              if (state.allTipoD.length == parametros.vista) {
                dispatch('getAllTipoD', {pag: parametros.pag, buscar: ''});
              } else {
                commit('deleteTipoD', parametros.id);
              }
              bus.alertMenssage({
                icon: 'fas fa-info-circle',
                tipo: 'alert-info',
                msg: `Deleted Type Discapacity!</strong>`
              });
              bus.actualizarTotal( true ); // Para que verifique el total de Tipo de Discapacidad
             })
             .catch((err) => {
               bus.alertMenssage({
                 icon: 'fas fa-skull-crossbones',
                 tipo: 'alert-danger',
                 msg: `Error: <strong>${err.request.status}  ${err.request.statusText}!</strong>`
               });
             })
         }
  }
}

export default tipoDiscapacidad
