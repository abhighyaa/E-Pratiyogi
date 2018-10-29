<template>
<div style="background:white;">
    <settings-component v-if="showModal" @close="showModal = false"></settings-component>
    <!-- first row for dashboard heading and search bar -->
    <div class="row mt-2 ml-3">
        <div class="col-sm-4">
             <h1><b>Dashboard</b></h1>
        </div> 
        <div class="col-sm-8 mt-2">
           <!--  <div class="input-container">
               
                <input class="input-field" type="text" placeholder="Search" name="usrname"><i class="fa fa-search icon"></i>
            </div>      -->
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
            <i class="fa fa-angle-double-right" v-if="showSubjects === true"></i>
            <button v-if="showSubjects" class="location-button btn pt-2 pb-2 pl-3 pr-3" @click="FetchSubjects()">
              Subjects
            </button>
            <i class="fa fa-angle-double-right" v-if="showUsers === true"></i>
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
            <i class="fa fa-angle-double-right" v-if="showCourses === true "></i>
            <button  v-if="showCourses" class="location-button btn pt-2 pb-2 pl-3 pr-3" @click="FetchCourses()">
             Courses
            </button>
            <i class="fa fa-angle-double-right" v-if="showBranches === true "></i>
            <button  v-if="showBranches" class="location-button btn pt-2 pb-2 pl-3 pr-3" @click="FetchBranches()">
             Branches
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
              <!-- <th scope="col">Manage</th> -->
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
               <!-- <td>
                  <button class="btn btn-danger" @click="RemoveUser(user.id)">Remove</button>
              </td> -->
            </tr>
          </tbody>
        </table>
    </div>
    <!-- table users end -->
    <!-- user department end -->
    
    <!-- course department -->
    <!-- row for insertion of courses -->
    <div class="row mt-2 ml-4 insertion_row" v-if="showCourses">
      <div class="col-sm-9 text-center pt-1 subject_list_text"><b>List of Courses</b>
      </div>
      <div class="col-sm-2 text-center " >
        <div class="add_button" @click="Input_for_course = true">Add Course</div>
      </div>
      <div class="col-sm-2"></div>
    </div>
    <!-- insertion row end -->
     <!-- this row will be appear if user will click on add course -->
    <div class="row mt-2 ml-3 insertion_row" v-if="Input_for_course">
      <div class="col-sm-9 ">
        <input type="text" placeholder="Course Name" name="course_name" v-model="new_course_name" class="subject_input">
      </div>
      <div class="col-sm-2 ">
         <button class="btn btn-primary" @click="Input_for_course = false, AddCourse(new_course_name)">
          <li class="fa fa-plus"></li>
         </button>
      </div>
    </div>
    <!-- this row end -->
    <!-- table for courses -->
    <div v-if="showCourses === true">
        <table class="table mt-3 ml-4 table_of_contents">
          <thead>
            <tr>
              <th scope="col">S.No.</th>
              <th scope="col">Course Name</th>
              <!-- <th scope="col">Manage</th> -->
            </tr>
          </thead>
          <tbody>
            <tr v-for="(course,index) in courses" :key="course.id">
              <td>{{ ++index }}</td>
              <td>
               <input class="Editable" type="text" v-if="edit == course.id" v-model="course.name"
                  v-on:blur="edit = false; UpdateCourse(course.name,course.id)"
                  @keyup.enter ="edit=false; UpdateCourse(course.name,course.id)">
               <span title="Double click to Edit" v-else @dblclick="edit = course.id">{{ course.name }}</span>
              </td>
             <!--  <td>
                <button class="btn btn-danger" @click="RemoveCourse(course.id)">Delete</button>
              </td> -->
            </tr>
          </tbody>
        </table>
    </div>
     <!--course table end -->
    <!-- course department end -->
   
    <!-- branch department start-->
     <!-- row for insertion of branches -->
    <div class="row mt-2 ml-4 insertion_row" v-if="showBranches">
      <div class="col-sm-9 text-center pt-1 subject_list_text"><b>List of Branches</b>
      </div>
      <div class="col-sm-2 text-center " >
        <div class="add_button" @click="Input_for_branch = true,Fetch_courses_for_branch()">Add Branch</div>
      </div>
      <div class="col-sm-2"></div>
    </div>
    <!-- insertion row end -->
    <!-- this will appear wnen user will click on 'add branch' button -->
    <div class="row mt-2 ml-3 insertion_row" v-if="Input_for_branch">
    <div class="col-md-5">
      <select v-model="selected" class="branch-dropdown">
        <option>{{ selected }}</option>
        <option @click="selected = course.name" v-for="course in courses" :key="course.id"> {{ course.name }} </option>
      </select>
    </div>
    <div class="col-md-4">
          <input type="text" placeholder="Branch Name" name="branch_name" v-model="new_branch_name" class="branch_input">
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary" @click="Input_for_branch=false, AddBranch(selected,new_branch_name)">
          <li class="fa fa-plus"></li>
         </button>
    </div>
    </div>
    <!-- this row end -->
    <!-- table for branches -->
    <div v-if="showBranches === true">
        <table class="table mt-3 ml-4 table_of_contents">
          <thead>
            <tr>
              <th scope="col">S.No.</th>
              <th scope="col">Course Name</th>
              <th scope="col">Branch Name</th>
              <!-- <th scope="col">Manage</th> -->
            </tr>
          </thead>
          <tbody>
            <tr v-for="(branch,index) in branches" :key="branch.id">
              <td>{{ ++index }}</td>
              <td v-for="course in branch.courses_branches" :key="course.id">
                {{ course.name }}                
              </td>
              <td>
               <input class="Editable" type="text" v-if="edit == branch.id" v-model="branch.name"
                  v-on:blur="edit = false; UpdateBranch(branch.name,branch.id)"
                  @keyup.enter ="edit=false; UpdateBranch(branch.name,branch.id)">
               <span title="Double click to Edit" v-else @dblclick="edit = branch.id">{{ branch.name }}</span>
              </td>
              <!-- <td>
                <button class="btn btn-danger" @click="RemoveBranch(branch.id)">Delete</button>
              </td> -->
            </tr>
          </tbody>
        </table>
    </div>
    <!--branch table end -->
    <!-- branch department end -->
    <!-- subject department start -->
     <!-- row for insertion of subjects -->
    <div class="row mt-2 ml-4 insertion_row" v-if="showSubjects">
      <div class="col-sm-9 text-center pt-1 subject_list_text"><b>List of Subjects</b>
      </div>
      <div class="col-sm-2 text-center " >
        <div class="add_button" @click="Input_for_subject = true,Fetch_courses_for_branch()">Add Subject</div>
      </div>
      <div class="col-sm-"></div>
    </div>
    <!-- insertion row end -->
    <!-- this row will be appear if user will click on add subject -->
    <div class="row mt-2 ml-3 insertion_row" v-if="Input_for_subject">
      <div class="col-md-3">
        <select class="subject_dropdown" v-model="selected" @change="Fetch_branches_for_this_course(selected)">
          <option>{{ selected }}</option>
          <option v-for="course in courses" :key="course.id" v-if="course.name!=selected">{{ course.name }}</option>
        </select>
      </div>
      <div class="col-md-3">
        <select class="subject_dropdown" v-model="selected_branch">
          <option>{{ selected_branch }}</option>
          <option v-for="branch in branches" :key="branch.id" v-if="branch.name!=selected">{{ branch.name }}</option>
        </select>
      </div>
      <div class="col-sm-3 ">
        <input type="text" placeholder="Subject Name" name="subject_name" v-model="new_subject_name" class="subject_input">
      </div>
      <div class="col-sm-2 ">
         <button class="btn btn-primary" @click="Input_for_subject = false,AddSubject(selected,selected_branch,new_subject_name)">
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
              <th scope="col">Course</th>
              <th scope="col">Branch</th>
              <th scope="col">Subjects</th>
              <th scope="col">Manage</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="( subject, index) in subjects" :key="subject.id">
              <td>{{ ++index }}</td>
              <td v-for="course in subject.courses" :key="course.id"> {{ course.name }} </td>
              <td v-for="branch in subject.branches" :key="branch.id"> {{ branch.name }} </td>
              <td>
                <input class="Editable" type="text" v-if="edit == subject.id" v-model="subject.subject"
                  v-on:blur="edit = false; UpdateSubject(subject.subject,subject.id)"
                  @keyup.enter ="edit=false; UpdateSubject(subject.subject,subject.id)">
              <span title="Double click to Edit" v-else @dblclick="edit = subject.id">{{ subject.subject }}</span>
              </td>
              <td>
                  <button class="btn btn-danger" @click="RemoveSubject(subject.id)">Remove</button>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
    <!-- subjects table end -->
    <!-- subject department end -->

    <div v-if="showDashboard === true">
      <div class="row mt-3 ml-4">
        <div class="col-md-1"></div>
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3" @click="FetchUsers(),FetchRoles()">
          <i class="fa fa-users"></i>
          <h5>Users</h5>
        </div>
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3" @click="FetchCourses()">
          <i class="fa fa-folder-open"></i>
          <h5>Courses</h5>
        </div>
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3" @click="FetchBranches()">
          <i class="fa fa-folder"></i>
          <h5>Branches</h5>
        </div>
        <div class="col-sm-2 grid-icon text-center ml-2 pt-3 pb-3" @click="FetchSubjects()">
          <i class="fa fa-tag"></i>
          <h5>Subjects</h5>
        </div>
        <div class="col-md-1"></div>
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
        showModal:false,
        showSubjects:false,
        show_teacher_user:false,
        show_student_user:false,
        Input_for_subject : false,
        showCourses:false,
        showBranches:false,
        new_subject_name : null,
        Input_for_course : false,
        new_course_name : null,
        Input_for_branch : false,
        new_branch_name : null,
        users:[],
        roles:[],
        courses:[],
        branches:[],
        subjects:[],
        selected : 'Select a course name',
        selected_branch : 'select a branch name'
      }
    },
    
    methods: {
       ShowDashboardScreen() {
         
          this.showDashboard = true;
          this.showSubjects = false;
          this.showUsers = false;
          this.show_teacher_user = false;
          this.show_student_user = false;
          this.showCourses = false;
          this.showBranches = false;
       },
       async FetchUsers()
       {
         this.showDashboard = false;
         this.showSubjects = false; 
         this.showUsers = true;
         this.show_teacher_user = false;
         this.show_student_user = false;
         this.showCourses = false;
         this.showBranches = false;
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
         this.showCourses = false;
         this.showBranches = false;
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
         this.showCourses = false;
         this.showBranches = false;
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
       },
       async FetchCourses()
       {
          this.showDashboard = false;
          this.showUsers = false;
          this.showSubjects = false;
          this.show_teacher_user = false;
          this.show_student_user = false;
          this.showCourses = true;
          this.showBranches = false;
          await axios.get('http://localhost:8000/admin/get/all/courses')
                .then((response)=>(this.courses = response.data))
                .catch(function(error){console.log(error)});    
       },
       async UpdateCourse(CourseNewName,CourseId)
       {
          if(CourseNewName === '')
          {
            alert("Course name can not be NUll")
            await axios.get('http://localhost:8000/admin/get/all/courses')
                .then((response)=>(this.courses = response.data))
                .catch(function(error){console.log(error)}); 
          }
          else
          {
              await axios.get('http://localhost:8000/admin/update/'+CourseId+'/course/'+CourseNewName)
                .then((response)=>(this.courses = response.data))
                .catch(function(error){console.log(error)}); 
          }
      },
      async AddCourse(name) 
      {
           await axios.get('http://localhost:8000/admin/add/course/'+name)
               .then((response)=>
                  { 
                    if(response.data == 'Empty course name can not be added')
                    { 
                      this.message = response.data;
                      alert(this.message);
                      this.message = '';
                    }
                    else
                    { 
                      this.courses = response.data;
                    }
                    }).catch(function(error){console.log(error)});
                    this.new_course_name = null;
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
       },
       async UpdateBranch(BranchNewName,BranchId)
       {
          if(BranchNewName === '')
          {
            alert("Branch name can not be NUll")
            await axios.get('http://localhost:8000/admin/get/all/branches')
                .then((response)=>(this.branches = response.data))
                .catch(function(error){console.log(error)}); 
          }
          else
          {
              await axios.get('http://localhost:8000/admin/update/'+BranchId+'/branch/'+BranchNewName)
                .then((response)=>(this.branches = response.data))
                .catch(function(error){console.log(error)}); 
          }
      },
      async Fetch_courses_for_branch()
      {
        await await axios.get('http://localhost:8000/admin/get/all/courses')
                .then((response)=>(this.courses = response.data))
                .catch(function(error){console.log(error)});
      },
      async AddBranch(selected,new_branch_name)
      {
        await axios.get('http://localhost:8000/admin/add/branch/'+new_branch_name+'/to/'+selected)
                .then((response)=>{
                  if(response.data == 'please select a course name first')
                  {
                    this.message = response.data;
                    alert(this.message);
                    this.message = '';
                  }
                  else if(response.data == 'branch name is required')
                  {
                    this.message = response.data;
                    alert(this.message);
                    this.message = '';
                  }
                  else if(response.data == 'this branch is already exist in selected course')
                  {
                    this.message = response.data;
                    alert(this.message);
                    this.message = '';
                  }
                  else
                  {
                    this.branches = response.data;
                  }
                }).catch(function(error){console.log(error)}); 
                this.selected = 'Select a course name';
                this.new_branch_name = null;
      },
       async FetchSubjects() {
        
          this.showDashboard = false;
          this.showUsers = false;
          this.showSubjects = true;
          this.showCourses = false;
          this.showBranches = false;
          
          await axios.get('http://localhost:8000/admin/get/all/subjects')
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)}); 
                      
       },
       async RemoveSubject(subject_id) {
         
          alert(subject_id);
          await axios.get('http://localhost:8000/admin/remove/subject/'+subject_id)
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)}); 
       },
       async UpdateSubject(SubjectNewName,SubjectId)
       {
          if(SubjectNewName === '')
          {
            alert("Subejct can not be NUll")
            await axios.get('http://localhost:8000/admin/get/all/subjects')
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)}); 
          }
          else
          {
              await axios.get('http://localhost:8000/subjects/update/'+SubjectId+'/'+SubjectNewName)
                .then((response)=>(this.subjects = response.data))
                .catch(function(error){console.log(error)}); 
          }
      },
      async AddSubject(selected,selected_branch,new_subject_name)
      {
        
         await axios.get('http://localhost:8000/admin/add/'+new_subject_name+'/'+selected_branch+'/'+selected)
                .then((response)=>{
                      if(response.data == 'please select a course name first')
                      {
                        this.message = response.data;
                            alert(this.message);
                            this.message = '';
                      }
                      else if(response.data == 'please select a branch name first')
                      {
                        this.message = response.data;
                            alert(this.message);
                            this.message = '';
                      }
                      else if(response.data == 'subject name is required')
                      {
                        this.message = response.data;
                        alert(this.message);
                        this.message = '';
                      }
                      else if(response.data == 'this subject is already exist in selected branch')
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
                this.selected = 'Select a course name';
                this.selected_branch = 'select a branch name';
                this.new_subject_name = null; 
      },
      async Fetch_branches_for_this_course(selected)
      {
        //alert(selected);
        await axios.get('http://localhost:8000/admin/fetch/branches/for/course/'+selected)
                .then((response)=>(this.branches = response.data))
                .catch(function(error){console.log(error)}); 
                this.selected_branch =  'select a branch name';
      }
    },
    mounted() {
      EventBus.$on('dashboard_Event1', data => {
                this.showDashboard = data;
            });
       EventBus.$on('user_events', data => {
                this.users = data.usersKey;
                this.showDashboard =  data.showDashboardKey;
                this.showSubjects = data.showSubjectsKey;
                this.showUsers = data.showUsersKey; 
                this.showCourses = data.showCoursesKey; 
                this.showBranches = data.showBranchesKey;    
            });
       EventBus.$on('courses_events', data => {
                this.courses = data.coursesKey;
                this.showDashboard =  data.showDashboardKey;
                this.showSubjects = data.showSubjectsKey;
                this.showUsers = data.showUsersKey; 
                this.showCourses = data.showCoursesKey;
                this.showBranches = data.showBranchesKey;         
            });
       EventBus.$on('branch_events', data => {
                this.branches = data.branchesKey;
                this.showDashboard =  data.showDashboardKey;
                this.showSubjects = data.showSubjectsKey;
                this.showUsers = data.showUsersKey; 
                this.showCourses = data.showCoursesKey;  
                this.showBranches = data.showBranchesKey;       
            });
       EventBus.$on('subject_events', data => {
                this.subjects = data.subjectsKey;
                this.showDashboard =  data.showDashboardKey;
                this.showSubjects = data.showSubjectsKey;
                this.showUsers = data.showUsersKey; 
                this.showCourses = data.showCoursesKey;  
                this.showBranches = data.showBranchesKey;       
            });
        EventBus.$on('modal_events', data => {
                this.showModal = data.showModalKey;       
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
     cursor: pointer;
  }
  .grid-icon:hover
  {
    background-color: rgba(44,133,155);
    /*cursor: pointer;*/
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
  .add_button
  {
    background-color: white;
    cursor:pointer;
    color: black;
    width: 110px;
    padding: 5px 3px;
    border:solid 1px lightgrey;
    border-radius: 6px;
  }
  .add_button:hover
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
    width: 250px;
    border-radius: 20px;
    margin-left: -8px;
    outline: none;
    border:1px solid lightblue;
    padding:15px;
  }
  .branch_input
  {
    height: 35px;
    width: 340px;
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
   .question,.settings,.results,.notifications:hover
   {
    cursor: not-allowed;
   }
   .branch-dropdown
   {
    width: 410;
    margin-top: 4px;
    padding: 3px; 
   }
   .subject_dropdown
   {
    width: 210;
    margin-top: 4px;
    padding: 3px; 
   }
</style>