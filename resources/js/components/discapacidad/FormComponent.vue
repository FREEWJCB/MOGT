<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Discapacity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          @click="clean">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="tipoDiscapacidadId" class="col-form-label">Tipo de Discapacidad:</label>
              <select class="form-control" name="tipoDiscapacidadId"
              v-model="tipoDiscapacidadId"
              v-validate="required">
                <option value="0"> Seleccione...</option>
                <template v-for="elem in tipoDiscapacidad">
                  <option :value="elem.id" @click="mandarTipo(elem.tipo_d)">{{ elem.tipo_d }}</option>
                </template>
              </select>
              <span class="text-danger">{{ errors.first('tipoDiscapacidadId') }}</span>
            </div>
            <div class="form-group">
              <label for="discapacidad" class="col-form-label">Discapacidad:</label>
              <input type="text" class="form-control" id="discapacidad" name="discapacidad"
              v-model="discapacidad"
              v-validate="'required|min:4|alpha_spaces'"
              placeholder="Tipo de Discapacidad">
              <span class="text-danger">{{ errors.first('discapacidad') }}</span>
            </div>
            <div class="form-group">
              <label for="descripciones" class="col-form-label">Descripcion:</label>
              <textarea class="form-control" id="descripciones" name="descripciones"
              v-model="descripciones"
              v-validate="'required|min:4|alpha_spaces'"
              placeholder="Tipo de Discapacidad"></textarea>
              <span class="text-danger">{{ errors.first('descripciones') }}</span>
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
      tipoDiscapacidad: []
    }
  },
  computed: {
    id(){
      return  this.$store.state.discapacidad.discapacidad.id;
    },
    tipoDiscapacidadId: {
      get() {
        return this.$store.state.discapacidad.discapacidad.tipoDiscapacidadId;
      },
      set(value) {
        this.$store.commit('discapacidad/updateTipoDiscapacidadId', value);
      }
    },
    discapacidad: {
      get() {
        return this.$store.state.discapacidad.discapacidad.discapacidad;
      },
      set(value) {
        this.$store.commit('discapacidad/updateDiscapacidad', value);
      }
    },
    descripciones: {
      get() {
        return this.$store.state.discapacidad.discapacidad.descripciones;
      },
      set(value) {
        this.$store.commit('discapacidad/updateDescripciones', value);
      }
    },
    isComplete(){
      let result = true;
      if(this.tipoDiscapacidadId == 0){
        result = false;
      }
      if(this.discapacidad == ''){
        result = false;
      }
      if(this.descripciones == ''){
        result = false;
      }
      return result;
    }
  },
  methods: {
    ...mapActions('discapacidad', ['createDiscapacidad', 'updateDiscapacidad']),
    ...mapMutations('discapacidad', ['cleanDiscapacidad']),
    save(){
      this.createDiscapacidad(this.vista);
      setTimeout(() => this.clean(), 1000);
    },
    update(){
      this.updateDiscapacidad();
      setTimeout(() => this.clean(), 1000);
    },
    clean(){
      this.cleanDiscapacidad();
      // Reset errors
      this.$validator.reset()
    },
    mandarTipo(valor){
      this.$store.commit('discapacidad/updateTipoDiscapacidad', valor);
    }
  },
  created() {
    //do something after creating vue instance
    bus.$on('allTipoDiscapacidad', (tipoD)=>{
      this.tipoDiscapacidad = tipoD;
    });
  }
}
</script>

<style scoped>
</style>
