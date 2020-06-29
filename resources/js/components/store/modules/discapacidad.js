import { bus } from '../../../bus.js'

const discapacidad = {
  namespaced: true,
  state: {
    allDiscapacidad: [],
    discapacidad: {
      id: 0,
      discapacidad: '',
      descripciones: '',
      tipoDiscapacidadId: 0,
      tipo_d: ''
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
    updateDescripciones(state, message){
      state.discapacidad.descripciones = message;
    },
    updateTipoDiscapacidadId(state, message){
      state.discapacidad.tipoDiscapacidadId = message;
    },
    updateTipoDiscapacidad(state, message){
      state.discapacidad.tipo_d = message;
    },
    updategAllDiscapacidad(state, payload){
      state.allDiscapacidad[payload.index].discapacidad = payload.value.discapacidad;
      state.allDiscapacidad[payload.index].descripciones = payload.value.descripciones;
      state.allDiscapacidad[payload.index].tipoDiscapacidadId = payload.value.tipoDiscapacidadId;
      state.allDiscapacidad[payload.index].tipo_d = payload.value.tipo_d;
    },
    // Editar Datos
    editDiscapacidad(state, item){
      state.discapacidad.id = item.id;
      state.discapacidad.discapacidad = item.discapacidad;
      state.discapacidad.descripciones = item.descripciones;
      state.discapacidad.tipoDiscapacidadId = item.tipoDiscapacidad_id;
      state.discapacidad.tipo_d = item.tipo_d;
    },
    addAllDiscapacidad(state, message){
      state.allDiscapacidad.unshift({
        id: message.id,
        discapacidad: message.discapacidad,
        descripciones: message.descripciones,
        tipoDiscapacidadId: message.tipoDiscapacidad_id,
        tipo_d: state.discapacidad.tipo_d,
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
        state.discapacidad.id = 0;
        state.discapacidad.discapacidad = '';
        state.discapacidad.descripciones = '';
        state.discapacidad.tipoDiscapacidadId = 0;
        state.discapacidad.tipo_d = '';
    },
    cleanAllDiscapacidad: state => state.allDiscapacidad = []
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
          tipoDiscapacidad_id: state.discapacidad.tipoDiscapacidadId,
        })
          .then((value) => {
            commit("addAllDiscapacidad", value.data);
              commit('cleanDiscapacidad');

            if(state.addAllDiscapacidad.length >= vista){
              commit("deleteLastAllDiscapacidad");
            }

            bus.alertMenssage({
              icon: 'fas fa-check',
              tipo: 'alert-success',
              msg: `Created <strong>${value.data.discapacidad}!</strong>`
            });
            bus.actualizarTotal( true ); // Para que verifique el total de Discapacidad
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
    getAllDiscapacidades({commit, state}, parametros){
      axios.get('/discapacidad', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {
              commit("loadingAllDiscapacidad", {value: value.data.discapacidades});
              bus.$emit('allTipoDiscapacidad', value.data.tipos_d);
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
    updateDiscapacidad({commit, state}){
        axios.put(`/discapacidad/${state.discapacidad.id}`,{
          discapacidad: state.discapacidad.discapacidad,
          descripciones: state.discapacidad.descripciones,
          tipoDiscapacidad_id: state.discapacidad.tipoDiscapacidadId,
        })
          .then((value) => {
            state.allDiscapacidad.forEach((item, i) => {
              if(item.id == state.discapacidad.id){

                commit('updategAllDiscapacidad', {
                  index: i, value: {
                    discapacidad: state.discapacidad.discapacidad,
                    descripciones: state.discapacidad.descripciones,
                    tipoDiscapacidadId: state.discapacidad.tipoDiscapacidadId,
                    tipo_d: state.discapacidad.tipo_d
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
       axios.delete(`/discapacidad/${parametros.id}`)
         .then((value) => {
          if (state.allDiscapacidad.length == parametros.vista) {
            dispatch('getAllDiscapacidades', {pag: parametros.pag, buscar: ''});
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
