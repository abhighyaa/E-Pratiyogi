import Vue from 'vue';
import VueRouter from 'vue-router';
import StudentHome from './components/StudentHome.vue';
import Instructions from './components/Instructions.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
          path: '/',
          name: 'StudentHome',
          component: StudentHome,
        },
        {
          path: '/instructions',
          name: 'Instructions',
          component: Instructions
        },
    ]
})  