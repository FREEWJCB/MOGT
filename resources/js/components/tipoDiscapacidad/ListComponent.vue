<template>
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
          <tr class="text-center" v-for="td of all" :key="td.key">
            <th scope="row">{{td.id}}</th>
            <td>{{td.tipo_d}}</td>
            <td class="m-auto">
              <!-- <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" @click="editTipoD(td)"> -->
              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                <span class="fas fa-pencil-alt"></span> Edit
              </button>
              <!-- <button class="btn btn-danger" @click="deleteTipoD(td.id)"> -->
              <button class="btn btn-danger">
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
import { mapActions, mapGetters } from 'vuex'
export default {
  computed: mapGetters({
    all: 'tipoDiscapacidad/getAllTipoD'
  }),
  methods: {
    ...mapActions('tipoDiscapacidad',['getAllTipoD']),
  },
  created() {
    //do something after creating vue instance
    this.getAllTipoD({ pag: this.$route.params.pag, buscar: ''});
  }
}
</script>

<style scoped>
</style>
