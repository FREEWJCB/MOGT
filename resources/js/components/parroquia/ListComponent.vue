<template>
  <div class="row mt-2">
    <div class="col">
      <table class="table table-borderless table-hover table-responsive-xl">
        <caption v-if="total >= vista && all.length == vista">
          List of Parroquia {{  pag  * vista }} of {{ total }}
        </caption>
        <caption v-else-if="total >= vista && all.length < vista">
          List of Parroquia {{  (pag  * vista) - ( vista - all.length) }} of {{ total }}
        </caption>
        <caption v-else>
          Listo of Parroquia {{ total }}
        </caption>
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Parroquia</th>
            <th scope="col">Municipio</th>
            <th scope="col">Estado</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center" v-for="parroquia of all" :key="parroquia.key">
            <th scope="row">{{parroquia.id}}</th>
            <td>{{parroquia.parroquia}}</td>
            <td>{{parroquia.municipio}}</td>
            <td>{{parroquia.estado}}</td>
            <td class="m-auto">
              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" @click="editParroquia(parroquia)">
                <span class="fas fa-pencil-alt"></span> Edit
              </button>
              <button class="btn btn-danger" @click="deleteParroquia({id: parroquia.id, pag: pag, vista: vista})">
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
      all: 'parroquia/getAllParroquia'
    }),
  },
  methods: {
    ...mapActions('parroquia',['deleteParroquia']),
    ...mapMutations('parroquia', ['editParroquia'])
  }
}
</script>

<style scoped>
</style>
