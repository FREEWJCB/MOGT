<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New State</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          @click="clean">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="estado" class="col-form-label">Estado:</label>
              <input type="text" class="form-control" id="estado" name="estado"
              v-model="estado"
              v-validate="'required|min:4|alpha_spaces'"
              placeholder="Estado">
              <span class="text-danger">{{ errors.first('estado') }}</span>
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
      return  this.$store.state.estado.estado.id;
    },
    estado: {
      get() {
        return this.$store.state.estado.estado.estado;
      },
      set(val) {
        this.$store.commit('estado/updateEstado', val);
      }
    },
    isComplete(){
      return (this.estado == '')?false:true;
    }
  },
  methods: {
    ...mapActions('estado', ['createEstado', 'updateEstado']),
    ...mapMutations('estado', ['cleanEstado']),
    save(){
      this.createEstado(this.vista);
      this.clean();
    },
    update(){
      this.updateEstado();
      setTimeout(() => this.clean(), 1000);
    },
    clean(){
      this.cleanEstado();
      // Reset errors
      this.$validator.reset()
    },
  }
}
</script>

<style scoped>
</style>
