import { bus } from '../../../bus.js'

const cargo = {
  namespaced: true,
  state: {
    allCargo: [],
    cargo: {
      id: 0,
      nombre: ''
    }
  },
  mutations: {
    // Cargar datos
    loadingAllCargo(state, payload){
      state.allCargo = payload.value;
    },
    // Modificar Datos
    updateCargo(state, message) {
      state.cargo.nombre = message;
    },
    updateId(state, message) {
      state.cargo.id = message;
    },
    updateAllCargo(state, payload){
      state.allCargo[payload.index].nombre = payload.value;
    },
    // Editar Datos
    editCargo(state, item){
      state.cargo.id = item.id;
      state.cargo.nombre = item.nombre;
    },
    addAllCargo(state, message){
      state.allCargo.unshift({
        id: message.id,
        nombre: message.nombre,
        created_at: message.created_at,
        updated_at: message.updated_at,
      })
    },
    // Eliminar Datos
    deleteLastAllCargo(state){
      state.allCargo.pop();
    },
    deleteCargo(state, id){
      state.allCargo = state.allCargo.filter((item) => {return item.id !== id;});
    },
    // Restablecer los datos
    cleanCargo(state){
      state.cargo.id = 0;
      state.cargo.nombre = '';
    },
    cleanAllCargo: state => state.allCargo = []
  },
  getters: {
    getAllCargo: state => state.allCargo // Obtener todos los registro
  },
  actions: {
    // Create
    createCargo({commit, state}, vista){
        axios.post('/cargo', {
          nombre: state.cargo.nombre,
        })
          .then((value) => {

            bus.alertMenssage({
              icon: 'fas fa-check',
              tipo: 'alert-success',
              msg: `Created <strong>${value.data.nombre}!</strong>`
            });
            bus.actualizarTotal( true ); // Para que verifique el total de tipo de Alergia

            commit("addAllCargo", value.data);
            commit('cleanCargo');

            if(state.allDiscapacidad.length >= (vista+1)){
              commit("deleteLastAllCargo");
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
    getAllCargo({commit, state}, parametros){
      axios.get('/cargo', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {
              commit("loadingAllCargo", {value: value.data});
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
    updateCargo({commit, state}){
        axios.put(`/cargo/${state.cargo.id}`,{
          nombre: state.cargo.nombre
        })
          .then((value) => {
            state.allCargo.forEach((item, i) => {
              if(item.id == state.cargo.id){

                commit('updateAllCargo', { index: i, value: state.cargo.nombre });
              }
            });

            bus.alertMenssage({
              icon: 'fas fa-thumbs-up',
              tipo: 'alert-primary',
              msg: `Updated <strong>${state.cargo.nombre}!</strong>`
            });

            commit('cleanCargo');
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
    deleteCargo({commit, dispatch, state}, parametros){
       axios.delete(`/cargo/${parametros.id}`)
         .then((value) => {
          if (state.allCargo.length == parametros.vista) {
            dispatch('getAllCargo', {pag: parametros.pag, buscar: ''});
          } else {
            commit('deleteCargo', parametros.id);
          }
          bus.alertMenssage({
            icon: 'fas fa-info-circle',
            tipo: 'alert-info',
            msg: `Deleted Cargo!</strong>`
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

export default cargo;
