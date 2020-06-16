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
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><span class="fas fa-angle-double-left"></span></a>
                </li>
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><span class="fas fa-angle-left"></span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#"><span class="fas fa-angle-right"></span></a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#"><span class="fas fa-angle-double-right"></span></a>
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Tipo de Discapacidad:</label>
                <input type="text" class="form-control" id="recipient-name" v-model="tipoDiscapacidad.tipo_d">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clean">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal"
            v-if="this.tipoDiscapacidad.id === 0"
            @click="createTipoD">Save</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal"
            v-else
            @click="updateTipoD">Update</button>
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
      }
    }
  },
  methods: {
    getAll(){
      axios.get('/tipoDiscapacidad', {buscar: ''})
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
    },
    count(){
      axios.get('/tipoDiscapacidad/contar')
        .then((value) => {this.paginacion.total = value.data})
    }
  },
  mounted() {
    //do something after mounting vue instance
    this.getAll();
  }

}
</script>

<style scoped>
</style>
