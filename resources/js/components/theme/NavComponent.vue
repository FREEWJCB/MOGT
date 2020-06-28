<template>
  <div class="">
    <div :class="sabanaOculta" @click="ocultarMenu(menuOculto)"></div>
    <nav>
      <nav class="navbar navbar-white bg-white" id="navegacion">
        <div class="row w-100 justify-content-between">
          <div class="col-2" style="z-index: 99;">
            <router-link :to="{ name: 'theme' }">
              <a class="navbar-brand text-white">SIDETH</a>
            </router-link>
            <span class="fas fa-align-justify text-white" @click="ocultarMenu(menuOculto)"></span>
          </div>
          <div class="nav-item dropdown col-2 float-right text-center text-dark" style="z-index: 99;">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="fas fa-user text-white"></span>  {{ auth.name || 'Usuario' }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Perfil</a>
              <a class="dropdown-item" href="/cerrar_sesion">Logout</a>
            </div>
          </div>
        </div>
      </nav>
    </nav>
    <!-- Menu Lateral -->
    <aside class="navbar-dark position-fixed bg-dark h-100 d-flex text-left" id="menu-desplegable" style="z-index: 99;"
    :class="menuOculto">
      <ul class="nav flex-column w-100 mt-3">
        <li class="nav-item text-center">
              <a class="nav-link mr-4 text-white" href="#">Hello {{ auth.name || 'User' }}!!!</a>
        </li>
        <hr class="w-100 bg-secondary">
        <li class="nav-item">
          <router-link to="/home">
            <a class="nav-link mr-4 text-white active">
              <span class="fas fa-home"></span> Inicio
            </a>
          </router-link>
        </li>
        <li class="nav-item accordion" id="accordionExample" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <a class="nav-link mr-4 text-white">
            <span class="fas fa-clipboard"></span>
            Maestros
            <span class="fas fa-angle-down"></span>
          </a>
          <ul class="nav flex-column bg-secondary collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample">
            <li class="nav-item">
              <router-link :to="{ name: 'tipoDiscapacidad', params: { pag: 1 } }">
                <a class="nav-link mr-4 text-white" href="#">
                  <span class="fas fa-clinic-medical"></span> Tipo de Discapacidad
                </a>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'discapacidad', params: { pag: 1} }">
                <a class="nav-link mr-4 text-white" disabled="true" tabindex="-1" aria-disabled="true">
                  <span class="fas fa-clinic-medical"></span> Discapacidad
                </a>
              </router-link>
            </li>
            <li class="nav-item disabled">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-clinic-medical"></span> Tipo de Alergias
              </a>
            </li>
            <li class="nav-item disabled">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-clinic-medical"></span> Alergias
              </a>
            </li>
            <li class="nav-item disabled">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-map-marked-alt"></span> Estado
              </a>
            </li>
            <li class="nav-item disabled">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-map-marked-alt"></span> Municipio
              </a>
            </li>
            <li class="nav-item disabled">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-church"></span> Parroquia
              </a>
            </li>
            <li class="nav-item disabled">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-graduation-cap"></span> Estudiante
              </a>
            </li>
            <li class="nav-item disabled">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-user-tie"></span> Representante
              </a>
            </li>
            <li class="nav-item disabled">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-user-tie"></span> Empleado
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item accordion disabled" id="accordionTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <a class="nav-link mr-4" disabled="true">
              <span class="fas fa-clipboard"></span>
              Procesos
            <span class="fas fa-angle-down"></span>
          </a>
          <ul class="nav flex-column bg-secondary collapse" id="collapseTwo" aria-labelledby="headingOne" data-parent="#accordionTwo">
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark active" disabled="true">Inscriptción</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark" disabled="true">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark" disabled="true">Link</a>
            </li>
            <li class="nav-item disabled">
              <a class="nav-link mr-4 text-dark disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </li>
          <a class="nav-link mr-4" disabled="true">
            <span class="fas fa-clipboard"></span>
            Reportes
            <span class="fas fa-angle-down"></span>
          </a>
        </li>
        <li class="nav-item disabled">
          <a class="nav-link mr-4 disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
       <div class="mb-0 float-bottom">
       </div>
      </ul>
    </aside>
  </div>

</template>

<script>
export default {
  data(){
    return {
      menuOculto: 'menu-oculto',
      sabanaOculta: 'sabana-oculta',
      auth: {},
    }
  },
  methods: {
    ocultarMenu(menu) {
      if(menu == 'menu-oculto'){
        this.menuOculto = 'menu-desplegado';
        this.sabanaOculta = 'sabana-desplegada';
      }else{
        this.menuOculto = 'menu-oculto';
        this.sabanaOculta = 'sabana-oculta';
      }
    }
  },
  async beforeCreate() {
    //do something before creating vue instance
    this.auth = await axios.get('/auth').then((value) => {console.log(value);return value.data});
  },
}
</script>

<style scoped>

/* NAV */
  nav#navegacion {
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
    width: 30vh;
  }

  aside.menu-oculto {
    left: -30vh;
    /*Chrome, Safari*/
    -webkit-transition: ease-in-out left 0.7s;
    /*Firefox*/
    -moz-transition: ease-in-out left 0.7s;
    /*Opera*/
    -o-transition: ease-in-out left 0.7s;
    /*Standard*/
    transition: ease-in-out left 0.7s;
  }

  aside.menu-desplegado {
    left: 0px;
    /*Chrome, Safari*/
    -webkit-transition: ease-in-out left 0.7s;
    /*Firefox*/
    -moz-transition: ease-in-out left 0.7s;
    /*Opera*/
    -o-transition: ease-in-out left 0.7s;
    /*Standard*/
    transition: ease-in-out left 0.7s;
  }

  aside ul {
  overflow: auto;
  }

  aside ul li {
    cursor: pointer;
  }

  .disabled {
    cursor: not-allowed;
  }

  aside ul li.nav-item:hover {
    background-color: #474d5399 !important;
  }

  .sabana-desplegada{
    z-index: 40;
    min-width: 100%;
    min-height: 100%;
    position: fixed;
    background: #00000070;
  }

  .sabana-oculta{
    z-index: 40;
    min-width: 0%;
    min-height: 100%;
    position: fixed;
    background: #00000070;
  }
</style>
