<template>
    <div class="card card-default">
        <div class="card-header">Course</div>
        <div class="card-body">
            
              <ul class="list-group">
                  <li data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click="fetchBranch(course.id)" 
                      class="list-group-item dropdown-toggle"
                      id="dropdownMenuLink" :key="course.id" v-for="course in courses" >
                     <a href="#" :id="course.id">{{ course.name }}</a><i class="pull-right fa fa-caret-right"></i>
                  </li>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                       <a class="dropdown-item" href="#" v-for="branch in branches" :id="branch.id" @click="fetchSubjects(branch.id)" :key="branch.id">{{ branch.name }}</a>
                   </div>
                   
              </ul><br>
              <!-- <b-pagination size="md" align="center" :link-gen="linkGen" :total-rows="100" v-model="currentPage" :per-page="10">
             </b-pagination> -->
        </div>
    </div>  
</template>

<script>
import { EventBus } from '../app.js';
import { mapGetters } from "vuex";

    export default {
        data(){
         return{
                branches:[],
                subjects:[] ,
                currentPage: 1 
        };
        },
        computed:{
            ...mapGetters({
                courses:'Courses'
            })
        },
        mounted() {
           this.fetchCourses();
        },
        methods:{
             linkGen (pageNum) {
                 alert(pageNum)
      return '#page/' + pageNum + '/foobar'
    },
            async fetchCourses(){
                this.$store.dispatch('Set_Courses');
            },
            async fetchBranch(courseID){
                await axios.get('http://localhost:8000/courses/'+courseID+'/get/branches')
                    .then((response)=>(this.branches = response.data))
                    .catch(function(error){console.log(error)});
            },
            async fetchSubjects(branchID){
                await axios.get('http://localhost:8000/courses/branch/'+branchID+'/get/subjects')
                    .then((response)=>(this.subjects = response.data))
                    .catch(function(error){console.log(error)});
                EventBus.$emit('fetchSubjects',{
                    subjectKey:this.subjects
                });
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

