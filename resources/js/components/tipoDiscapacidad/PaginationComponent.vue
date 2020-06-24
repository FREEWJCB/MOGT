<template>
  <div class="row">
    <div class="col">
      <nav aria-label="Page navigation example" v-if="paginacion.total >=6">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled" v-if="paginacion.pag == 1">
            <a class="page-link" tabindex="-1" aria-disabled="true">
              <span class="fas fa-angle-double-left"></span>
            </a>
          </li>
          <li class="page-item" v-else>
            <router-link :to="{ name: ruta, params: { pag: 1 } }">
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
          <router-link :to="{ name: ruta, params: { pag: paginacion.pag - 1} }">
            <a class="page-link text-primary" tabindex="-1" aria-disabled="true">
              <span class="fas fa-angle-left"></span>
            </a>
          </router-link>
          </li>
          <li class="page-item" v-for="p in paginacion.paginas" :key="p.key">
            <router-link :to="{ name: ruta, params: { pag: p+1 } }">
              <a class="page-link">{{ p + 1 }}</a>
            </router-link>
          </li>
          <li class="page-item disabled" v-if="paginacion.paginas.length == paginacion.pag">
              <a class="page-link" aria-disabled="true">
                <span class="fas fa-angle-right"></span>
              </a>
          </li>
          <li class="page-item" v-else>
            <router-link :to="{ name: ruta, params: { pag: paginacion.pag + 1 } }">
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
            <router-link :to="{ name: ruta, params: { pag: paginacion.paginas.length } }">
              <a class="page-link text-primary">
                <span class="fas fa-angle-double-right"></span>
              </a>
            </router-link>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  props: {
    ruta: String,
    paginacion: Object
  },
  data(){
    return {
    }
  }
}
</script>

<style scoped>
</style>
