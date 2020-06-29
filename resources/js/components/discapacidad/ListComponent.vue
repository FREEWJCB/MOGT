<template>
  <div class="row mt-2">
    <div class="col">
      <table class="table table-borderless table-hover table-responsive-xl">
        <caption v-if="total >= vista && all.length == vista">
          List of Discapacity {{  pag  * vista }} of {{ total }}
        </caption>
        <caption v-else-if="total >= vista && all.length < vista">
          List of Discapacity {{  (pag  * vista) - ( vista - all.length) }} of {{ total }}
        </caption>
        <caption v-else>
          Listo of Discapacity {{ total }}
        </caption>
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Tipo de Discapacidad</th>
            <th scope="col">Discapacidad</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center" v-for="discapacidad of all" :key="discapacidad.key">
            <th scope="row">{{discapacidad.id}}</th>
            <td>{{discapacidad.tipo_d}}</td>
            <td>{{discapacidad.discapacidad}}</td>
            <td>{{discapacidad.descripciones}}</td>
            <td class="m-auto">
              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" @click="editDiscapacidad(discapacidad)">
                <span class="fas fa-pencil-alt"></span> Edit
              </button>
              <button class="btn btn-danger" @click="deleteDiscapacidad({id: discapacidad.id, pag: pag, vista: vista})">
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
      all: 'discapacidad/getAllDiscapacidad'
    }),
  },
  methods: {
    ...mapActions('discapacidad',['deleteDiscapacidad']),
    ...mapMutations('discapacidad', ['editDiscapacidad'])
  }
}
</script>

<style scoped>
</style>
