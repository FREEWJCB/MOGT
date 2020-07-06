import { bus } from '../../../bus.js'

const municipio = {
  namespaced: true,
  state: {
    allMunicipio: [],
    municipio: {
      id: 0,
      municipio: '',
      estado_id: 0,
      estado: ''
    }
  },
  mutations: {

      // Cargar datos
      loadingAllMunicipio(state, payload){
        state.allMunicipio = payload.value;
      },
      // Modificar Datos
      updateId(state, message){
        state.municipio.id = message;
      },
      updateMunicipio(state, message){
        state.municipio.municipio = message;
      },
      updateEstadoID(state, message){
        state.municipio.estado_id = message;
      },
      updateEstado(state, message){
        state.municipio.estado = message;
      },
      updategAllMunicipio(state, payload){
        state.allMunicipio[payload.index].municipio = payload.value.municipio;
        state.allMunicipio[payload.index].estado_id = payload.value.estado_id;
        state.allMunicipio[payload.index].estado = payload.value.estado;
      },
      // Editar Datos
      editMunicipio(state, item){
        state.municipio.id = item.id;
        state.municipio.municipio = item.municipio;
        state.municipio.estado_id = item.estado_id;
        state.municipio.estado = item.estado;
      },
      addAllMunicipio(state, message){
        state.allMunicipio.unshift({
          id: message.id,
          municipio: message.municipio,
          estado_id: message.estado_id,
          estado: state.municipio.estado,
          created_at: message.created_at,
          updated_at: message.updated_at,
        })
      },
      // Eliminar Datos
      deleteLastAllMunicipio(state){
        state.allMunicipio.pop();
      },
      deleteMunicipio(state, id){
        state.allMunicipio = state.allMunicipio.filter((item) => {return item.id !== id;});
      },
      // Restablecer los datos
      cleanMunicipio(state){
          state.municipio.id = 0;
          state.municipio.municipio = '';
          state.municipio.estado_id = 0;
          state.municipio.estado = '';
      },
      cleanAllMunicipio: state => state.allMunicipio = []
  },
  getters: {
    getAllMunicipio: state => state.allMunicipio // Obtenr todos los registro
  },
  actions: {
    // create
    createMunicipio({commit, state}, vista){
        axios.post('/municipio', {
          municipio: state.municipio.municipio,
          estado_id: state.municipio.estado_id,
        })
          .then((value) => {

            bus.alertMenssage({
              icon: 'fas fa-check',
              tipo: 'alert-success',
              msg: `Created <strong>${value.data.municipio}!</strong>`
            });
            bus.actualizarTotal( true ); // Para que verifique el Municipio

            commit("addAllMunicipio", value.data);
            commit('cleanMunicipio');

            if(state.allMunicipio.length >= (vista+1)){
              commit("deleteLastAllMunicipio");
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
    getAllMunicipios({commit, state}, parametros){
      axios.get('/municipio', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {
              commit("loadingAllMunicipio", {value: value.data.municipio});
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
    updateMunicipio({commit, state}){
        axios.put(`/municipio/${state.municipio.id}`,{
          municipio: state.municipio.municipio,
          estado_id: state.municipio.estado_id,
        })
          .then((value) => {
            state.allMunicipio.forEach((item, i) => {
              if(item.id == state.municipio.id){

                commit('updategAllMunicipio', {
                  index: i, value: {
                    municipio: state.municipio.municipio,
                    estado_id: state.municipio.estado_id,
                    estado: state.municipio.estado
                  }
                });
              }
            });

            bus.alertMenssage({
              icon: 'fas fa-thumbs-up',
              tipo: 'alert-primary',
              msg: `Updated <strong>${state.municipio.municipio}!</strong>`
            });

            commit('cleanMunicipio');
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
    deleteMunicipio({commit, dispatch, state}, parametros){
       axios.delete(`/municipio/${parametros.id}`)
         .then((value) => {
          if (state.allMunicipio.length == parametros.vista) {
            dispatch('getAllMunicipios', {pag: parametros.pag, buscar: ''});
          } else {
            commit('deleteMunicipio', parametros.id);
          }
          bus.alertMenssage({
            icon: 'fas fa-info-circle',
            tipo: 'alert-info',
            msg: `Deleted Municipaly!</strong>`
          });
          bus.actualizarTotal( true ); // Para que verifique el total de Municipio
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

export default municipio;
