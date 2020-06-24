<template>
  <div>
    <!-- Error Messages -->
    <main class="mt-5">
      <div class="container bg-white">
        <div class="row justify-content-between">
          <div class="col-5 mt-2">
            <h2>List of Type Discapacity</h2>
          </div>
          <div class="col-3 mt-2">
            Maestro>Tipo de Discapacidad
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-2 mt-2">
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModal">
              <span class="fas fa-plus"></span> Add
            </button>
          </div>
          <!-- Search -->
        </div>
        <!-- Table -->
        <list/>
        <!-- Pagination -->
        <pagination
        ruta="tipoDiscapacidad"
        :paginacion="paginacion"/>
      </div>
    </main>
    <!-- Modal -->

  </div>
</template>

<script>
import List from './ListComponent.vue'
import Pagination from './PaginationComponent.vue'
import { mapActions } from 'vuex'
export default {
  components: {
    List,
    Pagination
  },
  data(){
    return {
      paginacion: {
        total: 0,
        pag: this.$route.params.pag, // obtener parametros de la url
        vista: 6, // resultados por ver
        paginas: [],
      },
    }
  },
  // computed: {
  //   isComplete(){
  //     return (this.tipoDiscapacidad.tipo_d == '')?false:true;
  //   }
  // },
  // watch: {
  //   // cuando 'busqueda' cambie, se ejecutará esta función
  //   busqueda: function (news) {
  //     this.getAll();
  //     if(this.busqueda != ''){
  //       this.paginacion.total = 1;
  //     } else {
  //       this.count();
  //     }
  //   }
  // },
  // methods: {
  //   getAll(){
  //     axios.get('/tipoDiscapacidad', {
  //       params: {
  //         buscar: this.busqueda,
  //         pag: this.paginacion.pag,
  //       }
  //     })
  //       .then((value) => {this.tiposDiscapacidad = value.data;})
  //       .catch((err) => {console.error(err);})
  //   },
  //   Buscar(){
  //     this.getAll();
  //     if(this.busqueda != ''){
  //       this.paginacion.total = 1;
  //     } else {
  //       this.count();
  //     }
  //   },
  //   createTipoD(){
  //     console.log(this.tipoDiscapacidad);
  //     axios.post('/tipoDiscapacidad', {tipo_d: this.tipoDiscapacidad.tipo_d})
  //       .then((value) => {
  //         this.tiposDiscapacidad.unshift({
  //           id: value.data.id,
  //           tipo_d: value.data.tipo_d,
  //           created_at: value.data.created_at,
  //           updated_at: value.data.updated_at,
  //         });
  //         if(this.paginacion.pag != this.paginacion.paginas.length){
  //           this.tiposDiscapacidad.pop();
  //         }
  //         this.clean();
  //         this.count();
  //         this.message.unshift({
  //           tipo: 'alert-success',
  //           msg: `Created <strong>${value.data.tipo_d}!</strong>.`
  //         });
  //       })
  //       .catch((err) => {console.error(err);})
  //   },
  //   editTipoD(item){
  //     this.tipoDiscapacidad.id = item.id;
  //     this.tipoDiscapacidad.tipo_d = item.tipo_d;
  //   },
  //   updateTipoD(){
  //     axios.put(`/tipoDiscapacidad/${this.tipoDiscapacidad.id}`,{
  //       tipo_d: this.tipoDiscapacidad.tipo_d
  //     })
  //       .then((value) => {
  //         console.log(this.tipoDiscapacidad.index);
  //         this.tiposDiscapacidad.forEach((item, i) => {
  //           if(item.id == this.tipoDiscapacidad.id){
  //             this.tiposDiscapacidad[i].tipo_d = this.tipoDiscapacidad.tipo_d;
  //           }
  //         });
  //         this.message.unshift({
  //           tipo: 'alert-info',
  //           msg: `Updated <strong>${this.tipoDiscapacidad.tipo_d}!</strong>.`
  //         });
  //
  //         this.clean();
  //       })
  //       .catch((err) => {console.error(err);})
  //   },
  //   deleteTipoD(id){
  //     axios.delete(`/tipoDiscapacidad/${id}`)
  //       .then((value) => {
  //         this.tiposDiscapacidad = this.tiposDiscapacidad.filter((item) => {
  //           if(item.id == id){
  //             this.message.unshift({
  //               tipo: 'alert-danger',
  //               msg: `Delete <strong>${item.tipo_d}!</strong>.`
  //             });
  //           }
  //           return item.id !== id;
  //         });
  //         this.count();
  //       })
  //       .catch((err) => {console.error(err);})
  //   },
  //   clean(){
  //     this.tipoDiscapacidad.id = 0;
  //     this.tipoDiscapacidad.tipo_d = '';
  //     // Reset errors
  //     this.$validator.reset()
  //   },
  //   count(){
  //     axios.get('/tipoDiscapacidad/contar')
  //       .then((value) => {
  //         this.paginacion.total = value.data;
  //         this.paginacion.paginas = [];
  //         for (var i = 0; i < (value.data / this.paginacion.vista); i++) {
  //           this.paginacion.paginas.push(i);
  //         }
  //       })
  //       .catch((err) => {console.error(err);})
  //
  //   }
  // },
  methods: {
        ...mapActions('tipoDiscapacidad',['getAllTipoD']),
    count(){
      axios.get('/tipoDiscapacidad/contar')
      .then((value) => {
        this.paginacion.total = value.data;
        this.paginacion.paginas = [];
        for (var i = 0; i < (value.data / this.paginacion.vista); i++) {
          this.paginacion.paginas.push(i);
        }
      })
      .catch((err) => {console.error(err);})

    }
  },
  beforeRouteUpdate (to, from, next) {
    // react to route changes...
    // don't forget to call next()
    this.paginacion.pag = to.params.pag;
    next(this.getAllTipoD(to.params.pag, ''));
  },
  // beforeRouteLeave (to, from, next) {
  //   const answer = window.confirm('Do you really want to leave? you have unsaved changes!')
  //   if (answer) {
  //     next()
  //   } else {
  //     next(false)
  //   }
  // },
  mounted() {
    //do something after mounting vue instance
    this.getAllTipoD();
    this.count();
  },
}
</script>

<style scoped>
</style>
