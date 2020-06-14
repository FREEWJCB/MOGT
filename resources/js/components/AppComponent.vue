<template>
  <div>
    <!-- Nav -->
    <nav>
      <nav class="navbar navbar-white bg-white">
        <div class="row w-100 justify-content-between">
          <div class="col-2">
            <a class="navbar-brand text-white">SIDETH</a>
            <span class="fas fa-align-justify text-white" @click="ocultarMenu(menuOculto)"></span>
          </div>
          <div class="nav-item dropdown col-2 float-right text-center text-dark">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="fas fa-user text-white"></span>  Usuario
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Perfil</a>
              <a class="dropdown-item" href="#">Logout</a>
            </div>
          </div>
        </div>
      </nav>
    </nav>
    <aside class="navbar-dark position-fixed bg-dark h-100 d-flex text-right" id="menu-desplegable" style="z-index: 99;"
    :class="menuOculto">
      <ul class="nav flex-column w-100 mt-3">
        <li class="nav-item">
              <a class="nav-link mr-4 text-white" href="#">Hello User!!!</a>
        </li>
        <li class="nav-item">
          <a class="nav-link mr-4 text-white active" href="#">
            Inicio
          </a>
        </li>
        <li class="nav-item accordion" id="accordionExample" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <a class="nav-link mr-4 text-white" href="#">
            Maestros
            <span class="fas fa-angle-down"></span>
          </a>
          <ul class="nav flex-column bg-secondary collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample">
            <li class="nav-item">
              <a class="nav-link mr-4 text-white active" href="#">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-white" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-white" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-white disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </li>
        <li class="nav-item accordion" id="accordionTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <a class="nav-link mr-4" disabled="true">
            Procesos
            <span class="fas fa-angle-down"></span>
          </a>
          <ul class="nav flex-column bg-secondary collapse" id="collapseTwo" aria-labelledby="headingOne" data-parent="#accordionTwo">
            <li class="nav-item">
              <a class="nav-link mr-4 text-white active" href="#">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-white" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-white" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-white disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </li>
          <a class="nav-link mr-4 text-white" href="#">
            Reportes
            <span class="fas fa-angle-down"></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mr-4 disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
       <div class="mb-0 float-bottom">
       </div>
      </ul>
    </aside>
    <!-- Main -->
    <main class="mt-5">
      <div class="container bg-white">
        <div class="row">
          <div class="col">
            <h1>Principal</h1>
          </div>
        </div>
      </div>
    </main>
    <!-- Footer -->
    <footer class="mb-0 mt-4 w-100 bg-white justify-content text-white" style="z-index: 1;">
      <div class="container">
        <div class="row">
          <div class="col-8 align-self-center">
            <p>
              Sistema de Inscripción de Estudiante de la Tribu Jirahara 2020. &copy; Todos los derechos reservados.
            </p>
          </div>
          <div class="col-4 floar-right align-self-center">
           <div class="float-right">
            <span class="fab fa-git-alt"></span>
            <span class="fab fa-github"></span>
            <span class="fab fa-font-awesome"></span>
            <span class="fab fa-html5"></span>
            <span class="fab fa-css3-alt"></span>
            <span class="fab fa-bootstrap"></span>
            <span class="fab fa-js-square"></span>
            <span class="fab fa-vuejs"></span>
            <span class="fab fa-node-js"></span>
            <span class="fab fa-php"></span>
            <span class="fab fa-laravel"></span>
            <span class="fab fa-markdown"></span>
            <span class="fab fa-windows"></span>
            <span class="fab fa-linux"></span>
           </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  data(){
    return {
      menuOculto: 'menu-desplegado',
    }
  },
  methods: {
    ocultarMenu(menu) {
      if(menu == 'menu-oculto'){
        this.menuOculto = 'menu-desplegado';
      }else{
        this.menuOculto = 'menu-oculto';
      }
    }
  },
  mounted() {
      console.log('Component App mounted.')
  }
}
</script>

<style scoped>
body {
  background-color: #f4f3f3;
}
/* NAV */
nav {
  background: #8E0E00;  /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #1F1C18, #8E0E00);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #1F1C18, #8E0E00); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}

nav div.col-2 span {
cursor: pointer;
}

nav div p {
margin: 0px;
}

/* MENU */
aside#menu-desplegable {
width: 22vh;
}

aside.menu-oculto {
left: -22vh;
/*Chrome, Safari*/
-webkit-transition: ease-in-out left 1s;
/*Firefox*/
-moz-transition: ease-in-out left 1s;
/*Opera*/
-o-transition: ease-in-out left 1s;
/*Standard*/
transition: ease-in-out left 1s;
}

aside.menu-desplegado {
left: 0px;
/*Chrome, Safari*/
-webkit-transition: ease-in-out left 1s;
/*Firefox*/
-moz-transition: ease-in-out left 1s;
/*Opera*/
-o-transition: ease-in-out left 1s;
/*Standard*/
transition: ease-in-out left 1s;
}

aside ul {
overflow: auto;
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
