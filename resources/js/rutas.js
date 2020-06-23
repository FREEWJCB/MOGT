export const rutas = [
    {path: '/home', name: 'theme', component: () => import(/* webpackChunkName: "Routes" */ './components/theme/MainComponent.vue') },
    {path: '/tipo-discapacidad/:pag', name: 'tipoDiscapacidad', component: () => import(/* webpackChunkName: "Routes" */ './components/tipoDiscapacidad/MainComponent.vue') },
]
