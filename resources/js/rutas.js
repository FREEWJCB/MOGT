export const rutas = [
    {
      path: '/home',
      name: 'theme',
      meta: { Auth: false, title: 'Home' },
      component: () => import(/* webpackChunkName: "theme" */ `./components/theme/MainComponent.vue`)
    },
    {
      path: '/tipo-discapacidad/:pag',
      meta: { Auth: false, title: 'Tipo de Discapacidad' },
      name: 'tipoDiscapacidad',
      component: () => import(/* webpackChunkName: "tipoDiscapacidad" */ `./components/tipoDiscapacidad/MainComponent.vue`)
    },
    {
      path: '/discapacidades/:pag',
      meta: { Auth: false, title: 'Discapacidad' },
      name: 'discapacidad',
      component: () => import(/* webpackChunkName: "discapacidad" */ `./components/discapacidad/MainComponent.vue`)
    },
    {
      path: '/tipo-Alergia/:pag',
      meta: { Auth: false, title: 'Tipo de Alergia' },
      name: 'tipoAlergia',
      component: () => import(/* webpackChunkName: "tipoAlergia" */ `./components/tipoAlergia/MainComponent.vue`)
    },
    {
      path: '/alergias/:pag',
      meta: { Auth: false, title: 'Alergia' },
      name: 'alergia',
      component: () => import(/* webpackChunkName: "alergia" */ `./components/alergia/MainComponent.vue`)
    },
    {
      path: '/cargos/:pag',
      meta: { Auth: false, title: 'Cargo' },
      name: 'cargo',
      component: () => import(/* webpackChunkName: "cargo" */ `./components/cargo/MainComponent.vue`)
    },
    {
      path: '/estados/:pag',
      meta: { Auth: false, title: 'Estado' },
      name: 'estado',
      component: () => import(/* webpackChunkName: "estado" */ `./components/estado/MainComponent.vue`)
    },
    {
      path: '/municipios/:pag',
      meta: { Auth: false, title: 'Municipio' },
      name: 'municipio',
      component: () => import(/* webpackChunkName: "municipio" */ `./components/municipio/MainComponent.vue`)
    },
    {
      path: '/404',
      component: () => import(/* webpackChunkName: "Error" */ `./components/theme/ErrorComponent.vue`),
      meta: { Auth: false, title: 'Not Found' }
    },
    {
      path: '*',
      redirect: '/404',
      meta: { Auth: false, title: 'Not Found' }
    }
]
