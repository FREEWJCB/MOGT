import { bus } from '../../../bus.js'

const estado = {
  namespaced: true,
  state: {
    allEstado: [],
    estado: {
      id: 0,
      estado: ''
    }
  },
  mutations: {
    // Cargar datos
    loadingAllEstado(state, payload){
      state.allEstado = payload.value;
    },
    // Modificar Datos
    updateEstado(state, message) {
      state.estado.estado = message;
    },
    updateId(state, message) {
      state.estado.id = message;
    },
    updateAllEstado(state, payload){
      state.allEstado[payload.index].estado = payload.value;
    },
    // Editar Datos
    editEstado(state, item){
      state.estado.id = item.id;
      state.estado.estado = item.estado;
    },
    addAllEstado(state, message){
      state.allEstado.unshift({
        id: message.id,
        estado: message.estado,
        created_at: message.created_at,
        updated_at: message.updated_at,
      })
    },
    // Eliminar Datos
    deleteLastAllEstado(state){
      state.allEstado.pop();
    },
    deleteEstado(state, id){
      state.allEstado = state.allEstado.filter((item) => {return item.id !== id;});
    },
    // Restablecer los datos
    cleanEstado(state){
      state.estado.id = 0;
      state.estado.estado = '';
    },
    cleanAllEstado: state => state.allEstado = []
  },
  getters: {
    getAllEstado: state => state.allEstado // Obtener todos los registro
  },
  actions: {
    // Create
    createEstado({commit, state}, vista){
        axios.post('/estado', {
          estado: state.estado.estado,
        })
          .then((value) => {

            bus.alertMenssage({
              icon: 'fas fa-check',
              tipo: 'alert-success',
              msg: `Created <strong>${value.data.estado}!</strong>`
            });
            bus.actualizarTotal( true ); // Para que verifique el total de tipo de Alergia

            commit("addAllEstado", value.data);
            commit('cleanEstado');

            if(state.allDiscapacidad.length >= (vista+1)){
              commit("deleteLastAllEstado");
            }
          })
          .catch((err) => {
            if(err.response !== undefined){
              bus.alertMenssage({
                icon: 'fas fa-skull-crossbones',
                tipo: 'alert-danger',
                msg: `Error: <strong>${err.response.request.status}  ${err.response.request.statusText}!</strong>`
              });
            }
          })
      },
    // Read
    getAllEstado({commit, state}, parametros){
      axios.get('/estado', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {
              commit("loadingAllEstado", {value: value.data});
            })
            .catch((err) => {
              if(err.response !== undefined){
                bus.alertMenssage({
                  icon: 'fas fa-skull-crossbones',
                  tipo: 'alert-danger',
                  msg: `Error: <strong>${err.response.status}  ${err.response.request.statusText}!</strong>`
                });
              }
            })
    },
    // Update
    updateEstado({commit, state}){
        axios.put(`/estado/${state.estado.id}`,{
          estado: state.estado.estado
        })
          .then((value) => {
            state.allEstado.forEach((item, i) => {
              if(item.id == state.estado.id){

                commit('updateAllEstado', { index: i, value: state.estado.estado });
              }
            });

            bus.alertMenssage({
              icon: 'fas fa-thumbs-up',
              tipo: 'alert-primary',
              msg: `Updated <strong>${state.estado.estado}!</strong>`
            });

            commit('cleanEstado');
          })
          .catch((err) => {
            if(err.response  !== undefined){
              bus.alertMenssage({
                icon: 'fas fa-skull-crossbones',
                tipo: 'alert-danger',
                msg: `Error: <strong>${err.response.request.status}  ${err.response.request.statusText}!</strong>`
              });
            }
          })
      },
    // Delete
    deleteEstado({commit, dispatch, state}, parametros){
       axios.delete(`/estado/${parametros.id}`)
         .then((value) => {
          if (state.allEstado.length == parametros.vista) {
            dispatch('getAllEstado', {pag: parametros.pag, buscar: ''});
          } else {
            commit('deleteEstado', parametros.id);
          }
          bus.alertMenssage({
            icon: 'fas fa-info-circle',
            tipo: 'alert-info',
            msg: `Deleted Estado!</strong>`
          });
          bus.actualizarTotal( true ); // Para que verifique el total de Tipo de Alergia
         })
         .catch((err) => {
           if(err.response !== undefined){
             bus.alertMenssage({
               icon: 'fas fa-skull-crossbones',
               tipo: 'alert-danger',
               msg: `Error: <strong>${err.response.status}  ${err.response.request.statusText}!</strong>`
             });
           }
         })
     }
  }
};

export default estado;
