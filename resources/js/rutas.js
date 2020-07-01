export const rutas = [
    {
      path: '/home',
      name: 'theme',
      meta: { Auth: false, title: 'Home' }
    },
    {
      path: '/tipo-discapacidad/:pag',
      meta: { Auth: false, title: 'Tipo de Discapacidad' },
      name: 'tipoDiscapacidad'
    },
    {
      path: '/discapacidades/:pag',
      meta: { Auth: false, title: 'Discapacidad' },
      name: 'discapacidad'
    },
    {
      path: '/tipo-Alergia/:pag',
      meta: { Auth: false, title: 'Tipo de Alergia' },
      name: 'tipoAlergia'
    },
    {
      path: '/alergias/:pag',
      meta: { Auth: false, title: 'Alergia' },
      name: 'alergia'
    },
]
