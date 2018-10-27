<template>
    <div class="col-sm-12">
       <nav>
        <div class="nav nav-tabs " id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">My profile</a>
            <a @click="MyTeachers" class="nav-item nav-link" id="nav-teacher-tab" data-toggle="tab" href="#nav-teacher" role="tab" aria-controls="nav-teacher" aria-selected="false">My Teacher</a>
            <a @click="MySubjects" class="nav-item nav-link" id="nav-subject-tab" data-toggle="tab" href="#nav-subject" role="tab" aria-controls="nav-subject" aria-selected="false">My Subject</a>
            <a class="nav-item nav-link" id="nav-test-tab" data-toggle="tab" href="#nav-test" role="tab" aria-controls="nav-test" aria-selected="false">My Test</a>
            <a class="nav-item nav-link" id="nav-activities-tab" data-toggle="tab" href="#nav-activities" role="tab" aria-controls="nav-activities" aria-selected="false">Activities</a>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row profileRow">
                <div class="col-sm-4">
                    <div class="imageBox">
                        <i class="fa fa-user-o fa-5x" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="userDetail">
                        <label class="userDeatailLabel">Name</label><strong>:</strong>
                        <p>Jhon Doe</p><br>
                        <label class="userDeatailLabel">Email</label><strong>:</strong>
                        <p>jhondoe@gmail.com</p><br>
                        <label class="userDeatailLabel">Passward</label><strong>:</strong>
                         <p><b>******</b></p><br>
                         <label class="userDeatailLabel">Role</label><strong>:</strong>
                        <p>Student</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-teacher" role="tabpanel" aria-labelledby="nav-teacher-tab">
             <div class="row teacherRow">
                <div class="col-sm-2" v-for="teacher in teachers" :key="teacher.id">
                    <div class="card card-default teacherCard">
                         <div class="card-body">
                            <i class="fa fa-user-circle fa-5x" aria-hidden="true"></i>
                             <span>{{ teacher.name }}</span>
                             <label>
                                 John Doe is an architect and engineer
                             </label>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-subject" role="tabpanel" aria-labelledby="nav-subject-tab">
             <div class="row subjectRow">
                <div class="col-sm-3" v-for="subject in subjects" :key="subject.id">
                    <div class="card card-default custom-card">
                         <div class="card-body">
                             {{ subject.subject }}
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-test" role="tabpanel" aria-labelledby="nav-test-tab">
            coming soon....
        </div>
        <div class="tab-pane fade" id="nav-activities" role="tabpanel" aria-labelledby="nav-activities-tab">
            Soon..we will display your all the activities.
        </div>
    </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
        computed:{
            ...mapGetters({
                teachers:'Teachers',
                subjects:'Subjects'
            })
        },
        methods:{
            MyTeachers(){
                this.$store.dispatch('Set_Teachers');
            },
            MySubjects(){
                this.$store.dispatch('Set_Subjects');
            }
        }
}
</script>

<style scoped>
nav{
    background: rgba(69, 181, 198,0.2);
    width: 100%;
}
.custom-card{  
    margin-bottom: 15px;
    text-align: center;
    font-weight: bolder;
    color: dodgerblue;
}
.imageBox{
    border: .5px solid rgba(211,211,211,0.5);
    height: 350px;
    text-align: center;
    line-height: 450px;
}
.fa-user-o{
    color: rgba(0,0,0,0.5);
    font-size: 200px;
}
.tab-pane, .nav-item.active{
    background: #fff;
}
.nav-item.active{
 font-weight: bold;
    color:rgba(10,113,138) !important;
}
.teacherCard{
    width: 150px;
    height: 210px;
    text-align: center;
    margin: 5px;
}
.profileRow,.subjectRow{
    padding:15px 0;
}
.teacherRow{
    padding-top: 5px;
}
.userDeatailLabel{
    font-weight: bold;
    font-size: 16px;
    min-width: 100px
}
p{
    font-size: 16px;
    display: inline;
    padding-left: 40px;
}
span{
    font-size: 16px;
    text-transform: capitalize;
    font-weight: bold;
    color: lightslategray;
}
.fa-user-circle{
    color: rgba(0,0,0,0.5);
}
.nav-item{
    font-size:16px;
    margin-left:0px;

}
.nav-link{
    color:lightslategray !important;
}
</style>
