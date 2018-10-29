import Vue from 'vue';
import router from './router';
import store from './store/store';

import BootstrapVue from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(BootstrapVue);
require('./bootstrap');

export const EventBus = new Vue();

class Errors{
    constructor(){
        this.errors={}
    }
    get(field){
        if(this.errors[field]){
            return this.errors[field][0];
        }
    }
    record(errors){
        this.errors=errors;
    }
    clear(field){
        if (field) {
            delete this.errors[field];

            return;
        }

        this.errors = {};
    }
    has(field){
        return this.errors.hasOwnProperty(field);
    }
    any(){
        return Object.keys(this.errors).length>0;
    }

}
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('subject-component', require('./components/SubjectComponent.vue'));
Vue.component('admin-component', require('./components/AdminComponent.vue'));
Vue.component('dashboard-component', require('./components/DashboardComponent.vue'));

Vue.component('modal-component', require('./components/ModalComponent.vue'));
Vue.component('category-component', require('./components/CategoryComponent.vue'));
Vue.component('details-component', require('./components/DetailsComponent.vue'));
Vue.component('check', require('./components/check.vue'));
Vue.component('course-component', require('./components/CourseComponent.vue'));
Vue.component('previous-attempt', require('./components/PreviousAttempt.vue'));
Vue.component('subject-container', require('./components/SubjectComponent.vue'));
Vue.component('admin-component', require('./components/AdminComponent.vue'));
Vue.component('dashboard-component', require('./components/DashboardComponent.vue'));
Vue.component('instructions', require('./components/Instructions.vue'));
Vue.component('student-home', require('./components/StudentHome.vue'));
Vue.component('test-component', require('./components/testComponent.vue'));
Vue.component('student-profile', require('./components/StudentProfile.vue'));
Vue.component('profile-header', require('./components/ProfileHeader.vue'));
Vue.component('profile-feature', require('./components/ProfileFeature.vue'));

// Vue.component('piechart-component', require('./components/piechartComponent.vue'));



Vue.component('mcontent',{
    template:`<div><slot></slot></div>`
})

Vue.component('mfooter',{
    template:`<div><slot></slot></div>`
})

Vue.component('modal', require('./components/modal.vue'));
Vue.component('subject', require('./components/subject.vue'));

const app = new Vue({
    el: '#app',
    router:router,
    store:store,
    data() {
        return {
            smodal:false,
            qmodal:false,
            tmodal:false,
            emodal:false,
            sub:[],
            newsubject:'',
            newtopic:'',
            newquestion:'',
            newanswer:'',
            choice1:'',
            val :'',
            choice2:'',
            complexity:'',
            subject:'',
            topic:'',
            count:'0',
            questions:[],
            choices:[],
            topic:'',
            subject:[],
            eques:[],
            errors:new Errors()
        }                
    },
    mounted(){
        this.getsubjects();
    },
    methods: {
        addsubjects(){
            const self=this;
            console.log(this.newsubject);
          
            axios.get('/addsubject?newsubject='+self.newsubject)
              .then(function (response) {
                console.log(response);
                self.newsubject='';
                alert(response.data[1]);
                location.reload(true);
              })
              .catch(function (error) {
                console.log(error);
                // self.errors.record(error.response.data);
                alert('error');
              });
        },
        
       async getsubjects(){
            const self=this;
           await axios.get('/getsubjects')
                    .then(response => {
                        console.log(response.data);
                        self.sub = response.data;

                        // /(response.data[0].questions.length);
                        })
                    .catch(error => {
                        console.log(error);
                        // this.errors.push(error);
                    });
        },

        delsubject(sub){
            // console.log(sub)
            axios.get('/subjects/delete/+'+sub.id)
              .then(function (response) {
                console.log(response);
                location.reload(true);
              })
              .catch(function (error) {
                console.log(error);
                // self.errors.record=error.response.data;
                alert('error');
              });
        },

        addchoice(){
            
        },

        addquestion(){
            const self=this;
            // console.log(this.newsubject);
          
            axios.post('/addquestions',{
                newquestion:self.newquestion,
                newanswer:self.newanswer,
                choice1:self.choice1,
                choice2:self.choice2,
                complexity:self.complexity,
                subject:self.subject,
                topic:self.topic
            })
              .then(function (response) {
                console.log(response.data);
                if(response.data[1]=="success"){
                self.newquestion='';
                self.newanswer='';
                self.choice1='';
                self.choice2='';
                self.complexity='';
                self.subject='';
                self.topic='';
            
                location.reload(true);}
                else{
                    alert("error");
                }
              })
              .catch(function (error) {
                console.log(error);
                // self.errors.record=error.response.data;
                alert('error');
              });
        },

        addtopics(id){
            const self=this;
            console.log(this.newtopic);
            
            axios.get('/addtopic?newtopic='+self.newtopic+'&sub='+id)
              .then(function (response) {
                console.log(response);
                self.newtopic='';
                // alert(response.data[1]);
                location.reload(true);
              })
              .catch(function (error) {
                console.log(error);
                // self.errors.record(error.response.data);
                alert('error');
              });
        },

        activate(s_id,t_id){
            const self=this;
            axios.get('/activatetopic?sub='+s_id+'&topic='+t_id)
                    .then(response => {
                        self.topic=response.data[2];
                        self.subject=response.data[3];
                        console.log(response.data[3]);
                        self.questions = response.data[1];
                        // alert(self.questions.length);
                        // alert(self.questions[0].choices);
                        // alert(JSON.parse(self.questions[0].choices));
                        
                        // console.log(self.choices);
                        
                        })
                    .catch(error => {
                        console.log(error);
                        // this.errors.push(error);
                    });
        },
        editques(id){
            const self=this;
            console.log(id);
            
            axios.get('/editques?ques='+id)
              .then(function (response) {
                  console.log(response.data[1]);
                    // self.eques=response.data[1];
                    self.eques=response.data[1];
                    // self.eques.choices=JSON.parse(self.eques.choices);
                    
                    self.eques.subjects=response.data[2];
                    self.eques.topics=response.data[3];
                    self.emodal=true;
              })
              .catch(function (error) {
                console.log(error);
                // self.errors.record(error.response.data);
                alert('error');
              });
              
        },

        saveques(id){
            const self=this;
             console.log(self.eques.choices);
          
            axios.post('/savequestion',{
                id:id,
                question:self.eques.question,
                answer:self.eques.answer,
                choices:self.eques.choices,
                complexity:self.eques.complexity,
                subjects:self.eques.subjects,
                topics:self.eques.topics
            })
              .then(function (response) {
                console.log(response.data);
                if(response.data[1]=="success"){
                self.eques.question='';
                self.eques.answer='';
                self.eques.choices='';
                self.eques.complexity='';
                self.eques.subjects='';
                self.eques.topics='';
            
                location.reload(true);
            }
                else{
                    alert("error");
                }
              })
              .catch(function (error) {
                console.log(error);
                // self.errors.record=error.response.data;
                alert('error');
              });
        },
        // gettopics(sid){
        //     const self=this;
        //     axios.get('/gettopics?sub='+sid)
        //             .then(response => {
        //                 console.log(response.data);
        //                 self.topics = response.data;

        //                 // /(response.data[0].questions.length);
        //                 })
        //             .catch(error => {
        //                 console.log(error);
        //                 // this.errors.push(error);
        //             });
        // },
    }
});

