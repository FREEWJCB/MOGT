export const rutas = [
    {path: '/home', name: 'theme', meta: { Auth: false, title: 'Home' }, component: () => import(/* webpackChunkName: "Routes" */ './components/theme/MainComponent.vue') },
    {path: '/tipo-discapacidad/:pag', meta: { Auth: false, title: 'Tipo de Discapacidad' }, name: 'tipoDiscapacidad', component: () => import(/* webpackChunkName: "Routes" */ './components/tipoDiscapacidad/MainComponent.vue') },
    {path: '/discapacidades/:pag', meta: { Auth: false, title: 'Discapacidad' }, name: 'discapacidad', component: () => import(/* webpackChunkName: "Routes" */ './components/discapacidad/MainComponent.vue') },
    {path: '/tipo-Alergia/:pag', meta: { Auth: false, title: 'Tipo de Alergia' }, name: 'tipoAlergia', component: () => import(/* webpackChunkName: "Routes" */ './components/tipoAlergia/MainComponent.vue') },
]
