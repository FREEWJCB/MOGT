<template>
  <main class="mt-5">
    <div class="container bg-white">
      <div class="row">
        <div class="col text-center">
          <h1>Error 404</h1>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col text-center">
          Error 404, Page <h4 style="display: inline-block;">{{ url }}</h4> not found.
          <button class="btn btn-primary" @click="goToHome">go to home</button>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data(){
    return {
      url: ''
    }
  },
  methods: {
    goToHome() {
      this.$router.push({ name: 'theme' });
    }
  },
  created() {
    //do something after creating vue instance
    this.url = this.$route.redirectedFrom || '/404';
  }
}
</script>

<style scoped>
</style>
