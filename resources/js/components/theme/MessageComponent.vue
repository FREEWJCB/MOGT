<template>
  <div>
    <div v-for="msg of message" :key="msg.key">
      <div class="alert alert-dismissible fade show mb-0" role="alert"
      :class="msg.tipo">
        <span :class="msg.icon"></span> 
        <span v-html="msg.msg"></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="cleanMsg(msg.key)">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { bus } from '../../bus.js'
export default {
  data(){
    return {
      message: []
    }
  },
  methods: {
    cleanMsg(key) {
      this.message.splice(key, 1);
    }
  },
  created() {
    //do something after creating vue instance
    bus.$on('mensajeAlert', (obj) => {
      this.message.unshift(obj);
    });
  }
}
</script>

<style lang="css" scoped>
</style>
