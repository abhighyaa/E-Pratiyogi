<template>
<div class="container">
    <!-- first row for dashboard heading and search bar -->
    <div class="row mt-2 ml-3">
        <div class="col-sm-4">
             <h1><b>Dashboard</b></h1>
        </div> 
        <div class="col-sm-8 mt-2">
            <div class="input-container">
               
                <input class="input-field" type="text" placeholder="Search" name="usrnm"><i class="fa fa-search icon"></i>
            </div>     
        </div>    
    </div>
    <!-- first row end -->
    <!-- second row for location -->
    <div class="row mt-2 ml-4">
      <div class="col-sm-12 pl-0 ">
         <div class="location"> 
            <button class="location-button btn pt-2 pb-2 pl-3 pr-3" @click="ShowDashboardScreen()">
              Dashboard
            </button>
            <i class="fa fa-angle-double-right" v-if="showDashboard === false"></i>
            <button v-if="showSubjects" class="location-button btn pt-2 pb-2 pl-3 pr-3" @click="FetchSubjects()">
              Subjects
            </button>
            <button v-if="showUsers" class="location-button btn pt-2 pb-2 pl-3 pr-3" @click="FetchUsers()">
              Users
            </button>
            <i class="fa fa-angle-double-right" v-if="show_teacher_user === true "></i>
            <button v-if="showUsers &&  show_teacher_user" class="location-button btn pt-2 pb-2 pl-3 pr-3" @click="FetchUsers()">
              Teachers
            </button>
            <i class="fa fa-angle-double-right" v-if="show_student_user === true "></i>
            <button v-if="showUsers &&  show_student_user" class="location-button btn pt-2 pb-2 pl-3 pr-3" @click="FetchUsers()">
             Students
            </button>
            
          </div>
      </div>  
    </div>
    <!-- second row end -->
    <!-- user department -->
    <div class="row mt-2 ml-3" v-if="showUsers">
      <div class="col-sm-12">
        <button class="btn btn-success" @click="FetchUsers()">All</button>
        <button class="btn btn-success" @click="Fetch_all_Teachers()">Teachers</button>
        <button class="btn btn-success" @click="Fetch_all_Students()">Students</button>
      </div>
    </div>
    <!-- table for users -->
    <div v-if="showUsers === true">
        <table class="table mt-3 ml-4 table_of_contents">
          <thead>
            <tr>
              <th scope="col">S.No.</th>
              <th scope="col">Name</th>
              <th scope="col">E-Mail Id</th>
              <th scope="col">Role</th>
              <th scope="col">Manage</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user,index) in users" :key="user.id">
              <td>{{ ++index }}</td>
              <td>{{ user.name }}</td>
               <td>{{ user.email }}</td>  
               <td v-for="r in user.role" :key="r.id">
                    <select v-model="r.name" @change="update_role_of_user(user.id,r.name)">
                      <option disabled> {{r.name}} </option>
                      <option v-if="r.name !== role.name" v-for="role in roles" :key="role.id">{{ role.name }}</option>
                    </select>
               </td>              
               <td>
                  <button class="btn btn-danger" @click="RemoveUser(user.id)">Remove</button>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
    <!-- table users end -->
    <!-- user department end -->
    <!-- row for insertion of subjects -->
    <div class="row mt-2 ml-4 insertion_row" v-if="showSubjects">
      <div class="col-sm-9 text-center pt-1 subject_list_text"><b>List of Subjects</b>
      </div>
      <div class="col-sm-2 text-center " >
        <div class="subject_add_button" @click="Input_for_subject = true">Add Subject</div>
      </div>
      <div class="col-sm-"></div>
    </div>
    <!-- insertion row end -->
    <!-- this row will be appear if user will click on add subject -->
    <div class="row mt-2 ml-3 insertion_row" v-if="Input_for_subject">
      <div class="col-sm-9 ">
        <input type="text" placeholder="Subject Name" name="subject_name" v-model="new_subject_name" class="subject_input">
      </div>
      <div class="col-sm-2 ">
         <button class="btn btn-primary" @click="Input_for_subject = false, AddSubject(new_subject_name)">
          <li class="fa fa-plus"></li>
         </button>
      </div>
    </div>
    <!-- this row end -->
    <!-- table for subjects -->
    <div v-if="showSubjects === true">
        <table class="table mt-3 ml-4 table_of_contents">
          <thead>
            <tr>
              <th scope="col">S.No.</th>
              <th scope="col">Subjects</th>
              <th scope="col">Manage</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="( subject, index) in subjects" :key="subject.id">
              <td>{{ ++index }}</td>
              <td>
                <input class="Editable" type="text" v-if="edit == subject.id" v-model="subject.subject"
                  v-on:blur="edit = false; UpdateSubject(subject.subject,subject.id)"
                  @keyup.enter ="edit=false; UpdateSubject(subject.subject,subject.id)">
              <span title="Double click to Edit" v-else @dblclick="edit = subject.id">{{ subject.subject }}</span>
              </td>
              <td>
                  <button class="btn btn-danger" @click="RemoveSubject(subject.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
    <!-- table end -->

    <div v-if="showDashboard === true">
      <div class="row mt-3 ml-4">
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3" @click="FetchUsers(),FetchRoles()">
          <i class="fa fa-users"></i>
          <h5>Users</h5>
        </div>
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3">
          <i class="fa fa-folder-open"></i>
          <h5>Categories</h5>
        </div>
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3">
          <i class="fa fa-folder"></i>
          <h5>Sub-Categories</h5>
        </div>
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3" @click="FetchSubjects()">
          <i class="fa fa-tag"></i>
          <h5>Subjects</h5>
        </div>
         <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3">
          <i class="fa fa-question-circle"></i>
          <h5>Questions</h5>
        </div>
      </div>
      <div class="row mt-3 ml-4 ">
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3">
          <i class="fa fa-cogs"></i>
          <h5>Settings</h5>
        </div>
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3">
          <i class="fa fa-trophy"></i>
          <h5>Results</h5>
        </div>
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3">
          <i class="fa fa-bell"></i>
          <h5>Notifications</h5>
        </div>
       </div>
    </div>
  </div>  
</template>

<script>
import { EventBus } from '../app.js';  
  export default {
    data() {
      return {
        edit:false,
        newSubjectName:'',
        showDashboard:true,
        message:'',
        showUsers:false,
        showSubjects:false,
        show_teacher_user:false,
        show_student_user:false,
        Input_for_subject : false,
        new_subject_name : null,
        users:[],
        roles:[],
        subjects:[]

      }
    },
    
    methods: {
     async UpdateSubject(SubjectNewName,SubjectId){
       if(SubjectNewName === ''){
         alert("Subejct can not be NUll")
         await axios.get('http://localhost:8000/subjects/get/all')
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)}); 
       }
        else{
              await axios.get('http://localhost:8000/subjects/update/'+SubjectId+'/'+SubjectNewName)
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)}); 
        }
      },
       ShowDashboardScreen() {
         
          this.showDashboard = true;
          this.showSubjects = false;
          this.showUsers = false;
          this.show_teacher_user = false;
          this.show_student_user = false;
       },
       async FetchSubjects() {
        
          this.showDashboard = false;
          this.showUsers = false;
          this.showSubjects = true;
          
          await axios.get('http://localhost:8000/subjects/get/all')
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)}); 
                      
       },
       async RemoveSubject(id) {
         
           await axios.get('http://localhost:8000/subjects/remove/'+id)
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)}); 
       },
       async AddSubject(name) {
           // alert(name);
           await axios.get('http://localhost:8000/subjects/add/'+name)
               .then((response)=>
                  { 
                    if(response.data == 'Empty subject name can not be added')
                    { 
                      this.message = response.data;
                      alert(this.message);
                      this.message = '';
                    }
                    else
                    { 
                      this.subjects = response.data;
                    }
                    }).catch(function(error){console.log(error)});
                    this.new_subject_name = null;


       },
       async FetchUsers()
       {
         this.showDashboard = false;
         this.showSubjects = false; 
         this.showUsers = true;
         this.show_teacher_user = false;
         this.show_student_user = false;
         await axios.get('http://localhost:8000/admin/get/all/users')
                .then((response)=>(this.users = response.data))
                .catch(function(error){console.log(error)}); 
       },
       async Fetch_all_Teachers()
       {
          this.showDashboard = false;
          this. show_teacher_user = true;
         this.showDashboard = false;
         this.showSubjects = false; 
         this.showUsers = true;
         this.show_student_user = false;
         await axios.get('http://localhost:8000/admin/get/all/teachers')
                .then((response)=>(this.users = response.data))
                .catch(function(error){console.log(error)}); 
       },
       async Fetch_all_Students()
       {

         this.showDashboard = false;
         this.showSubjects = false; 
         this.showUsers = true;
         this.show_teacher_user = false;
         this.show_student_user = true;
         await axios.get('http://localhost:8000/admin/get/all/students')
                .then((response)=>(this.users = response.data))
                .catch(function(error){console.log(error)}); 
       },
        async FetchRoles() {
                await axios.get('http://localhost:8000/admin/get/all/roles')
                .then((response)=>(this.roles = response.data))
                .catch(function(error){console.log(error)}); 
       },
        async RemoveUser(id)
       {
              await axios.get('http://localhost:8000/admin/remove/user/'+id)
                .then((response)=>(this.users = response.data))
                .catch(function(error){console.log(error)}); 
       },
       async update_role_of_user(id,name)
       {
        await axios.get('http://localhost:8000/admin/update/role/'+id+'/user/'+name)
                .then((response)=>(this.users = response.data))
                .catch(function(error){console.log(error)}); 
       }
    },
    mounted() {
      EventBus.$on('dashboard_Event1', data => {
                this.showDashboard = data;
            });
      EventBus.$on('subject_Event1', data => {
                this.subjects = data;
            });
      EventBus.$on('subject_Event2', data => {
                this.showDashboard = data; 
            });
      EventBus.$on('subject_Event3', data => {
                this.showSubjects = data; 
            });
      EventBus.$on('subject_Event4', data => {
                this.showUsers = data; 
            });
      EventBus.$on('user_Event4', data => {
                this.users = data;
            });
      EventBus.$on('user_Event5', data => {
                this.showUsers = data; 
            });
      EventBus.$on('user_Event6', data => {
                this.showDashboard = data; 
            });
      EventBus.$on('user_Event7', data => {
                this.showSubjects = data; 
            });
      console.log('dashboard component mounted');
    }
  }
</script>

<style>
h1{
  color:rgba(0,0,0,0.7);
}
.Editable{
  height: 35px;
  padding-left: 10px;
  border:1px solid lightblue;
  outline: none;
  border-radius: 20px;
}
.Editable:focus{
 border: 2px solid lightblue;
}
span{
  cursor: pointer;
text-transform: capitalize;
}
  .grid-icon {
    border-radius: 10px;
    background-color: #8599ad;
    color: white;
  }
  .grid-icon:hover
  {
    background-color: rgba(44,133,155);
    cursor: pointer;
  }
  h5{
    color: white;
  }
  .location
  {
    border:none;
    width: 88%;
    background-color: rgba(218,218,218,0.5);
    border-radius: 6px;
    margin-bottom: 5px;
  }
  .table_of_contents
  {
    width: 86%;
  }
  .location-button
  {
    background:transparent;
    border:none;
    cursor: pointer;
    color: black;
  }
  .location-button:hover
  {
     background-color: #8599ad;
     color: white;
  }
  .search_content
  {
    width: 540px;
  }
  .input-container
  {
    display: flex;
    width: 100%;
    margin-bottom: 15px;
  }
  .icon 
  {
    position: relative;
    margin-left: -30px;
    margin-top: 8px;
    font-size: 18px;
    color: #8599ad;
    
  }
  .input-field {
    width: 74%;
    height: 35px;
    padding-left: 10px;
  border:none;
  outline: none;
    border-radius: 20px;

/*  border-radius: 3px;
*/}
.input-field:focus{
  border: 1px solid lightblue;
}
  .subject_list_text,.subject_add_button
  {
    border:solid 1px lightgrey;
   
  }
  .subject_add_button
  {
    background-color: white;
    cursor:pointer;
    color: black;
    width: 110px;
    padding: 5px 3px;
    border-radius: 6px;
  }
  .subject_add_button:hover
  {
    background-color: rgba(44,133,155);
  }
  .subject_list_text
  {
    background-color: rgba(218,218,218,0.5);
    border-radius: 6px;
  }
  .subject_input
  {
    height: 35px;
    width: 784px;
    border-radius: 20px;
    margin-left: -8px;
    outline: none;
    border:1px solid lightblue;
    padding:15px;
  }
   .subject_input:focus{
     border:2px solid lightblue;
   }
   .btn-primary{
    position: relative;
    width: 110px;
    border-radius: 20px;
    padding:9px;
   }
</style>