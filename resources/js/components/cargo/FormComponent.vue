<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Cargo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          @click="clean">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="nombre" class="col-form-label">Cargo:</label>
              <input type="text" class="form-control" id="nombre" name="cargo"
              v-model="nombre"
              v-validate="'required|min:4|alpha_spaces'"
              placeholder="Cargo">
              <span class="text-danger">{{ errors.first('cargo') }}</span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clean">Close</button>
          <button type="button" class="btn btn-primary"
          v-if="id === 0"
          @click="save"
          :disabled='errors.any() || !isComplete'>Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal"
          v-else
          @click="update"
          :disabled='errors.any() || !isComplete'>Update</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions, mapMutations } from 'vuex'
export default {
  props: {
    vista: Number,
    required: true
  },
  computed: {
    id(){
      return  this.$store.state.cargo.cargo.id;
    },
    nombre: {
      get() {
        return this.$store.state.cargo.cargo.nombre;
      },
      set(val) {
        this.$store.commit('cargo/updateCargo', val);
      }
    },
    isComplete(){
      return (this.nombre == '')?false:true;
    }
  },
  methods: {
    ...mapActions('cargo', ['createCargo', 'updateCargo']),
    ...mapMutations('cargo', ['cleanCargo']),
    save(){
      this.createCargo(this.vista);
      this.clean();
    },
    update(){
      this.updateCargo();
      setTimeout(() => this.clean(), 1000);
    },
    clean(){
      this.cleanCargo();
      // Reset errors
      this.$validator.reset()
    },
  }
}
</script>

<style scoped>
</style>
