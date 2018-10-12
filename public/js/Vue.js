window.Vue = require('vue');

Vue.component('modal', require('./components/modal.vue'));

Vue.component('mcontent',{
    template:`<div><slot></slot></div>`
})
new Vue({
    el:'#app',
    data() {
        return {
            smodal:false,
            qmodal:false
        }                
    }
});

  
 