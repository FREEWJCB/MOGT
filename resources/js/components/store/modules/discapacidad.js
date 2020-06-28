import { bus } from '../../../bus.js'

const discapacidad = {
  namespaced: true,
  state: {
    allDiscapacidad: [],
    discapacidad: {
      id: 0,
      discapacidad: '',
      descripciónes: '',
      tipoDiscapacidadId: 0
    }
  },
  mutations: {
    // Cargar datos
    loadingAllDiscapacidad(state, payload){
      state.allDiscapacidad = payload.value;
    },
    // Modificar Datos
    updateId(state, message){
      state.discapacidad.id = message;
    },
    updateDiscapacidad(state, message){
      state.discapacidad.discapacidad = message;
    },
    updateDescaripciones(state, message){
      state.discapacidad.descripciónes = message;
    },
    updateTipoDiscapacidad(state, message){
      state.discapacidad.tipoDiscapacidad = message;
    },
    updategAllDiscapacidad(state, payload){
      state.allDiscapacidad[payload.index].discapacidad = payload.value.discapacidad;
      state.allDiscapacidad[payload.index].descripciónes = payload.value.descripciones;
      state.allDiscapacidad[payload.index].tipoDiscapacidad = payload.value.tipoDiscapacidad;
    },
    // Editar Datos
    editDiscapacidad(state, item){
      state.discapacidad.id = item.id;
      state.discapacidad.discapacidad = item.discapacidad;
      state.discapacidad.descripciónes = item.descripciónes;
      state.discapacidad.tipoDiscapacidad = item.tipoDiscapacidad;
    },
    addAllDiscapacidad(state, message){
      state.allDiscapacidad.unshift({
        id: message.id,
        discapacidad: message.discapacidad,
        descripciónes: message.descripciónes,
        tipoDiscapacidad: message.tipoDiscapacidad_id,
        created_at: message.created_at,
        updated_at: message.updated_at,
      })
    },
    // Eliminar Datos
    deleteLastAllDiscapacidad(state){
      state.allDiscapacidad.pop();
    },
    deleteDiscapacidad(state, id){
      state.allDiscapacidad = state.allDiscapacidad.filter((item) => {return item.id !== id;});
    },
    // Restablecer los datos
    cleanDiscapacidad(state){
        state.discapacidad.id = item.id;
        state.discapacidad.discapacidad = item.discapacidad;
        state.discapacidad.descripciónes = item.descripciónes;
        state.discapacidad.tipoDiscapacidad = item.tipoDiscapacidad;
    }
  },
  getters: {
    getAllDiscapacidad: state => state.allDiscapacidad // Obtenr todos los registro
  },
  actions: {
    // create
    createDiscapacidad({commit, state}, vista){
        axios.post('/discapacidad', {
          discapacidad: state.discapacidad.discapacidad,
          descripciones: state.discapacidad.descripciones,
          tipoDiscapacidad_id: state.discapacidad.tipoDiscapacidad,
        })
          .then((value) => {
            commit('cleanDiscapacidad');
            commit("addAllDiscapacidad", value.data);

            if(state.addAllDiscapacidad.length >= vista){
              commit("deleteLastAllDiscapacidad");
            }

            bus.alertMenssage({
              icon: 'fas fa-check',
              tipo: 'alert-success',
              msg: `Created <strong>${value.data.discapacidad}!</strong>`
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
    // Read
    getAllTipoD({commit, state}, parametros){
      axios.get('/discapacidad', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {commit("loadingAllDiscapacidad", {value: value.data});})
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
        axios.put(`/discapacidad/${state.discapacidad.id}`,{
          discapacidad: state.discapacidad.discapacidad,
          descripciones: state.discapacidad.descripciones,
          tipoDiscapacidad_id: state.discapacidad.tipoDiscapacidad,
        })
          .then((value) => {
            state.allDiscapacidad.forEach((item, i) => {
              if(item.id == state.discapacidad.id){

                commit('updategAllDiscapacidad', {
                  index: i, value: {
                    state.discapacidad.discapacidad,
                    state.discapacidad.descripciones,
                    state.discapacidad.tipoDiscapacidad
                  }
                });
              }
            });

            bus.alertMenssage({
              icon: 'fas fa-thumbs-up',
              tipo: 'alert-primary',
              msg: `Updated <strong>${state.discapacidad.discapacidad}!</strong>`
            });

            commit('cleanDiscapacidad');
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
    deleteDiscapacidad({commit, dispatch, state}, parametros){
       axios.delete(`/tipoDiscapacidad/${parametros.id}`)
         .then((value) => {
          if (state.allDiscapacidad.length == parametros.vista) {
            dispatch('getAllDiscapacidad', {pag: parametros.pag, buscar: ''});
          } else {
            commit('deleteDiscapacidad', parametros.id);
          }
          bus.alertMenssage({
            icon: 'fas fa-info-circle',
            tipo: 'alert-info',
            msg: `Deleted Discapacity!</strong>`
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

export default discapacidad
