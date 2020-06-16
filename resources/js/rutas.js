export const rutas = [
    {path: '/home', component: () => import(/* webpackChunkName: "Routes" */ './components/theme/MainComponent.vue') },
    {path: '/tipo-discapacidad', component: () => import(/* webpackChunkName: "Routes" */ './components/tipoDiscapacidad/ListComponent.vue') },
]
