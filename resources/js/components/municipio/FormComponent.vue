<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Municipaly</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          @click="clean">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="estado_id" class="col-form-label">Estado:</label>
              <select class="form-control" name="estado"
              v-model="estado_id"
              v-validate="required">
                <option value="0"> Seleccione...</option>
                <template v-for="elem in estado">
                  <option :value="elem.id" @click="mandarestado(elem.estado)">{{ elem.estado }}</option>
                </template>
              </select>
              <span class="text-danger">{{ errors.first('estado') }}</span>
            </div>
            <div class="form-group">
              <label for="municipio" class="col-form-label">Municipio:</label>
              <input type="text" class="form-control" id="municipio" name="municipio"
              v-model="municipio"
              v-validate="'required|min:4|alpha_spaces'"
              placeholder="Tipo de municipio">
              <span class="text-danger">{{ errors.first('municipio') }}</span>
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
import { bus } from '../../bus.js'
export default {
  props: {
    vista: Number,
    required: true
  },
  data(){
    return {
      estado: []
    }
  },
  computed: {
    id(){
      return  this.$store.state.municipio.municipio.id;
    },
    estado_id: {
      get() {
        return this.$store.state.municipio.municipio.estado_id;
      },
      set(value) {
        this.$store.commit('municipio/updateEstadoID', value);
      }
    },
    municipio: {
      get() {
        return this.$store.state.municipio.municipio.municipio;
      },
      set(value) {
        this.$store.commit('municipio/updateMunicipio', value);
      }
    },
    isComplete(){
      let result = true;
      if(this.estado_id == 0){
        result = false;
      }
      if(this.municipio == ''){
        result = false;
      }
      return result;
    }
  },
  methods: {
    ...mapActions('municipio', ['createMunicipio', 'updateMunicipio']),
    ...mapMutations('municipio', ['cleanMunicipio']),
    save(){
      this.createMunicipio(this.vista);
      setTimeout(() => this.clean(), 1000);
    },
    update(){
      this.updateMunicipio();
      setTimeout(() => this.clean(), 1000);
    },
    clean(){
      this.cleanMunicipio();
      // Reset errors
      this.$validator.reset()
    },
    mandarestado(valor){
      this.$store.commit('municipio/updateEstado', valor);
    }
  },
  created() {
    //do something after creating vue instance
    bus.$on('allEstado', (estado)=>{
      this.estado = estado;
    });
  }
}
</script>

<style scoped>
</style>
