<template>
      <div class=" adminSidePanel">
        <ul class="list-group" >
           <li class="list-group-item"  @click="FetchUsers()"><i class="fa fa-users"></i>&ensp;&ensp;Users</li>  
           <li class="list-group-item" ><i class="fa fa-folder-open"></i>&ensp;&ensp;Categories</li>  
           <li class="list-group-item" ><i class="fa fa-folder"></i>&ensp;&ensp;Sub-categories</li>  
           <li class="list-group-item" @click="FetchSubjects()"><i class="fa fa-tag"></i>&ensp;&ensp;Subjects</li>  
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
         subjects:[],
         showUsers : false,
         users:[]
      }
    },
  methods: {
    SetShowDashboard() {
       this.showDashboard = true;
       EventBus.$emit('dashboard_Event1',this.showDashboard);
    },
    async FetchSubjects() {
      this.showDashboard = false;
      this.showUsers = false;
      this.showSubjects = true;
       await axios.get('http://localhost:8000/subjects/get/all')
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)});
                 EventBus.$emit('subject_Event1',this.subjects);
                 EventBus.$emit('subject_Event2',this.showDashboard);
                 EventBus.$emit('subject_Event3',this.showSubjects);
                 EventBus.$emit('subject_Event4',this.showUsers);

    },
     async FetchUsers()
       {
         this.showDashboard = false;
         this.showSubjects = false; 
         this.showUsers = true;
         await axios.get('http://localhost:8000/admin/get/all/users')
                .then((response)=>(this.users = response.data))
                .catch(function(error){console.log(error)}); 
                 EventBus.$emit('user_Event4',this.users);
                 EventBus.$emit('user_Event5',this.showUsers);
                 EventBus.$emit('user_Event6',this.showDashboard);
                 EventBus.$emit('user_Event7',this.showSubjects);

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
   width:100%;da
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