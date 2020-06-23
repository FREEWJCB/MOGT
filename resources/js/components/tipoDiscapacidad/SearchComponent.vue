<template>
  <div class="input-group mb-2 mt-2 col-8">
    <div class="input-group-prepend">
      <div class="input-group-text">
        <span class="fas fa-search"></span>
      </div>
    </div>
    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Busqueda" name="busqueda"
    @keyup.enter="Buscar()"
    v-model.lazy="busqueda">
  </div>
</template>

<script>
export default {
}
</script>

<style scoped>
</style>
