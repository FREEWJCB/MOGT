import { bus } from '../../../bus.js'

const alergia = {
  namespaced: true,
  state: {
    allAlergia: [],
    alergia: {
      id: 0,
      nombre: '',
      descripcion: '',
      tipoAlergia_id: 0,
      tipo_a: ''
    }
  },
  mutations: {
    // Cargar datos
    loadingAllAlergia(state, payload){
      state.allAlergia = payload.value;
    },
    // Modificar Datos
    updateId(state, message){
      state.alergia.id = message;
    },
    updateAlergia(state, message){
      state.alergia.nombre = message;
    },
    updateDescripciones(state, message){
      state.alergia.descripcion = message;
    },
    updateTipoAlergia_id(state, message){
      state.alergia.tipoAlergia_id = message;
    },
    updateTipoAlergia(state, message){
      state.alergia.tipo_a = message;
    },
    updategAllAlergia(state, payload){
      state.allAlergia[payload.index].nombre = payload.value.nombre;
      state.allAlergia[payload.index].descripcion = payload.value.descripcion;
      state.allAlergia[payload.index].tipoAlergia_id = payload.value.tipoAlergia_id;
      state.allAlergia[payload.index].tipo_a = payload.value.tipo_a;
    },
    // Editar Datos
    editAlergia(state, item){
      state.alergia.id = item.id;
      state.alergia.nombre = item.nombre;
      state.alergia.descripcion = item.descripcion;
      state.alergia.tipoAlergia_id = item.tipoAlergia_id;
      state.alergia.tipo_a = item.name;
    },
    addAllAlergia(state, message){
      state.allAlergia.unshift({
        id: message.id,
        nombre: message.nombre,
        descripcion: message.descripcion,
        tipoAlergia_id: message.tipoAlergia_id,
        name: state.alergia.tipo_a,
        created_at: message.created_at,
        updated_at: message.updated_at,
      })
    },
    // Eliminar Datos
    deleteLastAllAlergia(state){
      state.allAlergia.pop();
    },
    deleteAlergia(state, id){
      state.allAlergia = state.allAlergia.filter((item) => {return item.id !== id;});
    },
    // Restablecer los datos
    cleanAlergia(state){
        state.alergia.id = 0;
        state.alergia.nombre = '';
        state.alergia.descripcion = '';
        state.alergia.tipoAlergia_id = 0;
        state.alergia.tipo_a = '';
    },
    cleanAllAlergia: state => state.allAlergia = []
  },
  getters: {
    getAllAlergia: state => state.allAlergia // Obtenr todos los registro
  },
  actions: {
    // create
    createAlergia({commit, state}, vista){
        axios.post('/alergia', {
          nombre: state.alergia.nombre,
          descripcion: state.alergia.descripcion,
          tipoAlergia_id: state.alergia.tipoAlergia_id,
        })
          .then((value) => {

            bus.alertMenssage({
              icon: 'fas fa-check',
              tipo: 'alert-success',
              msg: `Created <strong>${value.data.nombre}!</strong>`
            });
            bus.actualizarTotal( true ); // Para que verifique el Alergia

            commit("addAllAlergia", value.data);
            commit('cleanAlergia');

            if(state.allAlergia.length >= (vista+1)){
              commit("deleteLastAllAlergia");
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
    getAllAlergias({commit, state}, parametros){
      axios.get('/alergia', {
            params: {
              buscar: parametros.buscar,
              pag: parametros.pag,
            }
          })
            .then((value) => {
              commit("loadingAllAlergia", {value: value.data.alergia});
              bus.$emit('allTipoAlergia', value.data.tipos_a);
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
    updateAlergia({commit, state}){
        axios.put(`/alergia/${state.alergia.id}`,{
          nombre: state.alergia.nombre,
          descripcion: state.alergia.descripcion,
          tipoAlergia_id: state.alergia.tipoAlergia_id,
        })
          .then((value) => {
            state.allAlergia.forEach((item, i) => {
              if(item.id == state.alergia.id){

                commit('updategAllAlergia', {
                  index: i, value: {
                    nombre: state.alergia.nombre,
                    descripcion: state.alergia.descripcion,
                    tipoAlergia_id: state.alergia.tipoAlergia_id,
                    tipo_a: state.alergia.tipo_a
                  }
                });
              }
            });

            bus.alertMenssage({
              icon: 'fas fa-thumbs-up',
              tipo: 'alert-primary',
              msg: `Updated <strong>${state.alergia.nombre}!</strong>`
            });

            commit('cleanAlergia');
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
    deleteAlergia({commit, dispatch, state}, parametros){
       axios.delete(`/alergia/${parametros.id}`)
         .then((value) => {
          if (state.allAlergia.length == parametros.vista) {
            dispatch('getAllAlergias', {pag: parametros.pag, buscar: ''});
          } else {
            commit('deleteAlergia', parametros.id);
          }
          bus.alertMenssage({
            icon: 'fas fa-info-circle',
            tipo: 'alert-info',
            msg: `Deleted Discapacity!</strong>`
          });
          bus.actualizarTotal( true ); // Para que verifique el total de Alergia
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

export default alergia;
