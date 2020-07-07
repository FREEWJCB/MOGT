<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Parroquia</h5>
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
                <template v-for="elem in estados">
                  <option :value="elem.id" @click="mandarEstado(elem.estado)">{{ elem.estado }}</option>
                </template>
              </select>
              <span class="text-danger">{{ errors.first('estado') }}</span>
            </div>
              <div class="form-group">
                <label for="municipio_id" class="col-form-label">Municipio:</label>
                <select class="form-control" name="municipio"
                v-model="municipio_id"
                v-validate="required">
                  <option value="0"> Seleccione...</option>
                  <template v-for="elem in municipios">
                    <option :value="elem.id" @click="mandarMunicipio(elem.municipio)">{{ elem.municipio }}</option>
                  </template>
                </select>
                <span class="text-danger">{{ errors.first('municipio') }}</span>
              </div>
            <div class="form-group">
              <label for="parroquia" class="col-form-label">Parroquia:</label>
              <input type="text" class="form-control" id="parroquia" name="parroquia"
              v-model="parroquia"
              v-validate="'required|min:4'"
              placeholder="Tipo de Alergia">
              <span class="text-danger">{{ errors.first('parroquia') }}</span>
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
      estados: [],
      municipios: []
    }
  },
  computed: {
    id(){
      return  this.$store.state.parroquia.parroquia.id;
    },
    estado_id: {
      get() {
        return this.$store.state.parroquia.parroquia.estado_id;
      },
      set(value) {
        this.$store.commit('parroquia/updateEstado_id', value);
      }
    },
    municipio_id: {
      get() {
        return this.$store.state.parroquia.parroquia.municipio_id;
      },
      set(value) {
        this.$store.commit('parroquia/updateMunicipio_id', value);
      }
    },
    parroquia: {
      get() {
        return this.$store.state.parroquia.parroquia.parroquia;
      },
      set(value) {
        this.$store.commit('parroquia/updateParroquia', value);
      }
    },
    isComplete(){
      let result = true;
      if(this.estado_id == 0){
        result = false;
      }
      if(this.municipio_id == 0){
        result = false;
      }
      if(this.parroquia == ''){
        result = false;
      }
      return result;
    }
  },
  methods: {
    ...mapActions('parroquia', ['createParroquia', 'updateParroquia']),
    ...mapMutations('parroquia', ['cleanParroquia']),
    save(){
      this.createParroquia(this.vista);
      setTimeout(() => this.clean(), 1000);
    },
    update(){
      this.updateParroquia();
      setTimeout(() => this.clean(), 1000);
    },
    clean(){
      this.cleanParroquia();
      // Reset errors
      this.$validator.reset()
    },
    getMunicipios(){
      this.municipios = [];
      this.$store.commit('parroquia/updateMunicipio_id', 0);
      this.mandarMunicipio('');
      axios.get('/parroquia/municipio', { params: { estado_id: this.estado_id } })
      .then((value) => { this.municipios = value.data })
      .catch((err) => { console.log(err); })
    },
    mandarEstado(valor){
      this.$store.commit('parroquia/updateEstado', valor);
      this.getMunicipios();
    },
    mandarMunicipio(valor){
      this.$store.commit('parroquia/updateMunicipio', valor);
    }
  },
  created() {
    //do something after creating vue instance
    bus.$on('allEstado', (val)=>{
      this.estados = val;
    });

    bus.$on('obtenerMunicipio', () => {
      this.getMunicipios();
    });
  }
}
</script>

<style scoped>
</style>
