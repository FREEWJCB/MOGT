<template>
  <div>
    <!-- Nav -->
    <nav-barra></nav-barra>
    <!-- Main -->
    <router-view></router-view>
    <!-- Footer -->
    <footer-component></footer-component>
  </div>
</template>

<script>
import $ from "jquery";
import NavBarra from './theme/NavComponent.vue';
import FooterComponent from './theme/FooterComponent.vue';
import MainComponent from './theme/MainComponent.vue';
export default {
  components: {
    NavBarra,
    MainComponent,
    FooterComponent,
  },
  data(){
    return {
    }
  },
  mounted() {
    $(document).ready(function(){
      $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
         })
   $(".dispose-toast").click(function(){
       $(this).parent().parent().remove();
   });
         $("#myToast").toast({autohide:false})
           $("#myToast").toast('show');
   });
      console.log('Component App mounted.');
  }
}
</script>

<style>
  body {
    background-color: #f4f3f3;
  }

  /* MAIN */
  main div.container {
  min-height: 79.7vh;
  }

  footer {
    background: #8E0E00;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #1F1C18, #8E0E00);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #1F1C18, #8E0E00); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  }
</style>
