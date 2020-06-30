<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Type Allergy</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          @click="clean">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="name" class="col-form-label">Tipo de Alergia:</label>
              <input type="text" class="form-control" id="name" name="name"
              v-model="name"
              v-validate="'required|min:4|alpha_spaces'"
              placeholder="Tipo de Discapacidad">
              <span class="text-danger">{{ errors.first('name') }}</span>
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
      return  this.$store.state.tipoAlergia.tipoAlergia.id;
    },
    name: {
      get() {
        return this.$store.state.tipoAlergia.tipoAlergia.name;
      },
      set(val) {
        this.$store.commit('tipoAlergia/updateTipoA', val);
      }
    },
    isComplete(){
      return (this.name == '')?false:true;
    }
  },
  methods: {
    ...mapActions('tipoAlergia', ['createTipoA', 'updateTipoA']),
    ...mapMutations('tipoAlergia', ['cleanTipoA']),
    save(){
      this.createTipoA(this.vista);
      this.clean();
    },
    update(){
      this.updateTipoA();
      setTimeout(() => this.clean(), 1000);
    },
    clean(){
      this.cleanTipoA();
      // Reset errors
      this.$validator.reset()
    },
  }
}
</script>

<style scoped>
</style>
