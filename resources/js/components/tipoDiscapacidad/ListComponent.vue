<template>
  <div class="row mt-2">
    <div class="col">
      <table class="table table-borderless table-hover table-responsive-xl">
        <caption v-if="total >= vista && all.length == vista">
          List of Type Discapacity {{  pag  * vista }} of {{ total }}
        </caption>
        <caption v-else-if="total >= vista && all.length < vista">
          List of Type Discapacity {{  (pag  * vista) - ( vista - all.length) }} of {{ total }}
        </caption>
        <caption v-else>
          Listo of Type Discapacity {{ total }}
        </caption>
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Tipo de Discapacidad</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center" v-for="td of all" :key="td.key">
            <th scope="row">{{td.id}}</th>
            <td>{{td.tipo_d}}</td>
            <td class="m-auto">
              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" @click="editTipoD(td)">
                <span class="fas fa-pencil-alt"></span> Edit
              </button>
              <button class="btn btn-danger" @click="deleteTipoD({id: td.id, pag: pag, vista: vista})">
                <span class="fas fa-trash"></span> Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
export default {
  props: {
    total: Number,
    pag: Number,
    vista: Number
  },
  computed: {
    ...mapGetters({
      all: 'tipoDiscapacidad/getAllTipoD'
    }),
  },
  methods: {
    ...mapActions('tipoDiscapacidad',['getAllTipoD', 'deleteTipoD']),
    ...mapMutations('tipoDiscapacidad', ['editTipoD'])
  },
  created() {
    //do something after creating vue instance
    this.getAllTipoD({ pag: this.$route.params.pag, buscar: ''});
  }
}
</script>

<style scoped>
</style>
