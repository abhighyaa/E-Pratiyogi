<template>
      <div class=" adminSidePanel">
        <ul class="list-group" >
           <li class="list-group-item"  @click="FetchUsers()"><i class="fa fa-users"></i>&ensp;&ensp;Users</li>  
           <li class="list-group-item"  @click="FetchCourses()"><i class="fa fa-folder-open"></i>&ensp;&ensp;Courses</li>  
           <li class="list-group-item"  @click="FetchBranches()"><i class="fa fa-folder"></i>&ensp;&ensp;Branches</li>  
           <li class="list-group-item"  @click="FetchSubjects()"><i class="fa fa-tag"></i>&ensp;&ensp;Subjects</li>  
           <li class="list-group-item" ><i class="fa fa-question-circle "></i>&ensp;&ensp;Questions</li>
           <li class="list-group-item" ><i class="fa fa-cogs"></i>&ensp;&ensp;Settings</li>  
           <li class="list-group-item" ><i class="fa fa-trophy"></i>&ensp;&ensp;Results</li>
           <li class="list-group-item" ><i class="fa fa-bell"></i>&ensp;&ensp;Notifications</li>  
        </ul>
      </div>
</template>
<script>
import { EventBus } from '../app.js';
  export default {
    data() {
      return {
         showDashboard : false,
         showSubjects : false,
         showCourses : false,
         showUsers : false,
         showBranches : false,
         users:[],
         subjects:[],
         courses:[],
         branches:[]
      }
    },
  methods: {
    SetShowDashboard() 
    {
       this.showDashboard = true;
       EventBus.$emit('dashboard_Event1',this.showDashboard);
    },
    async FetchUsers()
    {
         this.showDashboard = false;
         this.showSubjects = false; 
         this.showUsers = true;
         this.showCourses = false;
         this.showBranches = false;
         await axios.get('http://localhost:8000/admin/get/all/users')
                .then((response)=>(this.users = response.data))
                .catch(function(error){console.log(error)}); 
                 EventBus.$emit('user_events',{
                    usersKey:this.users,
                    showUsersKey:this.showUsers,
                    showDashboardKey:this.showDashboard,
                    showCoursesKey:this.showCourses,
                    showBranchesKey:this.showBranches,
                    showSubjectsKey:this.showSubjects
                 });
    },
    async FetchCourses()
    {
          this.showDashboard = false;
          this.showUsers = false;
          this.showSubjects = false;
          this.showCourses = true;
          this.showBranches = false;
          await axios.get('http://localhost:8000/admin/get/all/courses')
                .then((response)=>(this.courses = response.data))
                .catch(function(error){console.log(error)}); 
                 EventBus.$emit('courses_events',{
                    coursesKey:this.courses,
                    showDashboardKey:this.showDashboard,
                    showCoursesKey:this.showCourses,
                    showUsersKey:this.showUsers,
                    showBranchesKey:this.showBranches,
                    showSubjectsKey:this.showSubjects
                    
                 });   
    },
    async FetchBranches()
    {
          this.showDashboard = false;
          this.showUsers = false;
          this.showSubjects = false;
          this.show_teacher_user = false;
          this.show_student_user = false;
          this.showCourses = false;
          this.showBranches = true;
          await axios.get('http://localhost:8000/admin/get/all/branches')
                .then((response)=>(this.branches = response.data))
                .catch(function(error){console.log(error)});
              EventBus.$emit('branch_events',{
                    branchesKey:this.branches,
                    showDashboardKey:this.showDashboard,
                    showCoursesKey:this.showCourses,
                    showUsersKey:this.showUsers,
                    showBranchesKey:this.showBranches,
                    showSubjectsKey:this.showSubjects
                 });         
    },
    async FetchSubjects() 
    {
        this.showDashboard = false;
        this.showUsers = false;
        this.showSubjects = true;
        this.showCourses = false;
        this.showBranches = false;        
         await axios.get('http://localhost:8000/subjects/get/all')
                  .then((response)=>(this.subjects = response.data))
                  .catch(function(error){console.log(error)});
                   EventBus.$emit('subject_events',{
                      subjectsKey:this.subjects,
                      showSubjectsKey:this.showSubjects,
                      showDashboardKey:this.showDashboard,
                      showUsersKey:this.showUsers,
                      showBranchesKey:this.showBranches, 
                      showCoursesKey:this.showCourses
                   });
    }
  },
    mounted() {
        console.log('admin component mounted');
    }
  }
</script>

<style>
.adminSidePanel{
  height: 100%;
   width:100%;
}
.list-group{
  width:100%;
}
.list-group-item {
    background:rgba(10,113,138);
    cursor: pointer;
    color: white;
    border:none;
    border-top: 1px solid rgba(255,255,255,0.5);
    border-bottom: 1px solid rgba(255,255,255,0.5);
}

</style>