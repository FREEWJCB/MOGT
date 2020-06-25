import Vue from 'vue'

// Eventos Personalizados
export var bus = new Vue({
  methods: {
    actualizarTotal(bol){
      this.$emit('actualizarCount', bol);
    }
  }
});
