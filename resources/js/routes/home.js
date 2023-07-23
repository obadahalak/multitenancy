const home = () =>
    import ('../components/app.vue')
const index = () =>
    import ('../components/index.vue')

export default [{
    path: '/home',
    component: home,
    name: 'home',
}, {
    path: '/index',
    component: index,
    name: 'index'
}, ]