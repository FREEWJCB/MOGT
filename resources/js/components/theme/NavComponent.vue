<template>
  <div class="">
    <nav>
      <nav class="navbar navbar-white bg-white" id="navegacion">
        <div class="row w-100 justify-content-between">
          <div class="col-2">
            <router-link :to="{ name: 'theme' }">
              <a class="navbar-brand text-white">SIDETH</a>
            </router-link>
            <span class="fas fa-align-justify text-white" @click="ocultarMenu(menuOculto)"></span>
          </div>
          <div class="nav-item dropdown col-2 float-right text-center text-dark">
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
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-clinic-medical"></span> Discapacidad
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-clinic-medical"></span> Tipo de Alergias
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-clinic-medical"></span> Alergias
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-map-marked-alt"></span> Estado
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-map-marked-alt"></span> Municipio
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-church"></span> Parroquia
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-graduation-cap"></span> Estudiante
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-user-tie"></span> Representante
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mr-4 text-dark disabled" disabled="true" tabindex="-1" aria-disabled="true">
                <span class="fas fa-user-tie"></span> Empleado
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item accordion" id="accordionTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
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
            <li class="nav-item">
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
        <li class="nav-item">
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
      auth: {},
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
  async beforeCreate() {
    //do something before creating vue instance
    this.auth = await axios.get('/auth').then((value) => {console.log(value);return value.data});
  },
}
</script>

<style scoped>
  aside ul li {
    cursor: pointer;
  }
</style>
