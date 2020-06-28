<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Type Discapacity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          @click="clean">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="tipo_d" class="col-form-label">Tipo de Discapacidad:</label>
              <input type="text" class="form-control" id="tipo_d" name="tipo_d"
              v-model="tipo_d"
              v-validate="'required|min:4|alpha_spaces'"
              placeholder="Tipo de Discapacidad">
              <span class="text-danger">{{ errors.first('tipo_d') }}</span>
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
      return  this.$store.state.tipoDiscapacidad.tipoDiscapacidad.id;
    },
    tipo_d: {
      get() {
        return this.$store.state.tipoDiscapacidad.tipoDiscapacidad.tipo_d;
      },
      set(val) {
        this.$store.commit('tipoDiscapacidad/updateTipoD', val);
      }
    },
    isComplete(){
      return (this.tipo_d == '')?false:true;
    }
  },
  methods: {
    ...mapActions('tipoDiscapacidad', ['createTipoD', 'updateTipoD']),
    ...mapMutations('tipoDiscapacidad', ['cleanTipoD']),
    save(){
      this.createTipoD(this.vista);
      setTimeout(() => this.clean(), 1000);
    },
    update(){
      this.updateTipoD();
      setTimeout(() => this.clean(), 1000);
    },
    clean(){
      this.cleanTipoD();
      // Reset errors
      this.$validator.reset()
    },
  }
}
</script>

<style scoped>
</style>
