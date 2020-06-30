import { bus } from '../../../bus.js';

const tipoAlergia = {
  namespaced: true,
  state: {
    allTipoA: [],
    tipoAlergia: {
      id: 0,
      name: ''
    }
  },
  mutations: {
    // Cargar datos
    loadingAllTA(state, payload){
      state.allTipoA = payload.value;
    },
    // Modificar Datos
    updateTipoA(state, message) {
      state.tipoAlergia.name = message;
    },
    updateId(state, message) {
      state.tipoAlergia.id = message;
    },
    updateAllTipoA(state, payload){
      state.allTipoA[payload.index].name = payload.value;
    },
    // Editar Datos
    editTipoA(state, item){
      state.tipoAlergia.id = item.id;
      state.tipoAlergia.name = item.name;
    },
    addAllTipoA(state, message){
      state.allTipoA.unshift({
        id: message.id,
        name: message.name,
        created_at: message.created_at,
        updated_at: message.updated_at,
      })
    },
    // Eliminar Datos
    deleteLastAllTipoA(state){
      state.allTipoA.pop();
    },
    deleteTipoA(state, id){
      state.allTipoA = state.allTipoA.filter((item) => {return item.id !== id;});
    },
    // Restablecer los datos
    cleanTipoA(state){
      state.tipoAlergia.id = 0;
      state.tipoAlergia.name = '';
    },
    cleanAllTipoA: state => state.allTipoA = []
  },
  getters: {
    getAllTipoA: state => state.allTipoA // Obtener todos los registro
  },
  actions: {
    // Create
    createTipoA({commit, state}, vista){
        axios.post('/tipoAlergia', {
          name: state.tipoAlergia.name,
        })
          .then((value) => {

            bus.alertMenssage({
              icon: 'fas fa-check',
              tipo: 'alert-success',
              msg: `Created <strong>${value.data.name}!</strong>`
            });
            bus.actualizarTotal( true ); // Para que verifique el total de tipo de Alergia

            commit("addAllTipoA", value.data);
            commit('cleanTipoA');

            if(state.allDiscapacidad.length >= (vista+1)){
              commit("deleteLastAllTipoA");
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
    getAllTipoA({commit, state}, parametros){
      axios.get('/tipoAlergia', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {
              commit("loadingAllTA", {value: value.data});
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
    updateTipoA({commit, state}){
        axios.put(`/tipoAlergia/${state.tipoAlergia.id}`,{
          name: state.tipoAlergia.name
        })
          .then((value) => {
            state.allTipoA.forEach((item, i) => {
              if(item.id == state.tipoAlergia.id){

                commit('updateAllTipoA', { index: i, value: state.tipoAlergia.name });
              }
            });

            bus.alertMenssage({
              icon: 'fas fa-thumbs-up',
              tipo: 'alert-primary',
              msg: `Updated <strong>${state.tipoAlergia.name}!</strong>`
            });

            commit('cleanTipoA');
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
    deleteTipoA({commit, dispatch, state}, parametros){
       axios.delete(`/tipoAlergia/${parametros.id}`)
         .then((value) => {
          if (state.allTipoA.length == parametros.vista) {
            dispatch('getAllTipoA', {pag: parametros.pag, buscar: ''});
          } else {
            commit('deleteTipoA', parametros.id);
          }
          bus.alertMenssage({
            icon: 'fas fa-info-circle',
            tipo: 'alert-info',
            msg: `Deleted Alergy!</strong>`
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

export default tipoAlergia;
