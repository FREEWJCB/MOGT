<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Type Discapacity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="clean">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Tipo de Discapacidad:</label>
              <input type="text" class="form-control" id="recipient-name" name="recipient-name"
              v-model="tipoDiscapacidad.tipo_d"
              v-validate="'required|min:4|alpha_spaces'">
              <span class="text-danger">{{ errors.first('recipient-name') }}</span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clean">Close</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal"
          v-if="this.tipoDiscapacidad.id === 0"
          @click="createTipoD"
          :disabled='errors.any() || !isComplete'>Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal"
          v-else
          @click="updateTipoD"
          :disabled='errors.any() || !isComplete'>Update</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
}
</script>

<style scoped>
</style>
