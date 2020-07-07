import { bus } from '../../../bus.js'

const parroquia = {
  namespaced: true,
  state: {
    allParroquia: [],
    parroquia: {
      id: 0,
      parroquia: '',
      municipio_id: 0,
      municipio: '',
      estado_id: 0,
      estado: ''
    }
  },
  mutations: {
    // Cargar datos
    loadingAllParroquia(state, payload){
      state.allParroquia = payload.value;
    },
    // Modificar Datos
    updateId(state, message){
      state.parroquia.id = message;
    },
    updateParroquia(state, message){
      state.parroquia.parroquia = message;
    },
    updateMunicipio_id(state, message){
      state.parroquia.municipio_id = message;
    },
    updateMunicipio(state, message){
      state.parroquia.municipio = message;
    },
    updateEstado_id(state, message){
      state.parroquia.estado_id = message;
    },
    updateEstado(state, message){
      state.parroquia.estado = message;
    },
    updategAllParroquia(state, payload){
      state.allParroquia[payload.index].parroquia = payload.value.parroquia;
      state.allParroquia[payload.index].municipio_id = payload.value.municipio_id;
      state.allParroquia[payload.index].municipio = payload.value.municipio;
      state.allParroquia[payload.index].estado_id = payload.value.estado_id;
      state.allParroquia[payload.index].estado = payload.value.estado;
    },
    // Editar municipio
    editParroquia(state, item){
      state.parroquia.id = item.id;
      state.parroquia.parroquia = item.parroquia;
      state.parroquia.municipio_id = item.municipio_id;
      state.parroquia.municipio = item.municipio;
      state.parroquia.estado_id = item.estado_id;
      state.parroquia.estado = item.estado;
      bus.$emit('obtenerMunicipio');
    },
    addAllParroquia(state, message){
      state.allParroquia.unshift({
        id: message.id,
        parroquia: message.parroquia,
        municipio_id: message.municipio_id,
        municipio: state.parroquia.municipio,
        estado_id: state.parroquia.estado_id,
        estado: state.parroquia.estado,
        created_at: message.created_at,
        updated_at: message.updated_at,
      })
    },
    // Eliminar Datos
    deleteLastAllParroquia(state){
      state.allParroquia.pop();
    },
    deleteParroquia(state, id){
      state.allParroquia = state.allParroquia.filter((item) => {return item.id !== id;});
    },
    // Restablecer los datos
    cleanParroquia(state){
        state.parroquia.id = 0;
        state.parroquia.parroquia = '';
        state.parroquia.municipio_id = 0;
        state.parroquia.municipio = '';
        state.parroquia.estado_id = 0;
        state.parroquia.estado = '';
    },
    cleanAllParroquia: state => state.allParroquia = []
  },
  getters: {
    getAllParroquia: state => state.allParroquia // Obtenr todos los registro
  },
  actions: {
    // create
    createParroquia({commit, state}, vista){
        axios.post('/parroquia', {
          parroquia: state.parroquia.parroquia,
          municipio_id: state.parroquia.municipio_id,
        })
          .then((value) => {

            bus.alertMenssage({
              icon: 'fas fa-check',
              tipo: 'alert-success',
              msg: `Created <strong>${value.data.parroquia}!</strong>`
            });
            bus.actualizarTotal( true ); // Para que verifique el Parroquia

            commit("addAllParroquia", value.data);
            commit('cleanParroquia');

            if(state.allParroquia.length >= (vista+1)){
              commit("deleteLastAllParroquia");
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
    getAllParroquias({commit, state}, parametros){
      axios.get('/parroquia', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {
              commit("loadingAllParroquia", {value: value.data.parroquia});
              bus.$emit('allEstado', value.data.estado);
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
    updateParroquia({commit, state}){
        axios.put(`/parroquia/${state.parroquia.id}`,{
          parroquia: state.parroquia.parroquia,
          municipio_id: state.parroquia.municipio_id,
        })
          .then((value) => {
            state.allParroquia.forEach((item, i) => {
              if(item.id == state.parroquia.id){

                commit('updategAllParroquia', {
                  index: i, value: {
                    parroquia: state.parroquia.parroquia,
                    municipio_id: state.parroquia.municipio_id,
                    municipio: state.parroquia.municipio,
                    estado_id: state.parroquia.estado_id,
                    estado: state.parroquia.estado
                  }
                });
              }
            });

            bus.alertMenssage({
              icon: 'fas fa-thumbs-up',
              tipo: 'alert-primary',
              msg: `Updated <strong>${state.parroquia.parroquia}!</strong>`
            });

            commit('cleanParroquia');
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
    deleteParroquia({commit, dispatch, state}, parametros){
       axios.delete(`/parroquia/${parametros.id}`)
         .then((value) => {
          if (state.allParroquia.length == parametros.vista) {
            dispatch('getAllParroquias', {pag: parametros.pag, buscar: ''});
          } else {
            commit('deleteParroquia', parametros.id);
          }
          bus.alertMenssage({
            icon: 'fas fa-info-circle',
            tipo: 'alert-info',
            msg: `Deleted Discapacity!</strong>`
          });
          bus.actualizarTotal( true ); // Para que verifique el total de Parroquia
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

export default parroquia;
