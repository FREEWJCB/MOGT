<template>
  <div class="row mt-2">
    <div class="col">
      <table class="table table-borderless table-hover table-responsive-xl">
        <caption v-if="total >= vista && all.length == vista">
          List of Cargo {{  pag  * vista }} of {{ total }}
        </caption>
        <caption v-else-if="total >= vista && all.length < vista">
          List of Cargo {{  (pag  * vista) - ( vista - all.length) }} of {{ total }}
        </caption>
        <caption v-else>
          Listo of Cargo {{ total }}
        </caption>
        <thead class="thead-dark">
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Cargo</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr class="text-center" v-for="cargo of all" :key="cargo.key">
            <th scope="row">{{cargo.id}}</th>
            <td>{{cargo.nombre}}</td>
            <td class="m-auto">
              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" @click="editCargo(cargo)">
                <span class="fas fa-pencil-alt"></span> Edit
              </button>
              <button class="btn btn-danger" @click="deleteCargo({id: cargo.id, pag: pag, vista: vista})">
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
      all: 'cargo/getAllCargo'
    }),
  },
  methods: {
    ...mapActions('cargo',['deleteCargo']),
    ...mapMutations('cargo', ['editCargo'])
  }
}
</script>

<style scoped>
</style>
