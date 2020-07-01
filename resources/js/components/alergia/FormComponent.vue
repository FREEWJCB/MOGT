<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Allergy</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          @click="clean">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="tipoAlergia_id" class="col-form-label">Tipo de Alergia:</label>
              <select class="form-control" name="tipoAlergia_id"
              v-model="tipoAlergia_id"
              v-validate="required">
                <option value="0"> Seleccione...</option>
                <template v-for="elem in tipoAlergia">
                  <option :value="elem.id" @click="mandarTipo(elem.name)">{{ elem.name }}</option>
                </template>
              </select>
              <span class="text-danger">{{ errors.first('tipoAlergia_id') }}</span>
            </div>
            <div class="form-group">
              <label for="nombre" class="col-form-label">Alergia:</label>
              <input type="text" class="form-control" id="nombre" name="nombre"
              v-model="nombre"
              v-validate="'required|min:4|alpha_spaces'"
              placeholder="Tipo de Alergia">
              <span class="text-danger">{{ errors.first('nombre') }}</span>
            </div>
            <div class="form-group">
              <label for="descripcion" class="col-form-label">Descripcion:</label>
              <textarea class="form-control" id="descripcion" name="descripcion"
              v-model="descripcion"
              v-validate="'required|min:4|alpha_spaces'"
              placeholder="Tipo de Alergia"></textarea>
              <span class="text-danger">{{ errors.first('descripcion') }}</span>
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
      tipoAlergia: []
    }
  },
  computed: {
    id(){
      return  this.$store.state.alergia.alergia.id;
    },
    tipoAlergia_id: {
      get() {
        return this.$store.state.alergia.alergia.tipoAlergia_id;
      },
      set(value) {
        this.$store.commit('alergia/updateTipoAlergia_id', value);
      }
    },
    nombre: {
      get() {
        return this.$store.state.alergia.alergia.nombre;
      },
      set(value) {
        this.$store.commit('alergia/updateAlergia', value);
      }
    },
    descripcion: {
      get() {
        return this.$store.state.alergia.alergia.descripcion;
      },
      set(value) {
        this.$store.commit('alergia/updateDescripciones', value);
      }
    },
    isComplete(){
      let result = true;
      if(this.tipoAlergia_id == 0){
        result = false;
      }
      if(this.nombre == ''){
        result = false;
      }
      if(this.descripcion == ''){
        result = false;
      }
      return result;
    }
  },
  methods: {
    ...mapActions('alergia', ['createAlergia', 'updateAlergia']),
    ...mapMutations('alergia', ['cleanAlergia']),
    save(){
      this.createAlergia(this.vista);
      setTimeout(() => this.clean(), 1000);
    },
    update(){
      this.updateAlergia();
      setTimeout(() => this.clean(), 1000);
    },
    clean(){
      this.cleanAlergia();
      // Reset errors
      this.$validator.reset()
    },
    mandarTipo(valor){
      this.$store.commit('alergia/updateTipoAlergia', valor);
    }
  },
  created() {
    //do something after creating vue instance
    bus.$on('allTipoAlergia', (tipoA)=>{
      this.tipoAlergia = tipoA;
    });
  }
}
</script>

<style scoped>
</style>
