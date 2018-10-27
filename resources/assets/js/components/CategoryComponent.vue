<template>
    <div class="card card-default">
        <div class="card-header">Subjects</div>
        <div class="card-body">
              <ul >
                  <li  :key="sub.id" v-for="sub in subjects">
                     <a href="#" @click="getcategories(sub.id)" >{{ sub.subject}}</a> 
                    <br><hr>
                  </li>
              </ul>
              <a href="#" @click="createtest()">Create new test!</a>
              <a href="#" @click="viewtest()">View all tests!</a>
        </div>
    </div>  
</template>

<script>
import { EventBus } from '../app.js';
    export default {
        data(){
         return{
                subjects:[],
                categories:[],
                showcategories:true,
                showquestions:false,
                editquestion:false,
                addquestion:false,
                createtst:false,
                addquetotest:false,
                viewtst:false,
                tests:[],
                addtest:false,
                edittest:false,
        };
        },

        mounted() {
           this.getSubjects();
            EventBus.$on('View', this.viewtest);
        },
        methods:{
            async getSubjects(){
                 await axios.get('/teacher/subjects')
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)});
            },
            async getcategories(subject){
                // alert('s');
                await axios.get('/teacher/categories/'+subject)
                .then((response)=>(this.categories = response.data))
                .catch(function(error){console.log(error)});
                
                EventBus.$emit('Category',{
                    categoriesKey:this.categories,
                    subjectKey:subject,
                    showcategoriesKey:true,
                    editquestionKey:false,
                    showquestionsKey:false,
                    addquestionKey:false,
                    createtstKey:false,
                    addquetotestKey:false,
                    viewtstKey:false,
                    addtestKey:false,
                 });
            },
            async createtest(){
                EventBus.$emit('test',{
                    categoriesKey:this.categories,
                    showcategoriesKey:false,
                    editquestionKey:false,
                    showquestionsKey:false,
                    addquestionKey:false,
                    createtstKey:true,
                    addquetotestKey:false,
                    viewtstKey:false,
                    addtestKey:false,
                    edittestKey:false
                 });
            },
            async viewtest(){
                await axios.get('/teacher/gettests/')
                .then((response)=>(this.tests = response.data))
                .catch(function(error){console.log(error)});
                EventBus.$emit('viewtest',{
                    testsKey:this.tests,
                    categoriesKey:this.categories,
                    showcategoriesKey:false,
                    editquestionKey:false,
                    showquestionsKey:false,
                    addquestionKey:false,
                    createtstKey:false,
                    viewtstKey:true,
                    addquetotestKey:false,
                    addtestKey:false,
                    edittestKey:true,
                 });
            },
        }
    }
</script>
