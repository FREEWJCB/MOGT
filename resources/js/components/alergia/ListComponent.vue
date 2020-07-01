<template>
  <div class="row mt-2">
    <div class="col">
      <table class="table table-borderless table-hover table-responsive-xl">
        <caption v-if="total >= vista && all.length == vista">
          List of Allergy {{  pag  * vista }} of {{ total }}
        </caption>
        <caption v-else-if="total >= vista && all.length < vista">
          List of Allergy {{  (pag  * vista) - ( vista - all.length) }} of {{ total }}
        </caption>
        <caption v-else>
          Listo of Allergy {{ total }}
        </caption>
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Tipo de Alergia</th>
            <th scope="col">Alergia</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center" v-for="alergia of all" :key="alergia.key">
            <th scope="row">{{alergia.id}}</th>
            <td>{{alergia.name}}</td>
            <td>{{alergia.nombre}}</td>
            <td>{{alergia.descripcion}}</td>
            <td class="m-auto">
              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" @click="editAlergia(alergia)">
                <span class="fas fa-pencil-alt"></span> Edit
              </button>
              <button class="btn btn-danger" @click="deleteAlergia({id: alergia.id, pag: pag, vista: vista})">
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
      all: 'alergia/getAllAlergia'
    }),
  },
  methods: {
    ...mapActions('alergia',['deleteAlergia']),
    ...mapMutations('alergia', ['editAlergia'])
  }
}
</script>

<style scoped>
</style>
