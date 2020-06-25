<template>
  <div class="input-group mb-2 mt-2 col-8">
    <div class="input-group-prepend">
      <div class="input-group-text">
        <span class="fas fa-search"
        style="cursor: pointer;"
          @click="Buscar()"
        ></span>
      </div>
    </div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Busqueda" name="busqueda"
    v-model.lazy="busqueda">
  </div>
</template>

<script>
export default {
  data(){
    return {
      busqueda: '',
    }
  },
  props: {
    Buscar: Function
  },
  watch: {
    // cuando 'busqueda' cambie, se ejecutará esta función
    busqueda: function (news) {
      this.Buscar({ pag: 1, buscar: this.busqueda});
    }
  }
}
</script>

<style scoped>
</style>
