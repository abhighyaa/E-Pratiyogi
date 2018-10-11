<template>
    <div class="card card-default">
        <div class="card-header">Course</div>
        <div class="card-body">
              <ul class="list-group">
                  <li  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click="fetchBranch(course.id)" 
                      class="list-group-item dropdown-toggle"
                      id="dropdownMenuLink" :key="course.id" v-for="course in courses">
                     <a href="#" @click="fetchBranch(course.id)" :id="course.id">{{ course.name}}</a><i class="pull-right fa fa-caret-right"></i>
                  </li>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                     <a class="dropdown-item" href="#" @click="fetchSubjects(branch.id)" v-for="branch in branches" :key="branch.id">{{ branch }}</a>
                   </div>
              </ul>
        </div>
    </div>  
</template>

<script>
import { EventBus } from '../app.js';
    export default {
        data(){
         return{
                courses:[],
                branches:[]     
        };
        },

        mounted() {
           this.fetchCourses();
        },
        methods:{
            async fetchCourses(){
                 await axios.get('http://localhost:8000/courses/get/all')
                .then((response)=>(this.courses = response.data))
                .catch(function(error){console.log(error)});
            },
            async fetchBranch(courseID){
                await axios.get('http://localhost:8000/courses/'+courseID+'/get/branches')
                    .then((response)=>(this.branches = response.data))
                    .catch(function(error){console.log(error)});
            },
            async fetchSubjects(branchID){
                await axios.get('http://localhost:8000/course/branch/'+branchID+'/get/subjects')
                    .then((response)=>(this.branches = response.data))
                    .catch(function(error){console.log(error)});
            }
        }
    }
</script>
<style lang="scss" scoped>
.dropdown-menu{
    margin-left: 90%;
    margin-top: -48px;
    padding: 0;
}
.dropdown-toggle::after {
    display:none;
}
.list-group-item{
    cursor: pointer;
}
.dropdown-item{
   
     border-bottom: 1px solid rgba(0,0,0,0.2);
}
</style>

