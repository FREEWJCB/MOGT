<template>
  <div v-for="msg of message" :key="msg.key">
    <div class="alert alert-dismissible fade show" role="alert"
    :class="msg.tipo">
      <span v-html="msg.msg"></span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="cleanMsg">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ['message'],
  methods: {
    cleanMsg() {
      this.message = [];
    }
  }
}
</script>

<style lang="css" scoped>
</style>
