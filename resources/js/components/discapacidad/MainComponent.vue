<template>
  <div>
    <!-- Error Messages -->
    <error-message/>
    <main class="mt-5">
      <div class="container bg-white">
        <div class="row justify-content-between">
          <div class="col-5 mt-2">
            <h2>List of Discapacity</h2>
          </div>
          <div class="col-3 mt-2">
            <small>
              <span class="fas fa-home"></span> Maestro <span class="text-secondary">> Discapacidad</span>
            </small>
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-2 mt-2">
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModal">
              <span class="fas fa-plus"></span> Add
            </button>
          </div>
          <!-- Search -->
          <search
          :Buscar="getAllDiscapacidades"/>
        </div>
        <!-- Table -->
        <list
        :total="paginacion.total"
        :pag="paginacion.pag"
        :vista="paginacion.vista"/>
        <!-- Pagination -->
        <pagination
        ruta="discapacidad"
        :paginacion="paginacion"/>
      </div>
    </main>
    <!-- Modal -->
    <formulario
    :vista="paginacion.vista"/>
  </div>
</template>

<script>
import ErrorMessage from '../theme/MessageComponent.vue'
import Search from '../theme/SearchComponent.vue'
import Pagination from '../theme/PaginationComponent.vue'
import List from './ListComponent.vue'
import Formulario from './FormComponent.vue'
import { mapActions, mapMutations } from 'vuex'
import { bus } from '../../bus.js'
export default {
  components: {
    Search,
    List,
    Pagination,
    Formulario,
    ErrorMessage
  },
  data(){
    return {
      paginacion: {
        total: 0,
        pag: Number(this.$route.params.pag), // obtener parametros de la url
        vista: 6, // resultados por ver
        paginas: [],
      },
    }
  },
  methods: {
    ...mapActions('discapacidad',['getAllDiscapacidades']),
    ...mapMutations('discapacidad', ['cleanAllDiscapacidad']),
    count(){
      axios.get('/discapacidad/contar')
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
    next(this.getAllDiscapacidades({ pag: to.params.pag, buscar: ''}));
  },
  beforeRouteLeave (to, from, next) {
    const answer = window.confirm('Do you really want to leave?')
    if (answer) {
      next(this.cleanAllDiscapacidad())
    } else {
      next(false)
    }
  },
  created() {
    //do something after creating vue instance
    bus.$on('actualizarCount', (bol) => {
            if(bol) this.count();
        })
  },
  mounted() {
    //do something after mounting vue instance
    this.getAllDiscapacidades({ pag: this.$route.params.pag, buscar: ''});
    this.count();
  },
}
</script>

<style scoped>
</style>
