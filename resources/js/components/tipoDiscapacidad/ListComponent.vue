<template>
  <div>
    <main class="mt-5">
      <div class="container bg-white">
        <div class="row justify-content-between">
          <div class="col-8 mt-2">
            <h2>List of Type Discapacity</h2>
          </div>
          <div class="col-2 mt-2">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
              <span class="fas fa-plus"></span> Add
            </button>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            <table class="table table-borderless table-hover table-responsive-xl">
              <caption>List of Type Discapacity</caption>
              <thead class="thead-dark">
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">Tipo de Discapacidad</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr class="text-center" v-for="td of tiposDiscapacidad" :key="td.key">
                  <th scope="row">{{td.id}}</th>
                  <td>{{td.tipo_d}}</td>
                  <td class="m-auto">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" @click="editTipoD(td)">
                      <span class="fas fa-pencil-alt"></span> Edit
                    </button>
                    <button class="btn btn-danger" @click="deleteTipoD(td.id)">
                      <span class="fas fa-trash"></span> Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled" v-if="paginacion.pag == 1">
                  <a class="page-link" tabindex="-1" aria-disabled="true">
                    <span class="fas fa-angle-double-left"></span>
                  </a>
                </li>
                <li class="page-item" v-else>
                  <router-link :to="{ name: 'tipoDiscapacidad', params: { pag: 1 } }">
                    <a class="page-link text-primary" tabindex="-1" aria-disabled="true">
                      <span class="fas fa-angle-double-left"></span>
                    </a>
                  </router-link>
                </li>
                <li class="page-item disabled" v-if="paginacion.pag == 1">
                  <a class="page-link" tabindex="-1" aria-disabled="true">
                    <span class="fas fa-angle-left"></span>
                  </a>
                </li>
                <li class="page-item" v-else>
                <router-link :to="{ name: 'tipoDiscapacidad', params: { pag: paginacion.pag - 1} }">
                  <a class="page-link text-primary" tabindex="-1" aria-disabled="true">
                    <span class="fas fa-angle-left"></span>
                  </a>
                </router-link>
                </li>
                <li class="page-item" v-for="p in paginacion.paginas" :key="p.key">
                  <router-link :to="{ name: 'tipoDiscapacidad', params: { pag: p+1 } }">
                    <a class="page-link">{{ p + 1 }}</a>
                  </router-link>
                </li>
                <li class="page-item disabled" v-if="paginacion.paginas.length == paginacion.pag">
                    <a class="page-link" aria-disabled="true">
                      <span class="fas fa-angle-right"></span>
                    </a>
                </li>
                <li class="page-item" v-else>
                  <router-link :to="{ name: 'tipoDiscapacidad', params: { pag: paginacion.pag + 1 } }">
                    <a class="page-link text-primary">
                      <span class="fas fa-angle-right"></span>
                    </a>
                  </router-link>
                </li>
                <li class="page-item disabled" v-if="paginacion.paginas.length == paginacion.pag">
                  <a class="page-link" aria-disabled="true">
                    <span class="fas fa-angle-double-right"></span>
                  </a>
                </li>
                <li class="page-item" v-else>
                  <router-link :to="{ name: 'tipoDiscapacidad', params: { pag: paginacion.paginas.length } }">
                    <a class="page-link text-primary">
                      <span class="fas fa-angle-double-right"></span>
                    </a>
                  </router-link>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Type Discapacity</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="clean">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tipo de Discapacidad:</label>
                <input type="text" class="form-control" id="recipient-name" name="recipient-name"
                v-model="tipoDiscapacidad.tipo_d"
                v-validate="'required|min:4|alpha_spaces'">
                <span class="text-danger">{{ errors.first('recipient-name') }}</span>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clean">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal"
            v-if="this.tipoDiscapacidad.id === 0"
            @click="createTipoD"
            :disabled='errors.any() || !isComplete'>Save</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal"
            v-else
            @click="updateTipoD"
            :disabled='errors.any() || !isComplete'>Update</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      tiposDiscapacidad: [],
      tipoDiscapacidad: {
        id: 0,
        tipo_d: '',
      },
      paginacion: {
        total: 0,
        pag: this.$route.params.pag, // obtener parametros de la url
        vista: 6, // resultados por ver
        paginas: [],
      }
    }
  },
  computed: {
    isComplete(){
      return (this.tipoDiscapacidad.tipo_d == '')?false:true;
    }
  },
  methods: {
    getAll(){
      axios.get('/tipoDiscapacidad', {
        params: {
          buscar: '',
          pag: this.paginacion.pag,
        }
      })
        .then((value) => {this.tiposDiscapacidad = value.data;})
        .catch((err) => {console.error(err);})
    },
    createTipoD(){
      console.log(this.tipoDiscapacidad);
      axios.post('/tipoDiscapacidad', {tipo_d: this.tipoDiscapacidad.tipo_d})
        .then((value) => {
          this.tiposDiscapacidad.unshift({
            id: value.data.id,
            tipo_d: value.data.tipo_d,
            created_at: value.data.created_at,
            updated_at: value.data.updated_at,
          });
          if(this.paginacion.pag != this.paginacion.paginas.length){
            this.tiposDiscapacidad.pop();
          }
          this.clean();
        })
        .catch((err) => {console.error(err);})
    },
    editTipoD(item){
      this.tipoDiscapacidad.id = item.id;
      this.tipoDiscapacidad.tipo_d = item.tipo_d;
    },
    updateTipoD(){
      axios.put(`/tipoDiscapacidad/${this.tipoDiscapacidad.id}`,{
        tipo_d: this.tipoDiscapacidad.tipo_d
      })
        .then((value) => {
          console.log(this.tipoDiscapacidad.index);
          this.tiposDiscapacidad.forEach((item, i) => {
            if(item.id == this.tipoDiscapacidad.id){
              this.tiposDiscapacidad[i].tipo_d = this.tipoDiscapacidad.tipo_d;
            }
          });

          this.clean();
        })
        .catch((err) => {console.error(err);})
    },
    deleteTipoD(id){
      axios.delete(`/tipoDiscapacidad/${id}`)
        .then((value) => {
          this.tiposDiscapacidad = this.tiposDiscapacidad.filter((item) => {
            return item.id !== id;
          });
        })
        .catch((err) => {console.error(err);})
    },
    clean(){
      this.tipoDiscapacidad.id = 0;
      this.tipoDiscapacidad.tipo_d = '';
      // Reset errors
      this.$validator.reset()
    },
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
    next(this.getAll());
  },
  beforeRouteLeave (to, from, next) {
    const answer = window.confirm('Do you really want to leave? you have unsaved changes!')
    if (answer) {
      next()
    } else {
      next(false)
    }
  },
  mounted() {
    //do something after mounting vue instance
    this.getAll();
    this.count();
  },
}
</script>

<style scoped>
</style>
